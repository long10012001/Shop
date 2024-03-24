<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class BrandProductController extends Controller
{
    //
    public function add_brand_product()
    {
        $this->is_login();
        return view('admin.brand.add_brand_product');
    }

    public function all_brand_product()
    {
        $this->is_login();
        $all_brand_product = Brand::paginate(5);
        $count = Brand::count();
        return view('admin.brand.all_brand_product')
            ->with('all_brand_product', $all_brand_product)
            ->with('count', $count);
    }

    public function save_brand_product(Request $request)
    {
        $this->is_login();

        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['title_brand'];
        $brand->brand_desc = $data['desc_brand'];
        $brand->brand_by = Session('admin_name');
        $brand->brand_status = 0;

        $brand->save();

        Session::flash('message', 'Thêm thương hiệu thành công');
        return Redirect::to('add_brand_product');
    }

    public function update_brand_product($id)
    {
        $this->is_login();
        $edit_brand_product = Brand::find($id);
        $manager_brand_product = view('admin.brand.update_brand')->with('edit_brand_product', $edit_brand_product);

        return view('admin.layout.layout')->with('edit_brand_product', $manager_brand_product);
    }

    public function save_update_brand_product($id, Request $request)
    {
        $this->is_login();
        $data = $request->all();
        $brand = Brand::find($id);
        $brand->brand_name = $data['title_brand'];
        $brand->brand_desc = $data['desc_brand'];
        $brand->brand_by = Session('admin_name');
        $brand->save();

        Session::flash('message', 'Cập nhật thương hiệu thành công');
        return Redirect::to('all_brand_product');
    }

    public function delete_brand_product($id)
    {
        $this->is_login();
        // DB::table('tbl_category_product')->where('id', $id_category_product)->delete();
        $delete = Brand::find($id);
        $delete->delete();
        Session::flash('message', 'Xoá thương hiệu thành công');
        return Redirect::to('all_brand_product');
    }

    public function active_brand_product($id_brand_product)
    {
        $this->is_login();
        // DB::table('tbl_category_product')->where('id', $id_category_product)->update(['category_status' => 0]);
        $brand = Brand::find($id_brand_product);
        $brand->brand_status = 0;
        $brand->save();
        Session::flash('message', 'Không kích hoạt thương hiệu thành công');
        return Redirect::to('all_brand_product');
    }

    public function unactive_brand_product($id_brand_product)
    {
        $this->is_login();
        // DB::table('tbl_category_product')->where('id', $id_category_product)->update(['category_status' => 1]);
        $brand = Brand::find($id_brand_product);
        $brand->brand_status = 1;
        $brand->save();
        Session::flash('message', 'Kích hoạt thương hiệu thành công');
        return Redirect::to('all_brand_product');
    }

    public function filter_status_brand()
    {
        $this->is_login();
        $status = $_GET['actions'];
        if ($status == '') {
            $all_brand_product = Brand::paginate(5);
        } else {
            $all_brand_product = Brand::where('brand_status', $status)->paginate(5);
        }
        $count = $all_brand_product->count();
        return view('admin.brand.all_brand_product')
            ->with('all_brand_product', $all_brand_product)
            ->with('count', $count);
    }

    public function search_brand()
    {
        $this->is_login();
        $key = $_GET['key'];
        $key_new = htmlspecialchars($key);
        $all_brand_product = Brand::where('brand_name', 'like', '%' . $key_new . '%')
            ->orWhere('brand_by', 'like', '%' . $key_new . '%')->paginate(5);
        $count = $all_brand_product->count();
        return view('admin.brand.all_brand_product')
            ->with('all_brand_product', $all_brand_product)
            ->with('count', $count);
    }
}
