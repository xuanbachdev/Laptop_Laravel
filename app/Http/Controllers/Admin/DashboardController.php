<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Date;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Ngày trong tháng
        $listDate = Date::getListDayInMonth();
        $arrDailyMoney = [];
        $statusTrans = [
            [
                'Hoàn thành', false
            ],
            [
                'Đang vận chuyển', false
            ],
            [
                'Đang chờ',  false
            ]
        ];
        $data = [
            'title' => 'Quản trị hệ thống',
            'content_header' => 'Thống kê',
            'listDate'  => json_encode($listDate),
            'arrDailyMoney'  => json_encode($arrDailyMoney),
            'statusTrans'  => json_encode($statusTrans),
        ];

        return view('admin.dashboard', $data, );
    }

    public function dashboard()
    {
        $products =  Product::offset(0)->limit(6)->orderBy('created_at', 'desc')->get();
        $orderStatus = ['Chờ xác nhận', 'Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng', 'Đã hủy'];
        $orderStatusColor = ['yellow', 'orange', 'blue', 'green', 'red'];
        $newOrders = Order::with('detail', 'customer')->offset(0)->limit(6)->orderBy('created_at','desc')->get();
        $totalProduct = Product::count();
        $totalOrder = Order::withTrashed()->count();
        $totalUser = User::count();
        $totalSoldProduct = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')->where('status', '!=', '4')->sum('quantity');
        // dd($totalProduct);
        DB::enableQueryLog();
        $bestSellerProducts = Product::withTrashed()->leftJoin('order_details','order_details.product_id','=','products.id')
            ->leftJoin('orders','order_details.order_id','=','orders.id')
            ->select(DB::raw('products.* , ifnull(sum(order_details.quantity),0) as sold_qty'))
            ->where('orders.status','!=',4)
            ->groupBy('products.id')
            ->orderBy('sold_qty','desc')->get();
        // dd([DB::getQueryLog(),$bestSellerProducts]);
        $report = [];


        $orders = Order::withTrashed()->with('detail');

        $countOrderData = DB::table('orders')->select([DB::raw('date(created_at) as day'), DB::raw('count(id) as orders')]);

        if (request()->query('reportBy')) {
            $now = Carbon::now();

            if (request()->query('reportBy') == 'month') {
                $firstDay = new Carbon('first day of this month');
                $countOrderData = DB::table('orders')->select([DB::raw('day(created_at) as day'), DB::raw('count(id) as orders')]);
            } else {
                $firstDay =  new Carbon();
                $firstDay->startOfWeek();
                $countOrderData = DB::table('orders')->select([DB::raw('dayname(created_at) as day'), DB::raw('count(id) as orders')]);
            }
            $orders = $orders->whereBetween('created_at', [$firstDay->format('Y-m-d') . ' 00:00:00', $now->format('Y-m-d') . ' 23:59:59']);
            $countOrderData->whereBetween('created_at', [$firstDay->format('Y-m-d') . ' 00:00:00', $now->format('Y-m-d') . ' 23:59:59']);
        }

        $orders = $orders->get();
        // dd($orders->count());
        $getTurnOver = function () use ($orders) {
            $sum = 0;
            foreach ($orders  as $order) {
                $sum += $order->detail()->sum('final_price');
            }
            return $sum;
        };
        $getRaw = function () use ($orders) {
            $sum = 0;
            foreach ($orders as $order) {
                $details = $order->detail;
                foreach ($details as $detail) {
                    $product = $detail->product()->first();
                    $sum += $product->price;
                }
            }

//            dd($orders);

//            dd($product->price);
            return $sum;
        };

        $report = [
            'orders' => $orders,
            'waiting' => $orders->where('status', 0)->count(),
            'accepted' => $orders->where('status', 1)->count(),
            'shipping' => $orders->where('status', 2)->count(),
            'received' => $orders->where('status', 3)->count(),
            'canceled' => $orders->where('status', 4)->count(),
            'turnOver' => $getTurnOver(),
            'raw' => $getRaw()
        ];


        // dd([DB::getQueryLog(),$report]);
        //xử lí dữ liệu biểu đồ
        $countOrderDataResult = $countOrderData->groupBy('day')->get();
        $countReceivedOrderData = $countOrderData->where('status',3)->get();
        // dd($countOrderDataResult);
        $data = [
            'title' => 'Quản trị hệ thống',
            'content_header' => 'Thống kê',
            'products' => $products,
            'orderStatus' => $orderStatus,
            'newOrders' => $newOrders,
            'orderStatusColor' => $orderStatusColor,
            'totalProduct' => $totalProduct,
            'totalOrder' => $totalOrder,
            'totalUser' => $totalUser,
            'totalSoldProduct' => $totalSoldProduct,
            'report' => $report,
            'countOrderDataResult' => $countOrderDataResult,
            'countReceivedOrderData' =>$countReceivedOrderData,
            'bestSeller' => $bestSellerProducts

        ];


        return view("admin.dashboard", $data);
    }

}
