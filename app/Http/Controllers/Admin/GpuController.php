<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GpuRequest;
use App\Models\Gpu;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

class GpuController extends Controller
{
    use DeleteModelTrait;
    private $gpus;
    protected $brandList=['NVIDIA','AMD'];
    protected $seriesList=['GX','MX','GTX','RTX','Quadro','RX'];

    public function __construct(Gpu $gpus)
    {
        $this->gpus = $gpus;
    }

    public function index()
    {
        $data = [
            'title' => 'Thông tin GPU',
            'gpuList' => Gpu::all(),
            'brandList' => $this->brandList,
            'seriesList' => $this->seriesList
        ];
        return view('admin.products.gpus.list', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Thêm thông tin GPU',
            'brandList' => $this->brandList,
            'seriesList' => $this->seriesList
        ];

        return view('admin.products.gpus.add', $data);
    }


    public function store(GpuRequest $request)
    {
        try{
            $gpu =  $this->gpus->create([
                'name' => $request->name,
                'brand' => $request->brand,
                'series' => $request->series,
                'graph_memory_cap' => $request->graph_memory_cap,
                'clock' => $request->clock,
                'release_date' => $request->release_date,
                'addition' => $request->addition,
                'created_at' => now()
            ]);
            return response()->json([
                'id' => $gpu->id,
                'code' => 200,
                'message' => 'Thêm thành công'
            ], 200);
        }

        catch (\Exception $exception){
            return response()->json([
                'code' => 500,
                'message' => 'Thêm thất bại'
            ], 500);
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Sửa thông tin GPU',
            'brandList' => $this->brandList,
            'seriesList' => $this->seriesList,
            'gpu' => Gpu::findOrFail($id)
        ];

        return view('admin.products.gpus.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try{
            $gpu = $this->gpus->findOrFail($id);
            $gpu->update([
                'name' => $request->name,
                'brand' => $request->brand,
                'series' => $request->series,
                'graph_memory_cap' => $request->graph_memory_cap,
                'clock' => $request->clock,
                'release_date' => $request->release_date,
                'addition' => $request->addition,
                'updated_at' => now()
            ]);
            return response()->json([
                'id' => $gpu->id,
                'code' => 200,
                'message' => 'Thêm thành công'
            ], 200);
        }

        catch (\Exception $exception){
            \Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Thêm thất bại'
            ], 500);
        }
    }

    public function destroy($id)
    {
        return $this->deleteModelTrait($id, $this->gpus);
    }
}
