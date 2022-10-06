<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CpuRequest;
use App\Models\Cpu;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

class CpuController extends Controller
{

    use DeleteModelTrait;
    private $cpus;
    protected $brands = ['Intel', 'AMD', 'Apple'];
    protected $series = ['Xeon', 'Pentium', 'Core i3', 'Core i5', 'Core i7', 'Ryzen 3', 'Ryzen 5', 'Ryzen 7','Apple M1'];

    public function __construct(Cpu $cpus)
    {
        $this->cpus = $cpus;
    }

    public function index()
    {
        $data = [
            'title' => 'Thông tin CPU',
            'cpuList' => Cpu::all()
        ];
        return view('admin.products.cpus.list', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Thêm thông tin CPU',
            'brands' => $this->brands,
            'series' => $this->series,

        ];
        return view('admin.products.cpus.add', $data);
    }


    public function store(CpuRequest $request)
    {
       try{
           $cpu =  $this->cpus->create([
               'name' => $request->name,
               'brand' => $request->brand,
               'series' => $request->series,
               'gen' => $request->gen,
               'cores' => $request->cores,
               'threads' => $request->threads,
               'base_clock' => $request->base_clock,
               'turbo_clock' => $request->turbo_clock,
               'cache' => $request->cache,
               'integrated_gpu' => $request->integrated_gpu,
               'release_date' => $request->release_date,
               'created_at' => now()
           ]);
           return response()->json([
               'id' => $cpu->id,
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
            'title' => 'Chỉnh sửa thông tin cpu',
            'brands' => $this->brands,
            'series' => $this->series,
            'cpu' => Cpu::findOrFail($id)
        ];
        return view('admin.products.cpus.edit', $data);
    }


    public function update(Request $request, $id)
    {
        try {
            $cpu = Cpu::findOrFail($id);
            $cpu->update([
                'name' => $request->name,
                'brand' => $request->brand,
                'series' => $request->series,
                'gen' => $request->gen,
                'cores' => $request->cores,
                'threads' => $request->threads,
                'base_clock' => $request->base_clock,
                'turbo_clock' => $request->turbo_clock,
                'cache' => $request->cache,
                'integrated_gpu' => $request->integrated_gpu,
                'release_date' => $request->release_date,
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
        return $this->deleteModelTrait($id, $this->cpus);
    }
}
