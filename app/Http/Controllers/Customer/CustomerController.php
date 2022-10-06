<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerLoginRequest;
use App\Http\Requests\RegisterCustomerRequest;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\User;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
class CustomerController extends Controller
{
    use StorageImageTrait;
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getLoginCustomer()
    {
        $categorysLimit = Category::where('parent_id', 0)->take(20)->get();
        if(Auth::check()){
            return to_route('home.index');
        }
        return view('client.customer.login', compact('categorysLimit'));
    }

    public function postLoginCustomer(CustomerLoginRequest $request){
        if(Auth::attempt(['email' => $request->customer_email_login, 'password' => $request->customer_password_login])){
            return to_route('home.index');
        }
        return back()->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
    }

    public function checkLoginCustomer(Request $request)
    {
        $customer_email=$request->customer_email_login;
        $customer_password=bcrypt($request->customer_password_login);
        $email=User::where('email',$customer_email)->first();
        $this->validate($request,[
            'customer_email_login' => 'required|email|max:255',
            'customer_password_login' => 'required|max:255|min:6'
        ],
            [
                'customer_email_login.required' => 'Email không được để trống',
                'customer_email_login.email' => 'Email sai định dạng',
                'customer_password_login.min' => 'Mật khẩu quá ngắn',
            ],);
        if(!$email){
            return Redirect::to('/login-customer')->with('error','Tài khoản không tồn tại!');
        }else{
            if($email->password != $customer_password){
                $user_login_fail=User::find($email->id);
                $user_login_fail->user_login_fail +=1;
                $user_login_fail->save();
                return Redirect::to('/login-customer')->with('error','Mật khẩu không chính xác!');
            }else{
                if($email->user_login_fail >= 5){
                    return Redirect::to('/show-verification-password-customer')->with('error','Bạn đã đăng nhập sai quá số lần quy định, nhập email của bạn để đặt lại mật khẩu!');
                }else{
                    if($email->loainguoidung_id !=4){
                        return Redirect::to('/login-customer')->with('error','Không được phép truy cập');
                    }else{
                        $user_login_fail=User::find($email->id);
                        $user_login_fail->user_login_fail = 0;
                        $user_login_fail->save();
                        $customer=User::where('khachhang_email',$email->user_email)->first();
                        $customer_update=Customer::find($customer->id);
                        $customer_update->user_id=$email->id;
                        $customer_update->save();
                        Session::put('customer_name',$email->user_ten);
                        Session::put('user_id',$email->id);
                        Session::put('customer_id',$customer->id);
                        if(redirect()->back()==Redirect::to('/login-customer')){
                            return Redirect::to('/');
                        }else{
                            return redirect()->back();
                        }
                    }
                }
            }
        }
    }

    public function getRegister()
    {
        $categorysLimit = Category::where('parent_id', 0)->take(20)->get();
        return view('client.customer.register', compact('categorysLimit'));
    }

    public function getVerificationEmail()
    {
        $categorysLimit = Category::where('parent_id', 0)->take(20)->get();
        return view('client.customer.verification_email', compact('categorysLimit'));
    }

    public function verificationEmailCustomer(Request $request)
    {
        $data=$request->all();
        $now=time();
        $get_email_user=User::where('email',$data['verification_email'])->first();
        $request->validate([
            'verification_email' => 'bail|required|email'
        ], [
            'verification_email.required' => 'Vui lòng nhập email',
            'verification_email.email' => 'Email không đúng định dạng',
        ]);

        if($get_email_user){
            return redirect()->back()->with('error','Email đã tồn tại! Vui lòng nhập email khác');
        }else{
            $verification_code=substr(str_shuffle(str_repeat("QWERTYUIOPLKJHGFDSAZXCVBNMqwertyuioplkjhgfdsazxcvbnm", 5)), 0,5).substr(str_shuffle(str_repeat("0123456789", 5)), 0,5);
            $to_name="LAPTOP STORE";
            $to_mail=$data['verification_email'];
            $title_mail = "Mã Xác Thực Từ LAPTOP SHOP";
            $data=array("name"=>"LAPTOP SHOP","code"=>$verification_code);
            $verification[] = array(
                'verification_time' => $now + 300,
                'verification_code' => $verification_code,
                'verification_email' => $to_mail,
            );
            Session::put('verification_email',$verification);
            Mail::send('client.mail.send_mail',  $data, function($message) use ($to_name,$to_mail,$title_mail ){
                $message->to($to_mail)->subject($title_mail );//send this mail with subject
                $message->from($to_mail, $to_name,$title_mail );//send from this mail
            });
            return Redirect::to('/register-customer')->with('message','Chúng tôi đã gửi mã xác minh vào email của bạn, hãy nhập mã xác minh để đăng ký tài khoản!');
        }
    }

