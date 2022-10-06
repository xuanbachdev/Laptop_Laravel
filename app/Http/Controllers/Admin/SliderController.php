<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use File;

class SliderController extends Controller
{
    use StorageImageTrait, DeleteModelTrait;
    private $sliders;
    public function __construct(Slider $sliders)
    {
        $this->sliders = $sliders;
    }

    public function index(){
        $data = [
          'title' => 'Danh sách slider',
          'sliders' => Slider::all()

        ];
        return view('admin.sliders.list', $data);
    }

    public function create(){
        $data = [
            'title' => 'Thêmn mới slider',
        ];
        return view('admin.sliders.add', $data);
    }

    public function store(SliderRequest $request){
        try {
            $dataInsert = [
                'name' => $request->name,
                'url' => $request->url,
                'type' => $request->type,
                'status' => $request->status,
                'created_at' => now()
            ];
            $dataImageSlider = $this -> storageTraitUpload($request, 'image_path', 'uploads/slider/');
            if(!empty($dataImageSlider)){
                $dataInsert['image_name'] = $dataImageSlider['file_name'];
                $dataInsert['image_path'] = $dataImageSlider['file_path'];
            }
            $this->sliders->create($dataInsert);
            return redirect()->route('sliders.view')->with('success', 'Thêm slider thành công');
        } catch (\Exception $exception) {
            \Log::error('Lỗi : ' . $exception->getMessage() . '---Line: ' . $exception->getLine());
            return back()->with('error', 'Thêm slider thất bại');

        }
    }

    public function edit($id){
        $data = [
            'title' => 'Sửa thông tin slider',
            'sliders' => Slider::find($id)
        ];
        return view('admin.sliders.edit', $data);
    }

    public function update(Request $request, $id){
        try {
            $dataUpdate = [
                'name' => $request->name,
                'url' => $request->url,
                'type' => $request->type,
                'status' => $request->status,
                'created_at' => now()
            ];
            $dataImageSlider = $this -> storageTraitUpload($request, 'image_path', 'uploads/slider/');
            if(!empty($dataImageSlider)){
                $dataUpdate['image_name'] = $dataImageSlider['file_name'];
                $dataUpdate['image_path'] = $dataImageSlider['file_path'];
            }
//            dd($dataImageSlider);
            $this->sliders->find($id)->update($dataUpdate);
            return redirect()->route('sliders.view')->with('success', 'Sửa slider thành công');
        } catch (\Exception $exception) {
            \Log::error('Lỗi : ' . $exception->getMessage() . '---Line: ' . $exception->getLine());
            return back()->with('error', 'Sửa slider thất bại');

        }
    }

    public function destroy($id){
            return $this->deleteModelTrait($id, $this->sliders);
    }
}
