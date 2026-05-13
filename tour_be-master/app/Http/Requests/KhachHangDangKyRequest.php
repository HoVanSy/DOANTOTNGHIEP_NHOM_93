<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhachHangDangKyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'          =>   'required|email',
            'ho_ten'            =>   'required',
            'password'       =>   'required|min:5',
            'so_dien_thoai'  =>   'required|digits:10',
            'dia_chi'         =>   'required',
            'ngay_sinh'      => 'required|date|before:today',
            'gioi_tinh'    =>   'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required'   =>  'Email không không được để trống',
            'email.email'      =>   'Email không đúng định dạng',
            'ho_ten'         =>  'Họ tên không được để trống',
            'password.*'       =>  'Mật khẩu không đươc để trống',
            'so_dien_thoai.*'  =>  'Số điện thoai không được để trống và đủ 10 số',
            'dia_chi'         =>  'Địa chỉ không được để trống',
            'ngay_sinh.*'      =>  'Ngày sinh không được để trống và là nhỏ hơn ngày hiện tại',
            'gioi_tinh'         =>  'Giới tính không được để trống',
        ];
    }
}
