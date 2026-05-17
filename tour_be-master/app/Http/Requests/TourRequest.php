<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'tieu_de'        => 'required|string|max:255',
            'mo_ta'          => 'required|string',
            'mo_ta_chi_tiet' => 'nullable|string',
            'gia_nguoi_lon'  => 'required|numeric|min:0',
            'gia_tre_em'     => 'required|numeric|min:0',
            'ngay_bat_dau'   => 'required|date',
            'ngay_ket_thuc'  => 'required|date|after_or_equal:ngay_bat_dau',
            'so_luong_khach' => 'required|integer|min:1',
            'link_anh'       => 'nullable|url',
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules = array_map(fn($r) => str_replace('required|', 'sometimes|', $r), $rules);
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'tieu_de.required'        => 'Tiêu đề tour không được để trống',
            'mo_ta.required'          => 'Mô tả không được để trống',
            'gia_nguoi_lon.required'  => 'Giá người lớn không được để trống',
            'gia_nguoi_lon.numeric'   => 'Giá người lớn phải là số',
            'gia_tre_em.required'     => 'Giá trẻ em không được để trống',
            'so_luong_khach.required' => 'Số lượng khách không được để trống',
            'ngay_ket_thuc.after_or_equal' => 'Ngày kết thúc phải sau ngày bắt đầu',
        ];
    }
}
