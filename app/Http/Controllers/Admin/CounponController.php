<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

class CounponController extends Controller
{

    use DeleteModelTrait;
    private $coupons;
    public function __construct(Coupon $coupons)
    {
        $this->coupons = $coupons;
        $this->typeList = ['Phần trăm', 'Số tiền'];
    }

    public function index()
    {
        $data =[
          'title' => 'Quản lý khuyến mãi',
            'coupons' => Coupon::all()
        ];
        return view('admin.coupons.list', $data);
    }

    public function create(){
        $data =[
            'title' => 'Thêm mã khuyến mãi',
            'typeList' => $this->typeList
        ];
        $this->checkCoupon();
        return view('admin.coupons.add', $data);
    }

    public function checkCoupon()
    {
        $today= date('d-m-Y');
        $coupons = Coupon::all();
        if($coupons->count() > 0){
            foreach ($coupons as $key => $value){
                if($value->expired_at <= $today){
                    if($value->coupon_quantity <= 0){
                        $coupon_update = Coupon::findOrFail($value->id);
                        $coupon_update->status = -2;
                        $coupon_update->save();
                    }
                    else{
                        $coupon_update = Coupon::findOrFail($value->id);
                        $coupon_update->status = -1;
                        $coupon_update->save();
                    }
                }
            }
        }
    }

    protected function isValidateDay($request)
    {
        $today = date("Y-m-d");
        if ($request->start_day != 0 && $request->expired_at != 0
            && $request-> start_day >= $request->expired_at)
        {
            \Session::flash('error', 'Ngày bắt đầu phải nhỏ hơn ngày kết thúc');
            return false;
        }

        elseif($request->expired_at < $today) {
            \Session::flash('error', 'Ngày kết thúc phải lớn hơn ngày hiện tại');
            return false;
        }
        return true;
    }

    public function store(Request $request){
//        $request->validate([
//
//        ], [
//
//        ]);
        $today = date("Y-m-d");
        $this->isValidateDay();
        $dataCreate = [
            'name' => $request->name,
            'code' => $request->code,
            'type' => $request->type,
            'discount_percent' => $request->discount_percent,
            'discount_amount' => $request->discount_amount,
            'coupon_quantity' => $request->counpon_quantity,
            'start_day' => $request->start_day,
            'expired_at' => $request->expired_at,
            'created_at' => now()
        ];
        if($request->start_day > $today){
            $dataCreate->status = 0;
        }elseif($request->start_day == $today){
            $dataCreate->status = 1;
        }

        $result = Coupon::create($dataCreate);
        if ($result) {
            return to_route('coupons.view')->with('success', 'Đã thêm chương trình khuyến mại!');
        } else {
            return back()->with('error', 'Có lỗi xảy ra!');
        }
    }
    public function edit($id){
        $data =[
            'title' => 'Sửa mã khuyến mãi',
            'typeList' => $this->typeList,
            'coupons' => Coupon::findOrFail($id)
        ];
        return view('admin.coupons.edit', $data);
    }

    public function update(Request $request, $id){
        try {
            $dataUpdate = [
                'name' => $request->name,
                'code' => $request->code,
                'type' => $request->type,
                'coupon_quantity' => $request->coupon_quantity,
                'discount_percent' => $request->discount_percent,
                'discount_amount' => $request->discount_amount,
                'start_day' => $request->start_day,
                'expired_at' => $request->expired_at,
                'updated_at' => now()
            ];
           $this->coupons->find($id)->update($dataUpdate);
                return to_route('coupons.view')->with('success', 'Cập nhập chương trình khuyến mãi thành công!');

        }catch (\Exception $exception){
            \Log::error('Lỗi : ' . $exception->getMessage() . '---Line: ' . $exception->getLine());
            return back()->with('error', 'Có lỗi xảy ra!');
        }
    }

    public function destroy($id){
        return $this->deleteModelTrait($id, $this->coupons);
    }

}