    public function registerCustomer(RegisterCustomerRequest $request)
    {
        $data=$request->all();
        $now=time();
        $verification = Session::get('verification_email');
//        dd($verification);
        if(!isset($verification)){
            return to_route('getVerificationEmail')->with('error','Nhập email của bạn để đăng ký!');
        }else{
            foreach($verification as $key=>$value){
                $verification_time=$value['verification_time'];
                $verification_code=$value['verification_code'];
                $verification_email=$value['verification_email'];
                break;
            }
            if($verification_code != $data['customer_verification_code_register'] || $verification_email != $data['email']){
                return Redirect::to('/register-customer')->with('error','Mã xác minh hoặc email không chính xác!');
            }elseif($now > $verification_time){
                Session::forget('verification_email_customer');
                return back()->with('error','Mã xác minh đã hết hạn!');
            }else{


                $options = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone_number'),
                    'address' => $request->input('address'),
                    'created_at' => now(),
                    'password' => Hash::make($request->input('password'))
                ];
                $user = User::create($options);
                if($user){
                    Auth::login($user,true);
                    return to_route('home.index');
//                    return to_route('customer.login')->with('success','Bạn đã tạo thành công tài khoản!');
                }else{
                    return back()->with('error','Có lỗi xảy ra!');
                }
            }
        }

    }

    public function customerLogout(){
//        if (Auth::check()) {
//            $accessToken = auth()->user()->setRememberToken("");
//            return back();
//        }
        Auth::logout();
        return to_route('customer.login')->with('success', 'Đăng xuất thành công');
    }

    public function getProfile()
    {
        $all_coupon_code = Coupon::where('status', 1)->get();
        if($all_coupon_code->count()>0){
            $all_coupon_code = Coupon::where('status', 1)->get();
            Session::forget('coupon');
        }else{
            $all_coupon_code=null;
        }
        $categorysLimit = Category::where('parent_id', 0)->get();
        $statusArray = ['Chờ xác nhận','Đã xác nhận','Đang giao hàng', 'Đã giao hàng', 'Đã hủy'];
        return view('client.customer.profile', compact('categorysLimit', 'all_coupon_code', 'statusArray'));
    }

    public function updateUserInfo(Request $request){
        try {
            //        $request->validate([
//            'customer_name' => ['required','min:5'],
//
//        ],[
//            'customer_name.required' => 'Tên không được bỏ trống!',
//            'customer_name.min' => 'Độ dài tên tối thiểu phải 5 ký tự!'
//
//        ]);

            $user = Auth::user();
            //xử lý cập nhật thông tin
//        dd($user);

            $options = [
                'name' => $request->input('customer_name'),
                'phone_number' => $request->input('customer_phone_number'),
                'email' => $request->customer_email,
                'address' => $request->input('customer_address'),
                'birthday' => $request->input('birthday'),
                'gender' => $request->input('customer_gender'),
                'updated_at' => now(),
            ];
            $dataImageAvatar = $this -> storageTraitUpload($request, 'avatar_path', 'uploads/avatars/');
            if(!empty($dataImageAvatar)){
                $options['avatar_name'] = $dataImageAvatar['file_name'];
                $options['avatar_path'] = $dataImageAvatar['file_path'];
            }
//            dd($dataImageAvatar);
            $user->update($options);

            return back()->with('success', 'Cập nhập thông tin thành công!');
        }catch (\Exception $exception){
            return back()->with('error', 'Cập nhập thông tin thất bại!');
        }
    }

    public function changePassword(Request $request){
        $user = Auth::user();
        $messages = [];
        //xử lý đổi mật khẩu
        $request->validate([
            'old_password' => ['bail','required','min:8'],
            'new_password' => ['bail','required','min:8'],
            'confirm_new_password' => ['bail','required','same:new_password']
        ],[
            'old_password.required' => 'Mật khẩu cũ không được để trống!',
            'new_password.required' => 'Mật khẩu mới không được để trống!',
            'confirm_new_password.required' => 'Xác nhận mật khẩu mới không được để trống!',
            'old_password.min' => 'Mật khẩu phải tối thiểu 8 ký tự',
            'new_password.min' => 'Mật khẩu phải tối thiểu 8 ký tự',
            'confirm_new_password.same' => 'Xác nhận mật khẩu thất bại!'
        ]);
        if($request->old_password){
            //kiểm tra mật khẩu chính xác
            Auth::user()->makeVisible('new_password');
            if(!(Hash::check($request->input('old_password'),Auth::user()->password))){
                $messages['old_password'] = 'Mật khẩu cũ không chính xác!';
                return back()->withErrors($messages)->withInput();
            }
            else if(strcmp($request->old_password, $request->new_password) == 0){
                return redirect()->back()->with('error', 'Mật khẩu mới trùng mật khẩu cũ!');

            }
            $user->update(['password' => Hash::make($request->input('new_password'))]);
            return back()->with('success', 'Cập nhập mật khẩu thành công!');
//            else{
//
//            }
        }
    }






}
