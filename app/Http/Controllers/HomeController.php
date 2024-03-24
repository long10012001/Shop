<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Vistors;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $list_slider = Slider::where('slider_status', '1')->take(23)->get();

        $category_product = Category::where('category_status', '1')->get();
        $brand_product = Brand::where('brand_status', '1')->get();

        $all_product = Product::where('product_status', '1')->orderByDesc('id')->limit(9)->get();
        $all_product_2 = Product::where('product_status', '1')->paginate(8);

        $list_product = Order_detail::all();

        $product = [];
        foreach ($list_product as $v) {
            $product[] = Product::where("id", $v->product_id)->first();
        }

        $pro = array_unique($product);

        $count = count($product);

        // Kiểm tra khách hàng mới
        $user_ip_onl = $request->ip();
        // $user_ip_onl = '234.234.234.234';
        $user_current = Vistors::where('ip_address', $user_ip_onl)->first();

        if (!isset($user_current)) {
            $vistor = new Vistors();
            $vistor->ip_address = $user_ip_onl;
            $vistor->date_visit = Carbon::now('Asia/Ho_Chi_Minh)')->toDateString();
            $vistor->access_times = 1;
            $vistor->save();
        } else {
            $vistor = Vistors::where('ip_address', $user_ip_onl)->first();
            $vistor->date_visit = Carbon::now('Asia/Ho_Chi_Minh)')->toDateString();
            $vistor->access_times += 1;
            $vistor->save();
        }
        return view('layout.shop')
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product)
            ->with('all_product', $all_product)
            ->with('all_product_2', $all_product_2)
            ->with('list_slider', $list_slider)
            ->with('pro', $pro)
            ->with('count', $count);
    }

    public function filter_home()
    {
        $list_slider = Slider::where('slider_status', '1')->take(23)->get();

        $category_product = Category::where('category_status', '1')->get();
        $brand_product = Brand::where('brand_status', '1')->get();
        $all_product = Product::where('product_status', '1')->orderByDesc('id')->limit(9)->get();

        $filter = $_GET['actions'];
        if ($filter == 1) {
            $all_product_2 = Product::orderBy('product_price', 'desc')->paginate(8);
        } else if ($filter == 2) {
            $all_product_2 = Product::orderBy('product_price', 'asc')->paginate(8);
        } else if ($filter == 3) {
            $all_product_2 = Product::orderBy('product_name', 'asc')->paginate(8);
        } else if ($filter == 4) {
            $all_product_2 = Product::orderBy('product_name', 'desc')->paginate(8);
        } else {
            $all_product_2 = Product::paginate(1);
        }

        $list_product = Order_detail::all();

        $product = [];
        foreach ($list_product as $v) {
            $product[] = Product::where("id", $v->product_id)->first();
        }


        $pro = array_unique($product);

        $count = count($product);
        return view('layout.shop')
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product)
            ->with('all_product', $all_product)
            ->with('all_product_2', $all_product_2)
            ->with('list_slider', $list_slider)->with('pro', $pro)
            ->with('count', $count);
    }


    public function search()
    {
        $key = $_GET['key'];

        $regex = '/[!@#$%^&*(){}"><]/';
        if (preg_match($regex, $key, $matches)) {
            Session::flash('message_search', 'Không sử dụng ký tự đặc biệt');
            return Redirect('trang-chu');
        }
        $category_product = Category::where('category_status', '1')->get();
        $brand_product = Brand::where('brand_status', '1')->get();

        $search_product = DB::table('tbl_product')
            ->where('product_status', '1')
            ->where('product_name', 'like', '%' . $key . '%')
            ->orWhere('product_price', 'like', '%' . $key . '%')
            ->where('product_status', '1')
            ->paginate(8);
        return view('product.search')
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product)
            ->with('search_product', $search_product);
    }

    public function get_product_by_cate($id)
    {
        $category_product = Category::where('category_status', '1')->get();
        $brand_product = Brand::where('brand_status', '1')->get();

        $name_cate = Category::find($id);
        $get_product_by_cate = Product::where('category_id', $id)->get();
        return view('product.product_by_category')
            ->with('get_product_by_cate', $get_product_by_cate)
            ->with('name_cate', $name_cate)
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product);
    }

    public function get_product_by_brand($id)
    {
        $category_product = Category::where('category_status', '1')->get();
        $brand_product = Brand::where('brand_status', '1')->get();

        $name_brand = Brand::find($id);
        $get_product_by_brand = Product::where('brand_id', $id)->get();
        return view('product.product_by_brand')
            ->with('get_product_by_brand', $get_product_by_brand)
            ->with('name_brand', $name_brand)
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product);
    }
}