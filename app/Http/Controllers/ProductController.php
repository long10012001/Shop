<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Detail_receipt;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Rating;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //
    public function add_product()
    {
        $this->is_login();
        $cate_product = DB::table('tbl_category_product')->orderBy('id')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('id')->get();
        return view('admin.product.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function all_product()
    {
        $this->is_login();

        $all_product = Product::OrderBy('id', 'DESC')->paginate(5);
        $count = Product::count();
        foreach ($all_product as $item) {
            $detail_receipt[] = Detail_receipt::where("product_id", $item->id)->orderBy('id', 'desc')->take(1)->get();
        }


        $brand_search = '';
        $status = '';
        $list_brand = Brand::all();
        return view('admin.product.all_product')
            ->with('all_product', $all_product)
            ->with('list_brand', $list_brand)->with('brand_search', $brand_search)
            ->with('status', $status)->with('count', $count)->with('detail_receipt', $detail_receipt);
    }

    public function save_product(Request $request)
    {
        $this->is_login();
        $data = $request->all();
        $product = new Product();
        $product->category_id = $data['category_product'];
        $product->brand_id = $data['brand_product'];
        $product->product_name = $data['product_name'];
        $product->product_qty = $data['product_qty'];
        $product->number_sale = 0;
        $product->product_price = $data['product_price'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->product_by = Session('admin_name');

        $product->product_status = 0;

        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $product->product_image = $new_image;

            $product->save();
            Session::flash('message', 'Thêm sản phẩm thành công');
            return Redirect::to('add_product');
        }
        $product->product_image = '';
        $product->save();
        Session::flash('message', 'Thêm sản phẩm thành công');
        return Redirect::to('all_product');
    }

    public function active_product($id_product)
    {
        $this->is_login();
        DB::table('tbl_product')->where('id', $id_product)->update(['product_status' => 0]);
        Session::flash('message', 'Không kích hoạt sản phẩm thành công');
        return back();
    }

    public function unactive_product($id_product)
    {
        $this->is_login();
        DB::table('tbl_product')->where('id', $id_product)->update(['product_status' => 1]);
        Session::flash('message', 'Kích hoạt sản phẩm thành công');
        return back();
    }

    public function edit_product($id_product)
    {
        $this->is_login();
        $cate_product = Category::all();
        $brand_product = Brand::all();

        $edit_product = Product::find($id_product);
        return view('admin.product.update_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function update_product($id_product, Request $request)
    {
        $this->is_login();
        $data = $request->all();
        $product = Product::find($id_product);
        $product->category_id = $data['category_product'];
        $product->brand_id = $data['brand_product'];
        $product->product_name = $data['product_name'];
        // $product->product_qty = $data['product_qty'];
        $product->product_price = $data['product_price'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->product_by = Session('admin_name');

        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);

            $product->product_image = $new_image;
            $product->save();
            Session::flash('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('all_product');
        }

        $product->save();
        Session::flash('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all_product');
    }

    public function delete_product($id_product)
    {
        $this->is_login();;
        $delete_product =  Product::find($id_product);
        $delete_product->delete();
        unlink('public/uploads/product/' . $delete_product->product_image);
        Session::flash('message', 'Xoá sản phẩm thành công');
        return Redirect::to('all_product');
    }


    public function show_detail_product($product_id)
    {
        $category_product = Category::where('category_status', '1')->get();
        $brand_product = Brand::where('brand_status', '1')->get();
        $one_product = Product::find($product_id);
        $relate_product = Product::all()
            ->where('category_id', $one_product->category_id)
            ->whereNotIn('id', $product_id);
        $gallery_product = Gallery::where('product_id', $product_id)->get();
        $rating = Rating::where('product_id', $product_id)->avg('rating');
        $rating = round($rating);
        $user_id = Session('user_id');
        $order_success = Order::where('customer_id', $user_id)->where('order_status', 'Thành công')->get();
        $order_detail = [];
        foreach ($order_success as $success) {
            $order_detail[] = Order_detail::where('order_id', $success->id)->first();
        }
        $result = 0;
        foreach ($order_detail as $o) {
            if ($o->product_id == $product_id) {
                $result++;
            }
        }
        if ($result != 0) {
            Session::put('rating', '1');
        } else {
            Session::put('rating', '0');
        }
        return view('product.detail_product')
            ->with('category_product', $category_product)
            ->with('brand_product', $brand_product)
            ->with('one_product', $one_product)
            ->with('relate_product', $relate_product)
            ->with('rating', $rating)
            ->with('result', $result)
            ->with('gallery_product', $gallery_product);
    }

    public function search_product_admin(Request $request)
    {
        $category_search = '';
        $status = '';
        $key = $_GET['key'];
        $key_new = htmlspecialchars($key);
        $all_product = Product::where('product_name', 'like', '%' . $key_new . '%')->orderBy('id', 'DESC')
            ->orWhere('product_price', $key_new)->orderBy('id', 'DESC')->orWhere('product_by', 'like', '%' . $key_new . '%')->orderBy('id', 'DESC')->paginate(5);
        $count = $all_product->count();
        $list_category = Category::all();
        return view('admin.product.all_product')
            ->with('all_product', $all_product)
            ->with('list_category', $list_category)->with('category_search', $category_search)
            ->with('status', $status)
            ->with('count', $count);
        return Redirect::to('all_product');
    }

    public function filter_search()
    {
        // $category_search = $request->category;
        // $status = $request->status;

        $brand_search = $_GET['brand'];
        $status = $_GET['status'];


        if ($brand_search == 0 && $status == 0) {
            $all_product = Product::where('product_status', '1')->orderBy('id', 'DESC')->paginate(5);
            $count = Product::all()->count();
        } else if ($brand_search != 0 && $status == 0) {
            $all_product = Product::where('brand_id', $brand_search)->where('product_status', '1')->orderBy('id', 'DESC')->paginate(5);
            $count = Product::where('brand_id', $brand_search)->get()->count();
        } else if ($brand_search == 0 && $status == 1) {
            $all_product = Product::where('product_status', '0')->orderBy('id', 'DESC')->paginate(5);
            $count = Product::where('product_status', $status)->get()->count();
        } else if ($brand_search != 0 && $status == 1) {
            $all_product = Product::where('product_status', '0')->where('brand_id', $brand_search)->orderBy('id', 'DESC')->paginate(5);
            $count = Product::where('product_status', $status)->where('brand_id', $brand_search)->get()->count();
        }
        $list_brand = Brand::all();

        return view('admin.product.all_product')
            ->with('all_product', $all_product)
            ->with('list_brand', $list_brand)
            ->with('brand_search', $brand_search)
            ->with('status', $status)->with('count', $count);
    }
}
