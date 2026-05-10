<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VNPAYController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // VNPAY credentials
        $vnp_Url = env('VNPAY_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html');
        $vnp_Returnurl = env('VNPAY_RETURN_URL', 'http://127.0.0.1:8000/api/client/vnpay/return');
        $vnp_TmnCode = env('VNPAY_TMN_CODE', 'D7OGCK0A'); // Merchant code at VNPAY
        $vnp_HashSecret = env('VNPAY_HASH_SECRET', 'R7OQ3JGSVGK6RYUBQFH15HLUYEII145G'); // Secret key

        // Transaction information
        $vnp_OrderType = 'other';
        $vnp_Locale = 'vn'; // Locale

        $vnp_IpAddr = $request->ip() ?: '127.0.0.1';
        if ($vnp_IpAddr === '::1') {
            $vnp_IpAddr = '127.0.0.1';
        }

        $hoaDonId = $request->input('hoa_don_id');
        $hoaDon = HoaDon::find($hoaDonId);

        if (!$hoaDon) {
            return response()->json([
                'status' => false,
                'message' => 'Hóa đơn không tồn tại.'
            ], 404);
        }

        $vnp_Amount = intval($hoaDon->tong_tien) * 100; // VNPAY expects amount in smallest currency unit
        $vnp_OrderInfo = 'Thanh toán hóa đơn: ' . ($hoaDon->ma_hoa_don ?: $hoaDon->id);
        $vnp_TxnRef = $hoaDon->id . '-' . time();

        // Prepare input data
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => Carbon::now('Asia/Ho_Chi_Minh')->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_SecureHashType" => "SHA512",
        ];

        // Sort parameters by key
        ksort($inputData);

        // Build the query string and hashdata for signature
        $queryString = "";
        $hashdata = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            $encodedKey = urlencode($key);
            $encodedValue = urlencode($value);
            if ($i === 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $queryString .= $encodedKey . "=" . $encodedValue . '&';
        }

        // Remove trailing '&' from the query string
        $queryString = rtrim($queryString, '&');

        // Now calculate the secure hash using the secret key
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        // Append the secure hash to the query string
        $vnp_Url .= "?" . $queryString . "&vnp_SecureHash=" . $vnpSecureHash;

        // Return the payment URL
        return response()->json([
            'status' => true,
            'url' => $vnp_Url
        ]);
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = env('VNPAY_HASH_SECRET', 'R7OQ3JGSVGK6RYUBQFH15HLUYEII145G');
        $data = $request->all();

        $vnpSecureHash = $request->query('vnp_SecureHash', $request->input('vnp_SecureHash', ''));
        $vnpSecureHashType = $request->query('vnp_SecureHashType', $request->input('vnp_SecureHashType', ''));

        // Remove secure hash params before building raw data string
        if (isset($data['vnp_SecureHash'])) {
            unset($data['vnp_SecureHash']);
        }
        if (isset($data['vnp_SecureHashType'])) {
            unset($data['vnp_SecureHashType']);
        }

        ksort($data);
        $hashdata = '';
        $i = 0;
        foreach ($data as $key => $value) {
            $encodedKey = urlencode($key);
            $encodedValue = urlencode($value);
            if ($i === 1) {
                $hashdata .= '&' . $encodedKey . "=" . $encodedValue;
            } else {
                $hashdata .= $encodedKey . "=" . $encodedValue;
                $i = 1;
            }
        }
        $hashdata = rtrim($hashdata, '&');

        if (empty($vnpSecureHash)) {
            Log::error('VNPAY callback missing secure hash', [
                'hashdata' => $hashdata,
                'request' => $request->all(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Thiếu tham số vnp_SecureHash từ VNPAY.',
                'hashdata' => $hashdata,
                'data' => $request->all()
            ], 400);
        }

        $calculatedHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $isValid = strtolower($calculatedHash) === strtolower($vnpSecureHash);

        if (!$isValid) {
            Log::error('VNPAY signature mismatch', [
                'received_hash' => $vnpSecureHash,
                'calculated_hash' => $calculatedHash,
                'hashdata' => $hashdata,
                'request' => $request->all(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Sai chữ ký VNPAY.',
                'received_hash' => $vnpSecureHash,
                'calculated_hash' => $calculatedHash,
                'hashdata' => $hashdata,
                'data' => $request->all()
            ], 400);
        }

        $paymentStatus = $request->query('vnp_ResponseCode', null);
        $transactionStatus = $request->query('vnp_TransactionStatus', null);
        $success = $paymentStatus === '00' || $transactionStatus === '00';

        return response()->json([
            'status' => $success,
            'message' => $success ? 'Thanh toán VNPAY thành công.' : 'Thanh toán VNPAY không thành công.',
            'response_code' => $paymentStatus,
            'transaction_status' => $transactionStatus,
            'data' => $request->all(),
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}