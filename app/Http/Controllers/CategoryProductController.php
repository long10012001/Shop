<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryProductController extends Controller
{
    //
    public function add_category_product()
    {
        $this->is_login();
        return view('admin.category.add_category_product');
    }

    public function all_category_product()
    {
        $this->is_login();
        $all_category_product = Category::paginate(3);
        $count = Category::count();
        return view('admin.category.all_category_product')
            ->with('all_category_product', $all_category_product)
            ->with('count', $count);
    }

    public function save_category_product(Request $request)
    {
        $this->is_login();
        // $data = array();
        // $data['category_name'] = $request->category_product_name;
        // $data['category_desc'] = $request->category_product_desc;
        // $data['category_status'] = $request->category_product_status;
        // DB::table('tbl_category_product')->insert($data);
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['title_category'];
        $category->category_desc = $data['desc_category'];
        $category->category_by = Session('admin_name');
        $category->category_status = 0;

        $category->save();

        Session::flash('message', 'Thêm danh mục thành công');
        return Redirect::to('add_category_product');
    }

    public function update_category_product($id)
    {
        $this->is_login();
        $edit_category_product = Category::find($id);
        $manager_category_product = view('admin.category.update_category')->with('edit_category_product', $edit_category_product);

        return view('admin.layout.layout')->with('edit_category_product', $manager_category_product);
    }

    public function save_update_category_product($id, Request $request)
    {
        $this->is_login();
        $data = $request->all();
        $category = Category::find($id);
        $category->category_name = $data['title_category'];
        $category->category_desc = $data['desc_category'];
        $category->category_by = Session('admin_name');
        $category->save();

        Session::flash('message', 'Cập nhật danh mục thành công');
        return Redirect::to('all_category_product');
    }

    public function delete_category_product($id)
    {
        $this->is_login();

        // DB::table('tbl_category_product')->where('id', $id_category_product)->delete();
        $delete = Category::find($id);
        $delete->delete();
        Session::flash('message', 'Xoá danh mục thành công');
        return Redirect::to('all_category_product');
    }

    public function active_category_product($id_category_product)
    {
        $this->is_login();

        // DB::table('tbl_category_product')->where('id', $id_category_product)->update(['category_status' => 0]);
        $category = Category::find($id_category_product);
        $category->category_status = 0;
        $category->save();
        Session::flash('message', 'Không kích hoạt danh mục thành công');
        return Redirect::to('all_category_product');
    }

    public function unactive_category_product($id_category_product)
    {
        $this->is_login();
        // DB::table('tbl_category_product')->where('id', $id_category_product)->update(['category_status' => 1]);
        $category = Category::find($id_category_product);
        $category->category_status = 1;
        $category->save();
        Session::flash('message', 'Kích hoạt danh mục thành công');
        return Redirect::to('all_category_product');
    }

    public function filter_status_category(Request $request)
    {
        $this->is_login();
        $status = $request->actions;
        if ($status == '') {
            $all_category_product = Category::paginate(3);
        } else {
            $all_category_product = Category::where('category_status', $status)->paginate(5);
        }
        $count = $all_category_product->count();
        return view('admin.category.all_category_product')
            ->with('all_category_product', $all_category_product)
            ->with('count', $count);
    }

    public function search_category(Request $request)
    {
        $this->is_login();

        $key = $request->key;
        $key_new = htmlspecialchars($key);
        $all_category_product = Category::where('category_name', 'like', '%' . $key_new . '%')
            ->orWhere('category_by', 'like', '%' . $key_new . '%')->paginate(1);
        $count = $all_category_product->count();
        return view('admin.category.all_category_product')
            ->with('all_category_product', $all_category_product)
            ->with('count', $count);
    }
}