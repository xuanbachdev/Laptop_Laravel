<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title' => 'bail|required|min:8|unique:blogs',
            'contents' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'image_blog' => ['nullable', 'image'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết',
            'title.min' => 'Tiêu đề bài viết phải ít nhất 8 ký tự',
            'title.unique' => 'Tiêu đề bài viết đã tồn tại',
            'contents.required' => 'Nội dung bài viết không được để trống',
            'meta_keyword.required' => 'Từ khóa bài viết không được để trống',
            'meta_description.required' => 'Mô tả bài viết không được để trống',
            'image_blog.image' => 'Ảnh blog không đúng định dạng',
        ];
    }
}
