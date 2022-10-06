<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Cpu;
use App\Models\Gpu;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductDetail($slug){
        $categorysLimit = Category::where('parent_id', 0)->take(20)->get();
        $products  = Product::where('slug', $slug)->first();
        $product_id = $products->id;
        $comment_customer=Comment::where('product_id',$product_id)->where('feedback','=',0)->where('status',1)->get();
        $comment_admin=Comment::with('Product')->where('feedback','>',0)->get();
        if($products){
            return view('client.products.product_detail', compact('products', 'categorysLimit', 'comment_customer', 'comment_admin'));
        }
        return abort('404', 'Không tìm thấy sản phẩm');
    }

    public function searchProduct()
    {
        $categorysLimit = Category::where('parent_id', 0)->take(20)->get();
        $products = Product::with('cpu','gpu')->where('status',1);
        $searchKey = request()->query('q');
        $sortKey = request()->query('sort');
        $categoryID = request()->query('category_id');
        $price =  request()->query('price');
        $cpus =  request()->query('cpu_id');
        $gpus =  request()->query('gpu_id');
        $ram =  request()->query('ram');
        $screen =  request()->query('screen');
        $ssd =  request()->query('ssd');
        $hdd =  request()->query('hdd');

        $queryString = "";
        if($categoryID){
            $cat = Category::find($categoryID);
            $products = $cat->product();

        }
//        dd($products);
        if ($searchKey) {
            $products = $products->where('name', 'like', '%' . $searchKey . '%')->orWhere('sku', 'like', '%' . $searchKey . '%');
        }
        if($cpus){
            $products = $products->join('cpus','products.cpu_id','=','cpu.id')->whereIn('cpu.series',$cpus);

        }
        if($ram){
            $products = $products->whereIn('memory_capacity',$ram);
        }
        if($screen){
            $products = $products->whereIn('screen_size',$screen);
        }
        if($ssd){
            $products = $products->whereIn('ssd_capacity',$ssd);
        }
        if($hdd){
            $products = $products->whereIn('hdd_capacity',$hdd);
        }
        if($price && $price[0] && $price[1]){
            $products = $products->where('price','>=',$price[0])->where('price','<=',$price[1]);

        }
        if($gpus){
            $products = $products->join('gpus','products.gpu_id','=','gpus.id')->whereIn('gpus.name',$gpus);

        }

        if ($sortKey && ($sortKey == 'asc' || $sortKey == 'desc')) {
            $products = $products->orderBy('[price]', $sortKey);
        }


        $products = $products->paginate(6,['products.*']);
//         dd($products);
        // $products = $products->where('status',1)->where('stock','>',0)->paginate(6);
        //xử lý query string
        if($cpus){
            $products->appends(['cpu_id' => $cpus]);
            $queryString.= join(array_map(function($item){
                return '&cpu[]='.$item;
            },$cpus));
        }
        if($gpus){
            $products->appends(['gpu_id' => $gpus]);
            $queryString.= join(array_map(function($item){
                return '&gpu[]='.$item;
            },$gpus));
        }
        if($ram){
            $products->appends(['ram'=>$ram]);
            $queryString.= join(array_map(function($item){
                return '&ram[]='.$item;
            },$ram));
        }
        if($screen){
            $products->appends(['screen'=>$screen]);
            $queryString.= join(array_map(function($item){
                return '&screen[]='.$item;
            },$screen));
        }
        if($ssd){
            $products->appends(['ssd'=>$ssd]);
            $queryString.= join(array_map(function($item){
                return '&ssd[]='.$item;
            },$ssd));
        }
        if($hdd){
            $products->appends(['hdd'=>$hdd]);
            $queryString.= join(array_map(function($item){
                return '&hdd[]='.$item;
            },$hdd));
        }
        if($price){
            $products->appends(['price' =>$price]);
            $queryString.= '&price[]='.$price[0].'&price[]='.$price[1];
        }
        if($categoryID){
            $products->appends(['catalog'=>$categoryID]);
            $queryString.="&catalog=$categoryID";
        }
        if ($searchKey) {
            $products->appends(['q' => $searchKey]);
        }
        if ($sortKey && ($sortKey == 'asc' || $sortKey == 'desc')) {
            $products->appends(['sort' => $sortKey]);
        }

        //xử lý dữ liệu filter
        $filters = collect([
            'cpus' => CPU::distinct()->has('product')->get('series')->toArray(),
            'gpus' => GPU::has('product')->get('name')->toArray(),
            'ram'  => Product::distinct()->get('memory_capacity')->toArray(),
            'screen' => Product::distinct()->get('screen_size')->toArray(),
            'ssd' => Product::distinct()->get('ssd_capacity')->toArray(),
            'hdd' => Product::distinct()->get('hdd_capacity')->toArray(),
        ]);
        // dd($filters);


        return view('client.products.store', ['categorysLimit' => $categorysLimit, 'products' => $products, "queryString"=>$queryString,'filters'=>$filters]);
    }

    public function liveSearch(){
        $searchKey = request()->query('q');
        $data = [];
        if($searchKey!=null && $searchKey!=''){
            $products = Product::where('name','like','%'.$searchKey.'%')->orWhere('sku','like','%'.$searchKey.'%')->offset(0)->limit(6)->get();
            foreach($products as $item){
                $data[]=[
                    'name' => $item->name,
                    'image' => asset('storage/'.$item->card_image),
                    'link' => route('products.show',$item->slug),
                    'sku' => $item->sku
                ];
            }
            return response()->json($data);
        }
        return abort(404,'Empty key');
    }


}
