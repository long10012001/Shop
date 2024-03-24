<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static function is_login()
    {
        if (Session('admin_name') !== null) {
            return view('admin.main');
        } else {
            Session::flash('message', 'Vui lòng đăng nhập');
            return Redirect::to('admin')->send();
        }
    }

    public function back_home()
    {
        $category_product = Category::all();
        $category_product->where('category_status', '1')->all();
        $brand_product = Brand::all();
        $brand_product->where('brand_status', '1')->all();
        $all_product = Product::where('product_status', '1')->orderByDesc('id')->limit(9)->get();
        $all_product_2 = Product::all();

        return Redirect::to('trang-chu')
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product)
            ->with('all_product', $all_product)->with('all_product_2', $all_product_2)->send();
    }
    public static function is_login_shipper()
    {
        if (Session('shipper_id') !== null) {
            return view('shipper.login');
        } else {
            Session::flash('message', 'Vui lòng đăng nhập');
            return Redirect::to('login_shipper')->send();
        }
    }
}
