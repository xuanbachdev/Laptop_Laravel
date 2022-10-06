<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CpuRequest extends FormRequest
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
        $uniqueNameRule = Rule::unique('cpus','name')->ignore($this->id??0)->whereNull('deleted_at');
        return [
            'name' => ['bail','required' ,'min:5' , $uniqueNameRule],
            'gen' => 'required',
            'cores' => 'required',
            'threads' => 'required',
            'base_clock' => 'required',
            'turbo_clock' => 'required',
            'cache' => 'required',
            'integrated_gpu' => 'required'

        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Tên CPU không được để trống!",
            "name.unique" => "Tên CPU không được trùng, \"$this->name\" đã được sử dụng!",
            'name.min' => 'Tên CPU ít nhất 5 ký tự',
            'gen.required' => 'Vui lòng nhập tên thế hệ cpu',
            'cores.required' => 'Vui lòng nhập số lõi',
            'threads.required' => 'Vui lòng nhập số luồng',
            'base_clock.required' => 'Vui lòng nhập số mức xung cơ bản',
            'turbo_clock.required' => 'Vui lòng nhập mức xung turbo',
            'cache.required' => 'Vui lòng nhập bộ nhớ cache',
            'integrated_gpu.required' => 'Vui lòng nhập tên đồ họa tích hợp',
        ];
    }
}
