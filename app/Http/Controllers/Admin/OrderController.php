<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $statusArray;
    protected $colorLabel;
    public function __construct()
    {
        $this->statusArray = [ 'Chờ xác nhận', 'Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng','Đã hủy'];
        $this->colorLabel= ['yellow','orange','blue','green','red'];
    }

    public function index()
    {
        //
        DB::enableQueryLog();
        $orders = Order::orderBy('created_at','desc');
        $counts = [
            Order::where('status',0)->count(),
            Order::where('status',1)->count(),
            Order::where('status',2)->count(),
            Order::where('status',3)->count(),
            Order::where('status',4)->count(),
        ];
//        dd(request()->query('from'));
        if(request()->query('from')){

            $orders->whereBetween('created_at',[request()->query('from'),request()->query('to')]);
        }
        // dd(request()->query('status'));
        if(request()->query('status')!=null){
            if(request()->query('status')>=0){
                $orders->where('status',request()->query('status'));
            }
        }
        $orders =$orders->get();
//dd($orders);
//         dd(DB::getQueryLog());
        return view('admin.order_management.index',['statusArray'=>$this->statusArray,'orders'=>$orders,'colorLabel'=>$this->colorLabel,'counts'=>$counts, 'title' => 'Quản lý đơn hàng']);
    }

    public function show($id)
    {
        $data = [
            'title' => 'Cập nhập trạng thái đơn hàng',
            'order' => Order::findOrFail($id),
            'statusArray' => $this->statusArray,
            'colorLabel' => $this->colorLabel
        ];
        return view('admin.order_management.order_detail', $data);
    }

//    Hoàn thành đơn hàng

    public function orderComplete( $id)
    {
        $order = Order::findOrFail($id);
        $result = false;
        if(!$order->finished_at){
            $result= $order->update(['finished_at'=>DB::raw('CURRENT_TIMESTAMP')]);
        }
        if($result){
            return to_route('orders.index')->with('success','Đã xác nhận hoàn thành đơn hàng!');
        }else{
            return back()->with('error','Có lỗi xảy ra!');
        }
    }

    public function changeStatus(Request $request){
        $order = Order::findOrFail($request->input('order'));
        // trường hợp đơn hàng đã hoàn thành thì không thể thay đổi
        if($order->finished_at){
            return back()->with('error','Đơn hàng đã xác nhận hoàn thành, không thể thay đổi!');
        }

        //xử lí số lượng
        //trường hợp thay đổi từ trạng thái đã hủy sang trạng thái khác
        if($order->status==4){
            if($request->input('status')!=4){
                foreach($order->detail as $detail){
                    $detail->product()->first()->decrement('quantity',$detail->quantity);
                }
            }
        }
        //trường hợp hủy
        if($order->status!=4){
            if($request->input('status')==4){
                foreach($order->detail as $detail){
                    $detail->product()->first()->increment('quantity',$detail->quantity);
                }
            }
        }

        $order->status = $request->input('status');

        $order->admin_id = Auth::guard('admin')->user()->id;

        if($order->save()){
            return to_route('orders.index')->with('success','Đã thay đổi trạng thái đơn hàng!');
        }
        else{
            return back('error','Có lỗi xảy ra!');
        }
    }

    public function destroy($id)
    {
        //
        Order::destroy($id);
        return back()->with('success','Đã xóa đơn hàng!');
    }
}
