<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|min:5|max:255|unique:suppliers',
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên nhà cung cấp không được để trống',
            'name.min' => 'Tên nhà cung cấp tối thiểu 5 ký tự',
            'name.unique' => 'Tên nhà cung cấp đã tồn tại',
            'email.required' => 'Email nhà cung cấp không được để trống',
            'email.email' => 'Email nhà cung cấp không đúng định dạng',
            'phone_number.required' => 'Số điện thoại nhà cung cấp không được để trống',
            'address.required' => 'Địa chỉ nhà cung cấp không được để trống'
        ];
    }
}
