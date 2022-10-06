<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerLoginRequest extends FormRequest
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
            'customer_email_login' => 'bail|required',
            'customer_password_login' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'customer_email_login.required' => 'Vui lòng nhập email',
            'customer_password_login.required' => 'Vui lòng nhập password',
            'customer_password_login.min' => 'Password ít nhât 8 ký tự',

        ];
    }
}
