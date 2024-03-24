<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\District;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class CartController extends Controller
{
    //
    public function save_cart(Request $request)
    {
        $productId = $request->product_id;
        $qty = $request->qty;
        $product_info = DB::table('tbl_product')->where('id', $productId)->get();

        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // Cart::destroy();
        $data['id'] = $productId;
        $data['qty'] = $qty;
        $data['name'] = $product_info[0]->product_name;
        $data['price'] = $product_info[0]->product_price;
        $data['weight'] = '1';
        $data['options']['image'] = $product_info[0]->product_image;
        $data['options']['qty_store'] = $product_info[0]->product_qty;

        Cart::add($data);

        return view('show_cart');
    }

    public function save_cart_and_checkout(Request $request)
    {
        $productId = $request->product_id;
        $qty = $request->qty;
        $product_info = DB::table('tbl_product')->where('id', $productId)->get();

        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // Cart::destroy();
        $data['id'] = $productId;
        $data['qty'] = $qty;
        $data['name'] = $product_info[0]->product_name;
        $data['price'] = $product_info[0]->product_price;
        $data['weight'] = '1';
        $data['options']['image'] = $product_info[0]->product_image;
        $data['options']['qty_store'] = $product_info[0]->product_qty;

        Cart::add($data);

        if (Session('user_id')) {
            $id = Session('user_id');
            $customer = Customer::where('id', $id)->first();
            $district = District::orderBy('id_district', 'ASC')->get();

            return view('checkout.checkout')->with('customer', $customer)->with('district', $district);
        } else {
            return view('user.login_customer');
        }
    }

    public function show_cart()
    {

        return view('show_cart');
    }

    public function delete_product_cart($id_row)
    {
        Cart::remove($id_row);
        return Redirect::to('show_cart');
    }

    public function update_qty(Request $request)
    {
        $row_id = $request->product_id;
        $qty = $request->qty_product;
        Cart::update($row_id, $qty);
        return Redirect::to('show_cart');
    }
}
