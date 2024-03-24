<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ShippingController extends Controller
{
    //
    public function list_customer_order()
    {
        $this->is_login();
        $list_customer_order = Shipping::OrderBy('id', 'DESC')->paginate(6);
        $count = $list_customer_order->count();
        // $order_code = [];
        // foreach ($list_customer_order as $order) {
        //     echo $order->order->order_code;
        // }
        return view('admin.order.list_customer_order')
            ->with('list_customer_order', $list_customer_order)
            ->with('count', $count);
    }

    public function delete_customer_order($id)
    {
        $this->is_login();
        $delete_shipping = Shipping::find($id);
        $delete_order = Order::where('shipping_id', $id)->first();
        $delete_order_detail = Order_detail::where('order_id', $delete_order->id)->get();
        foreach ($delete_order_detail as $detail) {
            $detail->delete();
        }
        $delete_shipping->delete();
        $delete_order->delete();
        Session::flash('message', 'Xoá bill thành công');
        return Redirect::to('list_customer_order');
    }

    public function filter_status_order_customer()
    {
        $this->is_login();
        $status_search = $_GET['actions'];
        if ($status_search === '0') {
            $list_customer_order = Shipping::OrderBy('id', 'DESC')->paginate(6);
            $count = $list_customer_order->count();
        } else {
            $list_customer_order = Shipping::where('shipping_status', $status_search)->orderBy('id', 'DESC')->paginate(6);
            $count = $list_customer_order->count();
        }
        return view('admin.order.list_customer_order')
            ->with('list_customer_order', $list_customer_order)->with('count', $count);
    }

    public function search_customer()
    {
        $this->is_login();
        $key = $_GET['key'];
        $key_new = htmlspecialchars($key);
        $list_customer_order = Shipping::where('shipping_name', 'like', '%' . $key_new . '%')->orderBy('id', 'DESC')
            ->orWhere('shipping_email', 'like', '%' . $key_new . '%')->orderBy('id', 'DESC')
            ->orWhere('shipping_address', 'like', '%' . $key_new . '%')->orderBy('id', 'DESC')
            ->orWhere('shipping_phone', 'like', '%' . $key_new . '%')->orderBy('id', 'DESC')->paginate(6);
        $count = $list_customer_order->count();
        return view('admin.order.list_customer_order')
            ->with('list_customer_order', $list_customer_order)
            ->with('count', $count);
    }
}
