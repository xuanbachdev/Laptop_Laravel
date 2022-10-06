<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    use DeleteModelTrait;
    protected $supplier;
    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }
    public function index()
    {
        $data = [
            'listSupplier' => $this->supplier->all(),
            'title' => 'Danh sách nhà cung cấp'
        ];
        return view('admin.suppliers.list', $data);
    }

    public function store(SupplierRequest $request)
    {
        try {
            $supplier = $this->supplier->create([
                'name' => $request->name,
                'email' => $request -> email,
                'phone_number' => $request -> phone_number,
                'address' => $request -> address,
                'active' => $request -> active,
                'created_at' => now()
            ]);
            return response() -> json([
                'id' => $supplier -> id,
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

    public function edit($id){
        $data = [
            'supplier' => Supplier::find($id),
            'title' => 'Chỉnh sửa nhà cung cấp'
        ];
        return view('admin.suppliers.edit', $data);
    }

    public function update(Request $request, $id){
        try {
            $this->supplier->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'active' => $request->active,
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
        return $this->DeleteModelTrait($id, $this->supplier);
    }
}
