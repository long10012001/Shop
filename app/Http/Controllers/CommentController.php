<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Rating;
use Dotenv\Store\File\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function load_comment(Request $request)
    {
        // $this->is_login();
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)->get();
        $output = '';
        foreach ($comment as $comm) {
            $output .= '<div class=" container-fluid">
                            <div class="row mb-2 bg-gradient text-dark border">
                                <div class="col-md-12 p-0 mt-1 ml-2"><strong>' . $comm->comment_name   . '</strong></div>
                                <div class="col-md-9 p-0 ml-5">' . $comm->comment_content . '</div>
                                <div class="col-md-2 p-0 mr-0 mb-2">' . $comm->created_at . '</div>
                                
                            </div>
                    </div>';
        }
        echo $output;
    }

    public function send_comment(Request $request)
    {
        // $this->is_login();
        $product_id = $request->product_id;
        $content_comment = $request->content_comment;
        $user_comment = $request->user_comment;

        $comment = new Comment();
        $comment->comment_content = $content_comment;
        $comment->comment_name = $user_comment;
        $comment->comment_product_id = $product_id;
        $comment->save();
    }


    public function list_comment()
    {
        // $this->is_login();
        $list_comment = Comment::paginate(6);
        $count = Comment::count();
        $product = [];
        foreach ($list_comment as $comment) {
            $product[] = Product::where('id', $comment->comment_product_id)->first();
        }

        return view('admin.comment.list_comment')
            ->with('list_comment', $list_comment)
            ->with('count', $count)
            ->with('product', $product);
    }

    public function delete_comment($id)
    {
        $this->is_login();
        Comment::find($id)->delete();
        return Redirect('list_comment');
    }

    public function search_comment_admin()
    {
        $this->is_login();
        $key = $_GET['key'];
        $key_new = htmlspecialchars($key);
        $list_comment = Comment::where('comment_content', 'like', '%' . $key_new . '%')
            ->orWhere('comment_name', 'like', '%' . $key_new . '%')->paginate(6);
        $count = Comment::where('comment_content', 'like', '%' . $key_new . '%')
            ->orWhere('comment_name', 'like', '%' . $key_new . '%')->count();

        $product = [];
        foreach ($list_comment as $comment) {
            $product[] = Product::where('id', $comment->comment_product_id)->first();
        }
        return view('admin.comment.list_comment')
            ->with('list_comment', $list_comment)
            ->with('count', $count)
            ->with('product', $product);
    }

    public function add_rating(Request $request)
    {
        // $this->is_login();
        $data = $request->all();
        if ((Session('user_name')) && (Session('rating') != 0)) {
            $rating = new Rating();
            $rating->product_id = $data['product_id'];
            $rating->rating = $data['index'];
            $rating->save();
            echo 'Đánh giá thành công';
        }
    }
}
