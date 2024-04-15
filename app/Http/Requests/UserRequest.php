<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'ho' => 'nullable',
            'ten' => 'nullable',
            'ngaySinh' => 'nullable',
            'gioiTinh' => 'nullable',
            'cccd' => 'nullable',
            'diaChi' => 'nullable',
            'SDT' => 'nullable',
            'taiKhoan' => 'nullable',
            'password' => 'nullable',
            'soDuTaiKhoan' => 'nullable',
            'trangThai' => 'nullable',
            'google_id' => 'nullable',
            'google_token' => 'nullable',
            'maQuyen' => 'nullable',
            'maPX' => 'nullable',
            'hinhDaiDien' => 'nullable'
        ];
    }
}
