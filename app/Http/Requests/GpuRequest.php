<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GpuRequest extends FormRequest
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
        $uniqueNameRule = Rule::unique('gpus','name')->ignore($this->id??0)->whereNull('deleted_at');
        return [
            'name' => ['bail', 'required','min:3', $uniqueNameRule],
            'graph_memory_cap' => 'required',
            'clock' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên GPU không được để trống',
            'graph_memory_cap.required' => 'Dung lượng V-Ram không được để trống',
            'clock.required' => 'Xung nhịp GPU không được để trống',
        ];
    }
}
