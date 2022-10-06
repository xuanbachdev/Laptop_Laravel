<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    use StorageImageTrait, DeleteModelTrait;
    protected $blogs;
    public function __construct(Blog $blogs)
  {
        $this->blogs = $blogs;
  }

    public function index()
    {
        $data = [
          'title' => 'Quản lý danh sách bài viết',
            'blogs' => Blog::all()
        ];
        return view('admin.blogs.list', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Thêm bài viết',
            'blogs' => Blog::all()
        ];
        return view('admin.blogs.add', $data);
    }

    public function store(BlogRequest $request)
    {
        try {
            $dataInsert = [
                'title' => $request -> title,
                'status' => $request->status,
                'content' => $request -> contents,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'user_id' => Auth::guard('admin')->user()->id,
                'slug' => \Str::slug($request -> input('title')),
                'created_at' => now()
            ];

            $dataUploadFeatureImage = $this -> storageTraitUpload($request,'image_blog','uploads/blog/');
            if (!empty($dataUploadFeatureImage)){
                $dataInsert['title_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataInsert['title_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->blogs->create($dataInsert);
            return redirect()->route('blogs.view')->with('success', 'Thêm bài viết thành công');
        } catch (Exception $exception) {
            \Log::error('Lỗi : ' . $exception->getMessage() . '---Line: ' . $exception->getLine());
            return back()->with('error','Có lỗi xảy ra!')->withInput();
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Sửa bài viết',
            'blogs' => Blog::findOrFail($id)
        ];
        return view('admin.blogs.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $dataUpdate = [
                'title' => $request -> title,
                'status' => $request->status,
                'content' => $request -> contents,
                'meta_keyword' => $request->meta_keyword,
                'meta_description' => $request->meta_description,
                'user_id' => Auth::guard('admin')->user()->id,
                'slug' => \Str::slug($request -> input('title')),
                'updated_at' => now()
            ];

            $dataUploadFeatureImage = $this -> storageTraitUpload($request,'image_blog','uploads/blog/');
            if (!empty($dataUploadFeatureImage)){
                $dataUpdate['title_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataUpdate['title_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->blogs->find($id)->update($dataUpdate);
            return redirect()->route('blogs.view')->with('success', 'Sửa bài viết thành công');
        } catch (Exception $exception) {
            \Log::error('Lỗi : ' . $exception->getMessage() . '---Line: ' . $exception->getLine());
            return back()->with('error','Sửa bài viết thất bại')->withInput();
        }
    }

    public function destroy($id)
    {
        return $this->deleteModelTrait($id, $this->blogs);
    }
}
