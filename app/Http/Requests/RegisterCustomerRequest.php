<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterCustomerRequest extends FormRequest
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
            'name' => ['required','min:5', 'unique:users'],
            'customer_verification_code_register' => ['required','min:5'],
            'email' => ['required','email', Rule::unique('users','email')],
            'phone_number' =>['required','regex:/^\d{10}$/', Rule::unique('users','phone')],
            'address' => ['required'],
            'password' => ['required','min:6'],
            'confirm_password' => ['required','same:password']
        ];
    }

    public function messages()
    {
        return [
            'customer_verification_code_register.required' => 'Mã xác thực không được trống!',
            'name.required' => 'Tên không được trống!',
            'name.min' => 'Tên tối thiểu phải 5 ký tự!',
            'email.required' => 'Email không được trống!',
            'email.email' => 'Email không đúng định dạng!',
            'email.unique' => 'Email này đã được sử dụng!',
            'phone_number.required' => 'Số điện thoại không được trống!',
            'phone_number.regex' => 'Số điện thoại không đúng định dạng!',
            'phone_number.unique' => 'Số điện thoại này đã được sử dụng!',
            'address.required' => 'Địa chỉ không được trống!',
            'password.required' => 'Mật khẩu không được trống!',
            'password.min' => 'Mật khẩu tối thiểu phải 6 ký tự!',
            'confirm_password.required' => 'Vui lòng xác nhận lại mật khẩu!',
            'confirm_password.same' => 'Vui lòng nhập lại chính xác mật khẩu!'
        ];
    }
}
