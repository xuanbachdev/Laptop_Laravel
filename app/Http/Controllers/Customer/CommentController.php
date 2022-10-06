<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CommentController extends Controller
{

    public function index()
    {
        $comment_customer=Comment::where('feedback', '=', 0)->orderby('id', 'DESC')->paginate(5);
        $comment_admin=Comment::where('feedback', '>', 0)->paginate(5);
        return view('admin.comments.index')->with(compact('comment_customer', 'comment_admin'));
    }
    public function PostCommentCustomer(Request $request)
    {
        $data=$request->all();
//        $this->validate($request,[
//            'review_name' => 'bail|required|max:255|min:1',
//            'review_comment' => 'bail|required|max:255|min:1'
//        ],
//            [
//                'review_comment.required' => 'Nội dung bình luận không được để trống',
//                'min' => 'Quá ngắn',
//                'max' => 'Quá dài'
//            ]);
        $customer = Auth::user()->id;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $comment_date = Carbon::now('Asia/Ho_Chi_Minh');
        if($data['review_name']==NULL || $data['review_comment']==NULL || $data['starRateV']==NULL){
            return redirect()->back()->with('error','Thêm đánh giá không thành công, vui lòng nhập đầy đủ các trường và chọn sao đánh giá!');
        }else{
            if($customer){
                $comment=new Comment();
                $comment->name=$data['review_name'];
                $comment->content=$data['review_comment'];
                $comment->points=$data['starRateV'];
                $comment->created_at=$comment_date;
                $comment->status=0;
                $comment->feedback=0;
                $comment->admin_id=0;
                $comment->user_id=$customer;
                $comment->product_id=$data['product_id'];
                $comment->save();
            }else{
                $comment=new Comment();
                $comment->name=$data['review_name'];
                $comment->content=$data['review_comment'];
                $comment->points=$data['starRateV'];
                $comment->created_at=$comment_date;
                $comment->status=0;
                $comment->feedback=0;
                $comment->admin_id=0;
                $comment->user_id=$customer;
                $comment->product_id=$data['product_id'];
                $comment->save();
            }
            return redirect()->back()->with('message','Đã thêm đánh giá thành công, đang chờ phê duyệt!');
        }
    }

    public function LoadComment(Request $request){
            $product_id=$request->comment_product_id;
            $comment_customer=Comment::where('product_id', $product_id)->where('feedback', '=', 0)->get();
            $comment_admin=Comment::with('Product')->where('feedback', '>', 0)->get();
            $output = '';
            foreach ($comment_customer as $key => $comment) {
                $output .= '
                <div class="product_info_inner ">
                    <div class="product_ratting mb-10 col-md-6">
                        <ul>';
                for ($count=1;$count<=5;$count++) {
                    if ($count <= $comment->points) {
                        $output .= '
                                    <i class="fa fa-star ratting_review"></i>
                                ';
                    } else {
                        $output .= '
                                    <i class="fa fa-star ratting_no_review"></i>
                                ';
                    }
                }
                $output .= '
                        </ul>
                        <strong>'.$comment->name.'</strong>
                        <p>'.$comment->created_at.'</p>
                        <p>'.$comment->content.'</p>
                    </div>
                    &emsp;&emsp;';
                foreach ($comment_admin as $k =>$ad_comment) {
                    if ($ad_comment->feedback==$comment->id) {
                        $output .= '
                            <div class="col-md-6">
                            <div class="product_demo">
                                <strong>Admin</strong>
                                <p>'.$ad_comment->content.'</p>
                            </div>
                        </div>
                            ';
                    }
                }
                $output .= '
                </div>
            ';
            }
            echo $output;
    }
}
