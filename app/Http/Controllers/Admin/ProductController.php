<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recursive;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Cpu;
use App\Models\Gpu;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Supplier;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ProductController extends Controller
{
    use StorageImageTrait, DeleteModelTrait;
    protected $categories;
    protected $product;
    protected $productimage;
    protected $tag;
    protected $producttag;
    protected $supplier;
    protected $capacity;
    protected $cpuList;
    protected $gpuList;
    protected $screenTypes;
    protected $screenSizes;
    protected $statusList;
    public function __construct(Category $categories, Product $products, ProductImage $productimage,Tag $tag, ProductTag $producttag, Supplier $suppliers)
    {
        $this->products = $products;
        $this->productimage = $productimage;
        $this->tag = $tag;
        $this->producttag = $producttag;
        $this->suppliers = $suppliers;
        $this->capacity = ["32GB", "64GB", "120GB", "128GB", "240GB", "256GB", "512GB", "1TB", "2TB"];
        $this->screenTypes = ['TN', 'IPS', 'WVA', 'OLED', 'RETINA'];
        $this->screenSizes = ["11.1", "13", "13.5", "14", "15.6", "16", "17", "19", "20", "21"];
        $this->cpuList = CPU::all();
        $this->gpuList = GPU::all();
        $this->categories = $categories;
        $this->statusList= ['Hết hàng','Sắp về','Đang kinh doanh','Không kinh doanh'];
    }

    public function index()
    {
        $data = [
          'title' => 'Danh sách sản phẩm',
            'listProduct' => $this->products->all()
        ];
        return view('admin.products.list', $data);
    }

    public function getCategory($parentId)
    {
        $data = $this->categories->all();
        $recusive =  new Recursive($data);
        $htmlOption = $recusive->Recursive($parentId);
        return $htmlOption;
    }

    public function create()
    {
        $data = [
            'title' => 'Thêm sản phẩm',
            'capacity' => $this->capacity,
            'cpuList' => $this->cpuList,
            'gpuList' => $this->gpuList,
            'screenTypes' => $this->screenTypes,
            'screenSizes' => $this->screenSizes,
            'listSupplier' => $this->suppliers->all(),
            'statusList' => $this->statusList,
            'htmlOption' => $this->getCategory($parentId = '')
        ];
        return view('admin.products.add', $data);
    }

    protected function isValidPrice($request)
    {
        if ($request->price != 0 && $request->price_sale != 0
            && $request-> price_sale >= $request->price)
        {
            \Session::flash('error', 'Giá khuyến mãi phải nhỏ hơn giá gôc');
            return false;
        }

        if ($request->price_sale != 0 && $request->price == 0) {
            \Session::flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'slug' => \Str::slug($request->name),
                'user_id' => Auth::guard('admin')->user()->id,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplierId,
                'quantity' => $request->quantity,
                'sku' => $request->sku,
                'hot' => $request->hot,
                'memory' => $request->memory,
                'memory_capacity' => $request->memory_capacity,
                'ssd_storage' => $request->ssd_storage,
                'ssd_capacity' => $request->ssd_capacity,
                'hdd_storage' => $request->hdd_storage,
                'hdd_capacity' => $request->hdd_capacity,
                'cpu_id' => $request->cpu,
                'gpu_id' => $request->gpu,
                'screen_type' => $request->screen_type,
                'screen_size' => $request->screen_size,
                'screen_detail' => $request->screen_detail,
                'case_material' => $request->case_material,
                'webcam' => $request->webcam,
                'bluetooth' => $request->bluetooth,
                'wifi' => $request->wifi,
                'connection_port' => $request->connection_port,
                'keyboard' => $request->keyboard,
                'battery' => $request->battery,
                'color' => $request->color,
                'addition' => $request->addition,
                'operating_system' => $request->operating_system,
                'description' => $request->description,
                'product_status' => $request->product_status,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'size' => $request->size,
                'weight' => $request->weight,
                'package' => $request->package,
                'warranty_time' => $request->warranty_time,
                'created_at' => now()
            ];
//dd($dataProductCreate);
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'uploads/product/');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            //thêm thông tin vào bảng product
            $product = $this->products->create($dataProductCreate);
            //thêm thông tin vào bảng product_image
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'uploads/images/');
                    $product->productImage()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                        'created_at' => now()
                    ]);
                }
            }
