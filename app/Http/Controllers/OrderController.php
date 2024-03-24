<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Detail_receipt;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Statistical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();
class OrderController extends Controller
{
    //
    public function list_order()
    {
        $this->is_login();
        $list_order = Order::OrderBy('id', 'DESC')->paginate(6);
        $count = $list_order->count();
        return view('admin.order.list_order')->with('list_order', $list_order)
            ->with('count', $count);
    }

    public function order_detail($id)
    {
        $this->is_login();
        $detail = Order_detail::where('order_id', $id)->get();
        $order = Order::where('id', $id)->first();
        $shipping_id = $order->shipping_id;
        $total_qty = 0;
        $product_image = [];
        foreach ($detail as $product) {
            $total_qty += $product->product_qty;
            $product_image[] = Product::find($product->product_id);
        }
        // return $product;
        $order_code = $order->order_code;
        $payment_method = $detail[0]->order->payment_method;
        $status = $detail[0]->order->order_status;
        $info = array();
        $info['shipping_address'] = $detail[0]->order->shipping->shipping_address;
        $info['shipping_phone'] = $detail[0]->order->shipping->shipping_phone;
        return view('admin.order.order_detail')
            ->with('detail', $detail)
            ->with('payment_method', $payment_method)
            ->with('total_qty', $total_qty)
            ->with('info', $info)
            ->with('id', $id)
            ->with('status', $status)
            ->with('shipping_id', $shipping_id)
            ->with('order_code', $order_code)
            ->with('product_image', $product_image);
    }

    public function delete_order($id)
    {
        $order = Order::find($id);
        $shipping_id = Shipping::where('id', $order->shipping_id)->first();
        $order_detail = Order_detail::where('order_id', $id)->get();
        foreach ($order_detail as $detail) {
            $detail->delete();
        }
        $order->delete();
        $shipping_id->delete();
        Session::flash('message', 'Xoá đơn hàng thành công');
        return Redirect::to('list_order');
    }

    public function update_status_order($id, Request $request)
    {
        $this->is_login();
        $status = $request->status;
        echo $status;
        $shipping_id = $request->shipping_id;
        $order = Order::find($id);
        $shipping = Shipping::find($shipping_id);

        $order_date = $order->created_at->format('Y-m-d');
        $statistical_date = Statistical::where('order_date', $order_date)->first();
        $statistical = 0;
        $total_order = 0;
        if (isset($statistical_date) && $statistical_date->count() > 0) {
            $statistical = 1;
            $total_order = $statistical_date->total_order;
        }

        if ($status == 'Thành công') {
            $sale = 0;
            $profit = 0;
            $qty_order = 0;
            $total_order += 1;
            $fee_ship = 0;
            $order_detail = Order_detail::where('order_id', $id)->get();
            $sale = $order->order_total;
            $total = 0;
            $total_price_receipt = 0;
            foreach ($order_detail as $product) {
                $detail_receipt = Detail_receipt::where("product_id", $product->product_id)->orderBy('id', 'desc')->take(1)->get();

                $total_price_receipt += $detail_receipt[0]->price * $product->product_qty;
                $update_qty_store = Product::where('id', $product->product_id)->get();
                $qty = $product->product_qty;
                $product_price = $product->product_price;

                $total += $qty * $product_price;

                foreach ($update_qty_store as $item) {
                    $new_qty = $item->product_qty - $qty;
                    $item->product_qty = $new_qty;
                    $item->number_sale = $item->number_sale + $qty;
                    $item->save();

                    $qty_order += $qty;
                }
            }
            $fee_ship = $sale - $total;
            $profit = $sale - $fee_ship - $total_price_receipt;


            if ($statistical == 1) {
                $statistital_update = Statistical::where('order_date', $order_date)->first();
                $statistital_update->sales += $sale;
                $statistital_update->profit += $profit;
                $statistital_update->qty += $qty_order;
                $statistital_update->total_order = $total_order;
                $statistital_update->save();
            } else {
                $statistital_new = new Statistical();
                $statistital_new->order_date = $order_date;
                $statistital_new->sales = $sale;
                $statistital_new->profit = $profit;
                $statistital_new->qty = $qty_order;
                $statistital_new->total_order = $total_order;
                $statistital_new->save();
            }
        }


        $order->order_status = $status;
        $shipping->shipping_status = $status;
        $order->save();
        $shipping->save();
        return Redirect::to('list_order');
    }

    public function filter_status_order()
    {
        $this->is_login();

        $status_search = $_GET['actions'];
        if ($status_search === '0') {
            $list_order = Order::OrderBy('id', 'DESC')->paginate(6);
            $count = $list_order->count();
        } else {
            $list_order = Order::where('order_status', $status_search)->orderBy('id', 'DESC')->paginate(6);
            $count = $list_order->count();
        }
        return view('admin.order.list_order')->with('list_order', $list_order)->with('count', $count);
    }

    public function search_order()
    {
        $this->is_login();

        $key = $_GET['key'];
        $key_new = htmlspecialchars($key);
        if (is_numeric($key_new)) {

            $list_order = Order::where('order_number', 'like', '%' . $key_new . '%')->orderBy('id', 'DESC')
                ->orWhere('order_total', 'like', '%' . $key_new . '%')->orderBy('id', 'DESC')
                ->orWhere('order_code', 'like', '%' . $key_new . '%')->orderBy('id', 'DESC')
                ->paginate(6);
            $count = $list_order->count();
        } else {

            $list_order = Shipping::where('shipping_name', 'like', '%' . $key_new . '%')->orderBy('id', 'DESC')
                ->paginate(6);
            $count = $list_order->count();
        }

        return view('admin.order.list_order')->with('list_order', $list_order)->with('count', $count);
    }
}
