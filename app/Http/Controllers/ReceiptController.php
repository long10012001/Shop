<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Detail_receipt;
use App\Models\Receipt;
use App\Models\Supplier;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function add_receipt()
    {
        $this->is_login();
        $all_product = Product::paginate(5);
        $count = Product::count();


        $category_search = '';
        $status = '';
        $list_brand = Brand::all();
        return view('admin.receipt.add_receipt')
            ->with('all_product', $all_product)
            ->with('list_category', $list_brand)->with('category_search', $category_search)
            ->with('status', $status)->with('count', $count);
    }

    public function save_receipt(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";
        $data = $request->all();
        // print_r($data['checkItem']);
        $list_product = [];
        $num_product = count($data['checkItem']);
        foreach ($data['checkItem'] as $key) {
            $list_product[] = Product::find($key);
        }

        $supplier = new Supplier();
        $supplier->supplier_name = $data['supplier_name'];
        $supplier->supplier_address = $data['supplier_address'];
        $supplier->supplier_method_payment = $data['supplier_method_payment'];
        $supplier->save();
        $supplier_id = $supplier->id;

        $receipt = new Receipt();
        $receipt->admin_id =  Session('admin_id');
        $receipt->supplier_id = $supplier_id;
        $receipt->total_receipt = $num_product;
        $receipt->status_receipt = $data['status_receipt'];
        $receipt->save();
        Session::put('id_receipt', $receipt->id);

        return view('admin.receipt.add_detail_receipt')->with('all_product', $list_product);
    }

    public function save_detail_receipt(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        $data = $request->all();
       
        foreach ($data['price_product'] as $key => $item) {
       

            $detail_receipt = new Detail_receipt();
            $detail_receipt->receipt_id = Session('id_receipt');
            $detail_receipt->product_id = $key;
            $detail_receipt->qty = $data['qty_product'][$key][0];
            $detail_receipt->price = $data['price_product'][$key][0];
            $detail_receipt->save();

            $product = Product::find($key);
           
            $product->product_qty +=  $data['qty_product'][$key][0];
            $product->save();
        }
        Session::put('id_receipt', null);
        return Redirect::to('all_product');
    }

    public function all_receipts()
    {
        $all_receipt = Receipt::paginate(5);
        $list_receipt = Receipt::all();

        $id_receipt = '';
        $status = '';
        $count = Receipt::count();
        return view('admin.receipt.all_receipt')
            ->with('all_receipts', $all_receipt)
            ->with('list_receipt', $list_receipt)

            ->with('id_receipt', $id_receipt)
            ->with('status', $status)
            ->with('count', $count);
    }

    public function detail_receipt($id)
    {
        $detail_receipt = Detail_receipt::where('receipt_id', $id)->get();
        $receipt = Receipt::find($id);
        $total_price = 0;
        $total_qty = 0;
        foreach ($detail_receipt as $detail) {
            $total_price += $detail->qty * $detail->price;
            $total_qty +=  $detail->qty;
        }
        return view('admin.receipt.detail_receipt')->with('detail_receipt', $detail_receipt)->with('receipt', $receipt)->with(
            'total_price',
            $total_price
        )->with('total_qty', $total_qty);
    }

    public function update_status_receipt(Request $request, $id)
    {
        $data = $request->all();
        $receipt = Receipt::find($id);
        $receipt->status_receipt = $data['status'];
        $receipt->save();
        return Redirect::to('all_receipts');
    }


    public function search_product_receipt_admin()
    {
        $category_search = '';
        $status = '';
        $key = $_GET['key'];
        $key_new = htmlspecialchars($key);
        $all_product = Product::where('product_name', 'like', '%' . $key_new . '%')
            ->orWhere('product_price', $key_new)->orWhere('product_by', 'like', '%' . $key_new . '%')->paginate(5);
        $count = $all_product->count();
        $list_category = Category::all();
        return view('admin.receipt.add_receipt')
            ->with('all_product', $all_product)
            ->with('list_category', $list_category)->with('category_search', $category_search)
            ->with('status', $status)
            ->with('count', $count);
    }

    public function filter_product_receipt_search()
    {
        $category_search = $_GET['category'];
        $status = $_GET['status'];


        if ($category_search == 0 && $status == 0) {
            $all_product = Product::where('product_status', '1')->paginate(5);
            $count = Product::all()->count();
        } else if ($category_search != 0 && $status == 0) {
            $all_product = Product::where('brand_id', $category_search)->where('product_status', '1')->paginate(5);
            $count = Product::where('brand_id', $category_search)->get()->count();
        } else if ($category_search == 0 && $status == 1) {
            $all_product = Product::where('product_status', '0')->paginate(5);
            $count = Product::where('product_status', $status)->get()->count();
        } else if ($category_search != 0 && $status == 1) {
            $all_product = Product::where('product_status', '0')->where('brand_id', $category_search)->paginate(5);
            $count = Product::where('product_status', $status)->where('brand_id', $category_search)->get()->count();
        }
        $list_brand = Brand::all();

        return view('admin.receipt.add_receipt')
            ->with('all_product', $all_product)
            ->with('list_category', $list_brand)
            ->with('category_search', $category_search)
            ->with('status', $status)->with('count', $count);
    }

    public function filter_receipt()
    {
        $id_receipt = $_GET['id_receipt'];
        $status = $_GET['status'];
        // $status = $_GET['status'];

        if ($id_receipt == 0 && $status == 0) {
            $all_receipts = Receipt::paginate(5);
            $count = Receipt::all()->count();
        } else if ($id_receipt != 0 && $status == 0) {
            $all_receipts = Receipt::where('id', $id_receipt)->paginate(5);
            $count = Receipt::where('id', $id_receipt)->where('status_receipt', 'Chưa thanh toán')->get()->count();
        } else if ($id_receipt == 0 && $status != 0) {
            $all_receipts = Receipt::where('status_receipt', $status)->paginate(5);
            $count = Receipt::where('status_receipt', 'Đã thanh toán')->get()->count();
        } else if ($id_receipt != 0 && $status != 0) {
            $all_receipts = Receipt::where('id', $id_receipt)->where('status_receipt', $status)->paginate(5);
            $count = Receipt::where('id', $id_receipt)->where('status_receipt', $status)->get()->count();
        }
        // $list_category = Category::all();
        $list_supplier = Supplier::all();
        // $list_receipt = Receipt::all();        
        $list_receipt = Receipt::paginate(5);
        $count = Receipt::count();


        return view('admin.receipt.all_receipt')
            ->with('id_receipt', $id_receipt)
            ->with('all_receipts', $all_receipts)
            ->with('list_supplier', $list_supplier)
            ->with('list_receipt', $list_receipt)
            ->with('status', $status)
            ->with('count', $count);
    }
}