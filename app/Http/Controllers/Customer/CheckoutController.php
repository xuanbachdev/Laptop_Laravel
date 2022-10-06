<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    protected $orders, $orderdetails;

    public function __construct(Order $orders, OrderDetail $orderDetails)
    {
        $this->orders = $orders;
        $this->orderdetails = $orderDetails;
    }

    public function index()
    {
//        if (Cart::count() == 0) return back();
        if(Auth::check()){
            $categorysLimit = Category::where('parent_id', 0)->get();
            return view('client.checkout.checkout', compact('categorysLimit'));
        }
        return to_route('customer.login');
    }

    public function DeleteCoupon(){
        $coupon =Session::get('coupon');
        if($coupon){
            Session::forget('coupon');
            return back()->with('message','Xóa mã khuyến mãi thành công!');
        }else{
            return back()->with('error','Không tồn tại mã giảm giá!');
        }
    }

    public function postCheckout(Request $request)
    {
        $data=$request->all();
//        dd($request->all());


        //process customer
        $addressInput = $request->input('address');
        $address = $addressInput;
        $customerInput = $request->all( 'user_id', 'name', 'email', 'phone_number');
        $customerInput['address'] = $address;
        $customers = Customer::where('user_id',  Auth::user()->id)->where('email',$customerInput['email'])
            ->where('phone_number',$customerInput['phone_number'])->where('name',$customerInput['name'])->first();
        if (!$customers) {
            $customers = Customer::create($customerInput);
            $customers['created_at'] = now();
        }
//        dd($customers);

//        If user has account
//        Save cart info + user account in table orders
        $cart = Session::get('cart');
        if($cart){
            if(Auth::check()){
                DB::beginTransaction();
//                Insert into customers table
                //process order detail
                $productIDs = $request->product_id;
//                dd($productIDs);
                $qty = $request->input('qty');
                $details = [];
                for ($i = 0; $i < count($productIDs); $i++) {
                    $product =  Product::findOrFail($productIDs[$i]);
                    $product->decrement('quantity',$qty[$i]);

//                     dd($product);
                    //process promotions
                    $price = $product->price;
                    $order_coupon = Session::get('coupon');
                    $total = 0;
                    $sale_price = $product->sale_price;
                    $discount = $price-($price * (100 - $sale_price)) /100;
//                    dd($product[$i]->sale_price);
//                    dd($qty[$i]);

                    $details[] = [
                        'product_id' => $product->id,
                        'quantity' => $qty[$i],
                        'price' => $price,
                        'created_at' => now(),
                        'discounted' => $discount,
                        'final_price' => ($price - $discount) * $qty[$i]
                    ];
                    foreach($cart->products as $or=>$or_detail){
                        $total += ($or_detail['price']*$or_detail['quanty']);
                        $cart_array[] = array(
                            'product_name' => $or_detail['productInfo']->name,
                            'product_price' => $or_detail['price'],
                            'product_qty' => $or_detail['quanty']
                        );
//                        $details->save();
                    }
//                    dd($or_detail);
//                    dd($total);

                }
//                 dd($details);
//                Insert in orders table
                $orderCode = 'HD'.substr($customers->phone_number,6).\Str::random(6);
                $order = Order::create([ 'order_code' => $orderCode, 'customer_id' => $customers->id,'phone_number'=>$request->input('phone_number'), 'payment'=> $request->order_checkout_pay_method,  'address' => $address, 'created_at' => now()]);
//dd($order);
                $result = $order->detail()->createMany($details);
                if(isset($order_coupon)){
                    foreach($order_coupon as $co=>$cou){
                        if($cou['coupon_type']==1){
                            $discount = $cou['coupon_amount'];
//                            dd($coupon);
                        }else{
                            $discount = $total*($cou['coupon_percent']/100);
                        }
                        $update_coupon=Coupon::find($cou['coupon_id']);
                        $update_coupon->coupon_quantity -=1;
                        $update_coupon->save();
                        $coupon_code=$cou['coupon_code'];
                        break;
                    }
                    $order->total_money=$total-$discount;
                    $order->order_discount = $discount;
                    $order->save();
                }else{
                    $coupon_code = null;
                    $discount = 0;
                    $order->total_money = $total ;
                    $order->order_discount = $discount;
                    $order->save();
                }


                //send mail
                $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
                $to_name="LAPTOP VIP";
                $title_mail = "Đơn Hàng Mới Từ LAPTOP SHOP".' - Mã Đơn Hàng: '.$orderCode;
                $customer = Customer::find(Auth::user()->id);
                $data['email'] = $customer->email;
//                dd($data['name']);
                $shipping_array = array(
                    'discount' =>  $discount,
                    'customer_name' => $customer->name,
                    'customer_address' => $customer->address,
                    'customer_phone' => $customer->phone_number,
                    'customer_email' => $customer->email,
                    'shipping_name' => $data['name'],
                    'shipping_day' => $now,
                    'shipping_email' => $data['email'],
                    'shipping_phone' => $data['phone_number'],
                    'shipping_address' => $data['address'],
                    'shipping_notes' => $data['order_checkout_note'],
                    'shipping_method' => $data['order_checkout_pay_method']

                );
//                dd($shipping_array);
                //lay ma giam gia, lay coupon code
                $orderCode_Mail = array(
                    'coupon_code' => $coupon_code,
                    'order_code' => $orderCode,
                );
//                dd($orderCode_Mail);
                Mail::send('client.mail.send_mail_order',  compact('order','shipping_array', 'orderCode_Mail' ), function($message) use ($to_name,$title_mail,$data){
                    $message->to($data['email'])->subject($title_mail);//send this mail with subject
                    $message->from($data['email'],$to_name,$title_mail);//send from this mail
                });
                DB::commit();
                //clear shopping cart
                Session::forget('cart');
                Session::forget('coupon');
//                dd($order);

                return to_route('customer.profile')->with('success', 'Đặt hàng thành công, vui lòng kiểm tra email để theo dõi tình trạng đơn hàng');

            }
        }

    }




}
