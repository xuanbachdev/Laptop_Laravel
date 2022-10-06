<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use App\Components\Recursive;

class CategoryController extends Controller
{
    use DeleteModelTrait;
    protected $categories;
    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    public function index()
    {
       $data = [
           'title' => 'Quản lý danh mục',
           'content_header' => 'Danh sách danh mục',
           'htmlOption' => $this ->getCategory($parentId =''),
           'categories' => $this->categories->latest()->get()
       ];
        return view('admin.categories.list', $data);
    }

    public function getCategory($parentId)
    {
        $data = $this->categories->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->Recursive($parentId);
        return $htmlOption;
    }

    public function getParent()
    {
        return Category::where('parent_id', 0)->get();
    }
    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->categories->create([
               'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => \Str::slug($request->name),
                'status' => $request->status,
                'created_at' => now()
            ]);
            return response()->json([
               'id' => $category->id,
                'code' => 200,
                'message' => 'success'
            ], 200);
        }
        catch (\Exception $ex){
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

    public function edit($id){
        $title = 'Chỉnh sửa danh mục';
        $category = Category::findOrFail($id);
        $categoriesList = Category::where('id',"!=",$id)->get();
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.categories.edit' ,compact('title', 'category', 'htmlOption'));
    }
    public function update(Request $request, $id)
    {
        try {
            $categorys = Category::find($id);
            if($request->parent_id != $categorys->id){
                $categorys->parent_id = $request->parent_id;
            }
            else{
                $categorys->parent_id = 0;
            }
            $categorys->update([
                'name' => $request -> name,
                'status' => $request->status,
                'slug' => \Str::slug($request -> name),
                'updated_at' => now()
            ]);
            return response() -> json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (Exception $exception) {
            return response() -> json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

    public function destroy($id)
    {
        return $this->deleteModelTrait($id, $this->categories);
    }
}
