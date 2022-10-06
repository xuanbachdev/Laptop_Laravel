<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;

class CartController extends Controller
{



//    Thêm giỏ hàng
    public function showCart()
    {
        $categorysLimit = Category::where('parent_id', 0)->get();
        $carts = session()->get('cart');
        return view('client.cart.cart_detail', compact('carts', 'categorysLimit'));
    }

    public function addProductCart(Request $request, $id){
//        $this->DeleteCoupon();
////        session()->flush();
////        $data = $request->all();
//         $product = Product::findOrFail($id);
//         $price = $product->price;
//        $session_id = substr(md5(microtime()) . rand(0, 26), 5);
//         if($product->sale_price){
//            $price = $price * (100 - $product->sale_price) / 100;
//         }
//
//         if ($product->quantity == 0){
//             return back()->with('waring', 'Sản phẩm tạm hết hàng vui lòng chọn sản phẩm khác');
//         }
//
//         $cart = session()->get('cart');
//         if(isset($cart[$id])){
//             $cart[$id]['quantity']++;
//         }
//         else{
//             $cart[$id] = [
//               'session_id' => $session_id,
//               'name' => $product->name,
//               'price' => $price,
//               'quantity' => 1,
//               'image' => $product->feature_image_path,
//               'product_id' => $product->id,
//               'product_in_stock' => $product->quantity
//             ];
//         }
//         Session::put('cart', $cart);
//        $count_cart = Session::get('count_cart');
//        $count_cart++;
//        Session::put('count_cart', $count_cart);
////         echo '<pre>';
////         print_r(session()->get('cart'));
//        return view('layouts.clients.cart');

        $product = Product::findOrFail($id);
        if($product != null){
            $oldCart = Session::get('cart');
            $newCart = new Cart($oldCart);
            $newCart->AddCart($product, $id);

            Session::put('cart', $newCart);
            return view('layouts.clients.cart');
        }
        else{
            return response()->json([
               'code' => 500,
               'message' => 'Add to cart fail'
            ], 500);
        }
    }

//    public function updateCart(Request $request, $id)
//    {
//
//    }

    public function updateCart(Request $request, $id, $quantity){
//        $this->DeleteCoupon();
        $data=$request->all();
        $cart=Session::get('cart');
        if($cart==true){
            foreach($data['cart_quantity'] as $key => $value){
                    foreach($cart->products as $k=>$val){
                    if($val['session_id']==$key){
                        $product = DB::table('products')->where('id',$val['product_id'])->first();
                        if($product->quantity < $value){
                            $validate = 'Cập nhật số lượng sản phẩm '.$product->name . ' không thành công, số lượng quá lớn! Vui lòng nhập số lượng sản phẩm '.$product->name . ' nhỏ hơn hoặc bằng ' . $product->quantity;
                            return back()->with('error',$validate);
                        }else{
                            $val[$k]['quanty']=$value;

                        }
                    }
                        $quantity = $value;
                }
            }
            $newCart = new Cart($cart);
            $newCart->UpdateItemCart($id, $quantity);
            Session::put('cart', $newCart);
            Session::save();
//            dd($quantity);
//            $count_cart = Session::get('count_cart');
//
//            if($count_cart==0){
//                Session::forget('count_cart');
//            }elseif($count_cart>0){
////              dd($count_cart);
//                $count_cart = $count_cart;
////                dd($count_cart);
//                Session::put('count_cart', $count_cart);
//            }
            return back()->with('success','Cập nhật giỏ hàng thành công!');
        }else{
            return back()->with('error','Cập nhật giỏ hàng không thành công');
        }


//        return view('client.cart.list_cart');

    }

    public function deleteCart(Request $request, $id){
        $this->DeleteCoupon();
        $carts = Session('cart') ? Session('cart') : null;
        $newCart = new Cart($carts);
        $newCart->DeleteItemCart($id);
        if(Count( $newCart->products) > 0 ){
            Session::put('cart', $newCart);
            return response()->json([
                'code' => 200,
                'message' => 'Delete cart success'
            ], 200);
        }
        else{
            $request->Session()->forget('cart');
        }
    }

    public function delete_all_cart()
    {
        $this->DeleteCoupon();
        $cart = Session::get('cart');
        if($cart){
            Session:forget('cart');
            Session::forget('coupon');
            return back()->with('success', 'Xóa hết giỏ hàng thành công');
        }
    }

    public function DeleteCoupon(){
        $coupon =Session::get('coupon');
        if($coupon){
            Session::forget('coupon');
        }
    }

    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon==true){
            // Session::destroy();
            Session::forget('coupon');
            return back()->with('message','Xóa mã khuyến mãi thành công');
        }
    }

    public function CheckCoupon(Request $request){
        $data=$request->all();
        $now=time();
        $today = date("Y-m-d");
        if($data['cart_coupon'] =='' || !(Coupon::where('code',$data['cart_coupon'])->where('status', 1)->first())){
            $this->DeleteCoupon();
            return redirect()->back()->with('error', 'Mã giảm giá không tồn tại!');
        }else{
            if(Auth::check()){
                $coupon=Coupon::where('code',$data['cart_coupon'])
                    ->where('status', 1)
                    ->where('user_coupon_code', 'LIKE', '%' . Auth::check() . '%')
                    ->first();
                if ($coupon) {
                    return redirect()->back()->with('error', 'Mã giảm giá đã được sử dụng!');
                }else{
                    $coupon_login = Coupon::where('code', $data['cart_coupon'])
                        ->where('status', 1)
                        ->whereDate('start_day', '<=', $today)
                        ->whereDate('expired_at', '>=', $today)
                        ->where('coupon_quantity','>', 0)->first();
//                    dd($coupon_login);
                    if($coupon_login){
                        $coupon_session=Session::get('coupon');
                        if($coupon_session==true){
                            $is_ava=0;
                            foreach ($coupon_session as $key => $val) {
                                if ($val['coupon_code'] == $data['cart_coupon']) {
                                    $is_ava++;
                                }
                            }
                            if($is_ava==0){
                                $cou[]=array(
                                    'coupon_id' =>$coupon_login->id,
                                    'coupon_code' =>$coupon_login->code,
                                    'coupon_quantity' =>$coupon_login->coupon_quantity,
                                    'coupon_type' =>$coupon_login->type,
                                    'coupon_percent' =>$coupon_login->discount_percent,
                                    'coupon_amount' =>$coupon_login->discount_amount,
                                    'coupon_status' =>$coupon_login->status,
                                );
                                Session::put('coupon',$cou);
                            }
                        }else{
                            $cou[]=array(
                                'coupon_id' =>$coupon_login->id,
                                'coupon_code' =>$coupon_login->code,
                                'coupon_quantity' =>$coupon_login->coupon_quantity,
                                'coupon_type' =>$coupon_login->type,
                                'coupon_percent' =>$coupon_login->discount_percent,
                                'coupon_amount' =>$coupon_login->discount_amount,
                                'coupon_status' =>$coupon_login->status,
                            );
                            Session::put('coupon',$cou);
                        }
                        Session::save();
                        return redirect()->back()->with('message','Thêm mã giảm giá thành công');
                    }
                    else{
                        $this->DeleteCoupon();
                        $coupon_update=Coupon::where('code', $data['cart_coupon'])->first();
                        $coupon_update->status=-1;
                        $coupon_update->save();
                        return redirect()->back()->with('error','Thêm mã giảm giá không thành công, mã giảm giá đã hết hoặc đã hết hạn sử dụng!');
                    }
                }
            }
        }
    }
}
