<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=>'bail|required',
            'sku' =>'bail|required',
//            'feature_image_path' =>['nullable','mimes:jpg,jpeg,png,gif'],
            'memory' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'memory_capacity' => 'required',
            'case_material' => 'required',
            'bluetooth' => 'required',
            'wifi' => 'required',
            'connection_port' => 'required',
            'keyboard' => 'required',
            'addition' => 'nullable',
            'ssd_storage' => 'nullable',
            'tags' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được bỏ trống',
            'name.unique' => 'Tên không được trùng với sản phẩm khác',
            'sku.required' => 'SKU không được bỏ trống',
            'sku.unique' => 'SKU không được trùng với sản phẩm khác',
            'tags.required' => 'Tag sản phẩm không được để trống',
//            'feature_image_path.mimes' => 'Ảnh không hợp lệ',
            'memory.required' => 'Bộ nhớ ram không được bỏ trống',
            'memory_capacity.required' => 'Dung lượng ram không được bỏ trống',
            'case_material.required' => 'Không được bỏ trống chất liệu sản phẩm',
            'bluetooth.required' => 'Không được bỏ trống bluetooth',
            'wifi.required' => 'Không được bỏ trống wifi',
            'connection_port.required' => 'Không được bỏ trống cổng kết nối',
            'keyboard.required' => 'Không được bỏ trống bàn phím',
            'price.required' => 'Giá không được để trống',
            'description.required' => 'Mô tả sản phẩm không được để trống',
            'quantity.required' => 'Số lượng không được để trống',
        ];
    }
}
