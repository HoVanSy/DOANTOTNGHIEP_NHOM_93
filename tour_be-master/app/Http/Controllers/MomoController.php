<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\HoaDon;
use Illuminate\Support\Facades\Auth;

class MomoController extends Controller
{
    public function atmPayment(Request $request)
    {
         $request->validate([
            'id' => 'required',
            'tong_tien' => 'required|numeric|min:1',
        ]);

        $endpoint = 'https://test-payment.momo.vn/v2/gateway/api/create';

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey   = 'klm05TvNBzhg7h7j';
        $secretKey   = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

       

        $orderInfo   = "Thanh toan qua MoMo";
        $amount      = (int)$request->tong_tien;
        $orderIdRaw  = preg_replace('/[^0-9A-Za-z]/', '', $request->id);
        $orderId     = $orderIdRaw ? $orderIdRaw . '-' . time() : 'order' . time();
        $orderId     = preg_replace('/[^0-9A-Za-z\-_.:]/', '', $orderId);
        
        if (empty($orderId)) {
            $orderId = 'order' . time();
        }
        $redirectUrl = "https://ability-winking-defendant.ngrok-free.dev/client/ket-qua-thanh-toan";
        $ipnUrl      = "https://ability-winking-defendant.ngrok-free.dev/api/client/momo/ipn";
        // $redirectUrl = "http://localhost:5173/client/ket-qua-thanh-toan";
        // $ipnUrl      = "http://localhost:5173/api/client/momo/ipn";
        $extraData   = "";
        $requestId   = (string)(time());
        $requestType = "payWithATM";

        $rawHash =
            "accessKey=".$accessKey.
            "&amount=".$amount.
            "&extraData=".$extraData.
            "&ipnUrl=".$ipnUrl.
            "&orderId=".$orderId.
            "&orderInfo=".$orderInfo.
            "&partnerCode=".$partnerCode.
            "&redirectUrl=".$redirectUrl.
            "&requestId=".$requestId.
            "&requestType=".$requestType;


        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => 'Test',
            'storeId' => 'MomoTestStore',
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => '',
            'requestType' => 'payWithATM',
            'signature' => $signature
        ];

        $result = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($endpoint, $data);

        $jsonResult = $result->json();

        if (isset($jsonResult['payUrl']) && $jsonResult['resultCode'] === 0) {
            return response()->json([
                'status' => true,
                'payUrl' => $jsonResult['payUrl']
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => $jsonResult['message'] ?? 'Lỗi không xác định'
        ], 400);
    }
    public function ipnHandler(Request $request)
    {
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $rawHash =
            "accessKey="    . $accessKey . 
            "&amount="      . $request->amount .
            "&extraData="   . ($request->extraData ?? "") . 
            "&message="     . $request->message .
            "&orderId="     . $request->orderId .
            "&orderInfo="   . $request->orderInfo .
            "&orderType="   . $request->orderType .
            "&partnerCode=" . $request->partnerCode .
            "&payType="     . $request->payType .
            "&requestId="   . $request->requestId .
            "&responseTime=". $request->responseTime .
            "&resultCode="  . $request->resultCode .
            "&transId="     . $request->transId;

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        \Log::info("My Signature: " . $signature);
        \Log::info("MoMo Signature: " . $request->signature);

        if ($signature !== $request->signature) {
            return response()->json(['message' => 'Invalid signature'], 400);
        }

        if ((int)$request->resultCode === 0) {
            $idGoc = explode('-', $request->orderId)[0];
            $hoaDon = HoaDon::find($idGoc); 

            if ($hoaDon && $hoaDon->tinh_trang == 0) { 
                $hoaDon->tinh_trang = 1;
                $hoaDon->tong_tien = (int)$request->amount; 
                $hoaDon->save();
            }
        }

        return response()->json(['message' => 'OK'], 200);
    }
    public function ketQuaThanhToan(Request $request)
    {
        $resultCode = $request->query('resultCode');
        $orderId    = $request->query('orderId');

        return response()->json([
            'status'     => $resultCode == 0,
            'resultCode' => (int)$resultCode,
            'orderId'    => $orderId,
            'message'    => $resultCode == 0 ? 'Thanh toán thành công' : 'Thanh toán thất bại',
        ]);
    }
}
