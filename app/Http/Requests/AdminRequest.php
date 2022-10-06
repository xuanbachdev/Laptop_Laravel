<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
        $uniqueUsernameRule = Rule::unique('admins','username')->ignore($this->id??0)->whereNull('deleted_at');
        $uniqueMailRule = Rule::unique('admins','email')->ignore($this->id??0)->whereNull('deleted_at');
        $passwordRule= $this->method()=="PUT"?["nullable"]:["required","min:6"];
        return [
            //
            "name" => ["required","min:5"],
            "username"=>["required","min:4",$uniqueUsernameRule],
            "password" =>$passwordRule,
            "email" =>["required","email",$uniqueMailRule],
            "avatar_path" => ["required", 'image']
        ];
    }
    public function messages()
    {
        return [
            "name.required"=> "Họ tên không được bỏ trống!",
            "name.min" => ["string"=>"Họ tên tối thiểu 5 ký tự!"],
            "username.required" => "Username không được bỏ trống!",
            "password.required" => "Username không được bỏ trống!",
            "username.unique" => "Username này đã được sử dụng cho người khác!",
            "username.min" => ["string"=>"Username tối thiểu 4 ký tự!"],
            "email.email" => "Email không đúng định dạng!",
            "email.required" => "Email không được bỏ trống!",
            "email.unique" => "Email này đã được sử dụng cho người khác!!",
            "avatar_path.required" => "Vui lòng chọn ảnh đại diện!",
            "avatar_path.image" => "Ảnh đại diện không hợp lệ!",
        ];
    }
}
