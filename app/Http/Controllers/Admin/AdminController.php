<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{


    use StorageImageTrait, DeleteModelTrait;
    private $admins;
    public function __construct(Admin $admins)
    {
        $this->admins = $admins;
    }

    public function index()
    {
        if (Auth::guard('admin')->user()->role_id != 1) abort(403);
        $data = [
            'title' => 'Quản lý khách hàng' ,
            'adminsList' => Admin::all()
        ];
        return view('admin.admin_management.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = $this->admins->first();
        $role = $admin->role->all();
        //check quyền root
        if (Auth::guard('admin')->user()->role_id != 1) abort(403);

        $data = [
            'title' => 'Thêm nhân viên' ,
            'admins' => $role
        ];
        return view('admin.admin_management.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        //check quyền root
        if (Auth::guard('admin')->user()->role_id != 1) abort(403);
        //

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->email = $request->email;
        $admin->role_id = $request->role_id;
        $dataImageAvatar = $this -> storageTraitUpload($request, 'avatar_path', 'uploads/admin/avatar/');
        if(!empty($dataImageAvatar)){
            $admin['avatar_name'] = $dataImageAvatar['file_name'];
            $admin['avatar_path'] = $dataImageAvatar['file_path'];
        }

        try {
            $result = $admin->save();
            if ($result) {
                return back()->with('success', "Đã tạo thành công Admin user: [username: $request->username,password: $request->password]!");
            } else {
                return back()->with('error', "Có lỗi xảy ra!");
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
            return back()->with('error', "Có lỗi xảy ra!" . " </br>Error:$message");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //check quyền root
        $admin = Admin::findOrFail($id);
        $role = $admin->role->get();
        if (Auth::guard('admin')->user()->role_id != 1) abort(403);
        //
        $data = [
            'title' => 'Sửa thông tin nhân viên' ,
            'admin' => Admin::findOrFail($id),
            'role' => $role
        ];

            return view('admin.admin_management.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //check quyền root
//        if (Auth::guard('admin')->user()->role_id != 1) abort(403);
        //


        try {
            $admin = Admin::find($id);
            if (Auth::guard('admin')->user()->role_id == 1){
                $admin->role_id =1;
            }
            else{
                $admin->role_id = $request->role_id;
            }
            $dataUpdate = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'updated_at' => now()
            ];
        $dataImageAvatar = $this->storageTraitUpload($request, 'image_path', 'uploads/admin/avatar/');
        if(!empty($dataImageAvatar)){
            $dataUpdate['avatar_name'] = $dataImageAvatar['file_name'];
            $dataUpdate['avatar_path'] = $dataImageAvatar['file_path'];
        }

           $admin->update($dataUpdate);
            return back()->with('success', 'Cập nhập thông tin thành công!');
        }catch (\Exception $exception){
            return back()->with('error', 'Cập nhập thông tin thất bại!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
//        //check quyền root
//        if (Auth::guard('admin')->user()->role_id != 1) abort(403);
//
//        $result = Admin::destroy($id);
//        if ($result) {
//            return back()->with('success', "Đã xóa Admin có id: $id");
//        }
        return $this->deleteModelTrait($id, $this->admins);
    }
}