//            dd($product);

            //thêm thông tin vào bảng tag
            $tagId = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    //thêm vào bảng tag
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagId[] = $tagInstance->id;
                }
                $product->tags()->attach($tagId);
                DB::commit();
                return to_route('products.view')->with('success', 'Thêm sản phẩm thành công');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Thêm sản phẩm thất bại');
        }
    }

    public function updateQuantity(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->increment('quantity',$request->input('quantity'));
        return back()->with('success', 'Thêm số lượng sản phẩm thành công');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $data = [
            'title' => 'Chỉnh sửa sản phẩm',
            'capacity' => $this->capacity,
            'cpuList' => $this->cpuList,
            'gpuList' => $this->gpuList,
            'screenTypes' => $this->screenTypes,
            'screenSizes' => $this->screenSizes,
            'listSupplier' => $this->suppliers->all(),
            'statusList' => $this->statusList,
            'htmlOption' => $this->getCategory($product->category_id)
        ];
        return view('admin.products.edit',compact('product'), $data);
    }


    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'slug' => \Str::slug($request->name),
                'user_id' => Auth::guard('admin')->user()->id,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplierId,
                'quantity' => $request->quantity,
                'sku' => $request->sku,
                'hot' => $request->hot,
                'memory' => $request->memory,
                'memory_capacity' => $request->memory_capacity,
                'ssd_storage' => $request->ssd_storage,
                'ssd_capacity' => $request->ssd_capacity,
                'hdd_storage' => $request->hdd_storage,
                'hdd_capacity' => $request->hdd_capacity,
                'cpu_id' => $request->cpu,
                'gpu_id' => $request->gpu,
                'screen_type' => $request->screen_type,
                'screen_size' => $request->screen_size,
                'screen_detail' => $request->screen_detail,
                'case_material' => $request->case_material,
                'webcam' => $request->webcam,
                'bluetooth' => $request->bluetooth,
                'wifi' => $request->wifi,
                'connection_port' => $request->connection_port,
                'keyboard' => $request->keyboard,
                'battery' => $request->battery,
                'color' => $request->color,
                'addition' => $request->addition,
                'operating_system' => $request->operating_system,
                'description' => $request->description,
                'product_status' => $request->product_status,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'size' => $request->size,
                'weight' => $request->weight,
                'package' => $request->package,
                'warranty_time' => $request->warranty_time,
                'updated_at' => now()
            ];

            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'uploads/product/');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            //Sửa thông tin trong bảng product
            $this->products->find($id)->update($dataProductUpdate);
            $product = $this->products->find($id);
            //thêm thông tin vào bảng product_image
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'uploads/images/');
                    $product->productImage()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                        'updated_at' => now()
                    ]);
                }
            }

            //thêm thông tin vào bảng tag
            $tagId = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    //thêm vào bảng tag
                    $tagInstance = $this->tag->updateOrCreate(['name' => $tagItem]);
                    $tagId[] = $tagInstance->id;
                }
                $product->tags()->sync($tagId);
                DB::commit();
                return to_route('products.view')->with('success', 'Sửa sản phẩm thành công');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Sửa sản phẩm thất bại');
        }
    }


    public function destroy($id)
    {
        return $this->deleteModelTrait($id, $this->products);
//        $path = public_path('uploads/product'.date('d-m-Y'). $product->feature_image_path);
//        if(isset($product)){
//            if(File::exists($path)){
//                unlink($path);
//            }
//            return back();
//        }
//        else{
//            return back()->with('error', 'Xóa thất bại');
//        }
    }
}
;
