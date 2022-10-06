<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    private $order, $product, $orderDetail;

    public function __construct(Order $order, Product $product, OrderDetail $orderDetail)
    {
        $this->order = $order;
        $this->product = $product;
        $this->orderDetail = $orderDetail;
        $this->statusArray = ['Chờ xác nhận', 'Đã xác nhận', 'Đang giao hàng', 'Đã giao hàng', 'Đã hủy'];
        $this->colorLabel = ['yellow', 'orange', 'blue', 'green', 'red'];
    }

    public function getPrint($id)
    {
        $order = $this->order->findOrFail($id);
        if (!$order) {
            return abort(404);
        } else {
            $data = [
                'title' => 'In đơn hàng',
                'statusArray' => $this->statusArray,
                'colorLabel' => $this->colorLabel,
                'order' => $order,
                'order_coupon' => Coupon::find($id)

            ];

            return view('admin.order_management.print_order', $data);
        }
    }
}
