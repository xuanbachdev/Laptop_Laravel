<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $data = [
            'slider' => Slider::where('type' , 1)->where('status', 1)->orderBy('position')->limit(8)->get(),
            'firstSlider' => Slider::where('type' , 1)->where('status', 1)->first() ,
            'banner' => Slider::where('type' , 1)->where('status', 2)->limit(5)->get(),
            'new_product' => Product::orderBy('created_at','desc')->where('product_status',2)->paginate(5),
            'highlight' => Product::where('hot',1)->paginate(5),
            'categorys' => Category::where('parent_id', 0)->get(),
            'categorysLimit' => Category::where('parent_id', 0)->take(20)->get(),
            'carts' => \Session::get('cart'),
        ];
        return view('client.home', $data);
    }

//    Cancel order
    public function cancelOrder($orderCode){
        $customer = Auth::user()->customer;
        $order = $customer->order()->withTrashed()->where('order_code',$orderCode)->first();
        if($order){
            $order->update(['status' => 4]);
            foreach($order->detail as $detail){
                $detail->product()->first()->increment('quantity',$detail->quantity);
            }
            return back()->with('success','Đã hủy đơn hàng');
        }else{
            return back()->with('error', 'Có lỗi xảy ra!');
        }
    }

    public function getProductCategory($slug, $id)
    {
        $data = [
            'categorys' => Category::where('parent_id', 0)->get(),
            'categorysLimit' => Category::where('parent_id', 0)->take(20)->get(),
            'product' => Product::where('category_id', $id)->paginate(12),
            'nameCategory' => Category::where('id', $id)->value('name')
        ];
        return view('client.category.index', $data);
    }

    public function getContact()
    {
        $data = [
            'title' => 'Liên hệ',
            'categorysLimit' => Category::where('parent_id', 0)->take(20)->get(),
        ];
        return view('client.contact.index', $data);
    }

    public function postPage()
    {
        $data = [
            'title' => 'Bài viết',
            'categorysLimit' => Category::where('parent_id', 0)->take(20)->get(),
            'posts' => Blog::where('status',1)->orderBy('created_at','desc')->paginate(6)
        ];
        return view('client.blog.index', $data);
    }

    public function showPost($slug){

        $post = Blog::where('slug',$slug)->first();

        if($post){
            return view('client.blog.blog_detail',['categorysLimit'=>Category::where('parent_id', 0)->take(20)->get(),'post'=>$post]);
        }else{
            abort(404);
        }
    }
}
