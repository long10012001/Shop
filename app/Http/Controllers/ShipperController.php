<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Shipper;
use App\Models\Shipping;
use App\Models\Statistical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PDO;
use Illuminate\Support\Facades\Session;

session_start();

class ShipperController extends Controller
{
    public function login_shipper()
    {
        return view('shipper.login');
    }

    public function check_login_shipper(Request $request)
    {

        $shipper_email = $request->shipper_email;
        $shipper_password = md5($request->shipper_password);
        $shipper = Shipper::where('email', $shipper_email)->where('password', $shipper_password)->first();
        if ($shipper) {
            Session::put('shipper_name', $shipper->fullname);
            Session::put('shipper_id', $shipper->id);
            redirect('shipper_index')->send();
        } else {
            Session::flash('message', 'Email hoặc mật khẩu không đúng');

            return view('shipper.login');
        }
    }

    public function logout_shipper()
    {
        Session::put('shipper_name', null);
        Session::put('shipper_id', null);
        return view('shipper.login');
    }

    public function shipper_index()
    {
        $this->is_login_shipper();
        $shipper_id  = Session::get('shipper_id');
        $list_order_received_delivery = Order::where('shipper_id', $shipper_id)
            ->where('order_status', '<>', 'Thành Công')
            ->where('order_status', '<>', 'Hủy đơn hàng')
            ->orderBy('id', 'desc')
            ->paginate(5);
        $count = Order::where('shipper_id', $shipper_id)->where('order_status', '<>', 'Thành Công')->count();
        return view('shipper.main')
            ->with('list_order_received_delivery', $list_order_received_delivery)
            ->with('count', $count);
    }

    public function list_orders_success()
    {
        $this->is_login_shipper();
        $shipper_id  = Session::get('shipper_id');
        $list_order_success = Order::where('shipper_id', $shipper_id)
            ->where('order_status', 'Thành Công')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        $count = Order::where('shipper_id', $shipper_id)->where('order_status', 'Thành Công')->count();
        return view('shipper.list_order.list_orders_success')
            ->with('list_order_success', $list_order_success)
            ->with('count', $count);
    }

    public function list_orders_remain()
    {
        $this->is_login_shipper();
        $list_orders_remain = Order::where('order_status', '<>', 'Thành Công')
            ->where('order_status', '<>', 'Hủy đơn hàng')
            ->where('shipper_id', '0')
            ->orderBy('created_at', 'asc')
            ->paginate(5);
        $count = Order::where('order_status', '<>', 'Thành Công')->where('order_status', '<>', 'Hủy đơn hàng')->where('shipper_id', '0')->count();
        return view('shipper.list_order.list_orders_remain')->with('list_orders_remain', $list_orders_remain)->with('count', $count);
    }


    public function order_detail_shipper_screen($id)
    {
        $this->is_login_shipper();
        $order_detail = Order_detail::where('order_id', $id)->first();
        $order = Order::find($id);
        $shipping = Shipping::where('id', $order->shipping_id)->first();
        return view('shipper.order.order_detail')->with('order_detail', $order_detail)->with('shipping', $shipping)
            ->with('order', $order);
    }

    public function respond_delivery($id)
    {
        $this->is_login_shipper();
        $order = Order::find($id);
        $order->shipper_id = Session('shipper_id');
        $order->order_status = 'Đang vận chuyển';
        $order->save();
        return Redirect::to('shipper_index');
    }

    public function update_status_order_shipper($id, Request $request)
    {
        $this->is_login_shipper();
        $status = $request->status;
        $order = Order::find($id);
        $shipping = Shipping::where('id', $order->shipping_id)->first();
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
            foreach ($order_detail as $product) {
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
            $profit = $sale - $fee_ship;

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
        return Redirect::to('shipper_index');
    }

    public function search_order_shipper()
    {
        $shipper_id = Session('shipper_id');
        if (isset($_GET['key_recived_delivery'])) {
            $key = $_GET['key_recived_delivery'];
            $key_new = htmlspecialchars($key);
            $key_new = strtoupper($key_new);
            if (substr($key_new, 0, 3) === 'WEB') {
                $list_order_received_delivery = Order::where('order_code', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', $shipper_id)->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->paginate(5);
                $count = Order::where('order_code', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', $shipper_id)->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')
                    ->count();
            } else if (is_numeric($key_new)) {
                $list_order_received_delivery = Order::where('order_number', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', $shipper_id)
                    ->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->orWhere('order_total', 'like', '%' . $key_new . '%')->where('shipper_id', $shipper_id)
                    ->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->orWhere('order_code', 'like', '%' . $key_new . '%')->where('shipper_id', $shipper_id)
                    ->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->paginate(5);
                $count = Order::where('order_number', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', $shipper_id)
                    ->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->orWhere('order_total', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', $shipper_id)
                    ->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->orWhere('order_code', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', $shipper_id)
                    ->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')
                    ->count();
            } else {
                $list_order_received_delivery = Order::join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.id')
                    ->select('tbl_order.*')->where('tbl_shipping.shipping_name', 'like', '%' . $key_new . '%')
                    ->where('tbl_order.shipper_id', $shipper_id)->where('tbl_order.order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->paginate(5);
                $count =  Order::join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.id')
                    ->select('tbl_order.*')->where('tbl_shipping.shipping_name', 'like', '%' . $key_new . '%')
                    ->where('tbl_order.shipper_id', $shipper_id)->where('tbl_order.order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->count();
            }
            return view('shipper.main')
                ->with('list_order_received_delivery', $list_order_received_delivery)
                ->with('count', $count);
        } else if (isset($_GET['key_order_success'])) {
            $key = $_GET['key_order_success'];
            $key_new = htmlspecialchars($key);
            $key_new = strtoupper($key_new);
            if (substr($key_new, 0, 3) === 'WEB') {
                $list_order_success = Order::where('order_code', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', $shipper_id)->where('order_status', '=', 'Thành công')
                    ->paginate(5);
                $count = Order::where('order_code', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', $shipper_id)->where('order_status', '=', 'Thành công')->count();
            } else if (is_numeric($key_new)) {
                $list_order_success = Order::where('order_number', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', $shipper_id)->where('order_status', '=', 'Thành công')

                    ->orWhere('order_total', 'like', '%' . $key_new . '%')->where('shipper_id', $shipper_id)
                    ->where('order_status', '=', 'Thành công')

                    ->orWhere('order_code', 'like', '%' . $key_new . '%')->where('shipper_id', $shipper_id)
                    ->where('order_status', '=', 'Thành công')
                    ->paginate(5);
                $count = Order::where('order_number', 'like', '%' . $key_new . '%')->where('shipper_id', $shipper_id)->where('order_status', '=', 'Thành công')
                    ->orWhere('order_total', 'like', '%' . $key_new . '%')->where('shipper_id', $shipper_id)->where('order_status', '=', 'Thành công')
                    ->orWhere('order_code', 'like', '%' . $key_new . '%')->where('shipper_id', $shipper_id)->where('order_status', '=', 'Thành công')->count();
            } else {
                $list_order_success = Order::join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.id')
                    ->select('tbl_order.*')->where('tbl_shipping.shipping_name', 'like', '%' . $key_new . '%')
                    ->where('tbl_order.shipper_id', $shipper_id)->where('tbl_order.order_status', '=', 'Thành công')
                    ->paginate(5);
                $count =  Order::join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.id')
                    ->select('tbl_order.*')->where('tbl_shipping.shipping_name', 'like', '%' . $key_new . '%')
                    ->where('tbl_order.shipper_id', $shipper_id)->where('tbl_order.order_status', '=', 'Thành công')
                    ->count();
            }
            return view('shipper.list_order.list_orders_success')
                ->with('list_order_success', $list_order_success)
                ->with('count', $count);
        } else if (isset($_GET['key_order_remain'])) {
            $key = $_GET['key_order_remain'];
            $key_new = htmlspecialchars($key);
            $key_new = strtoupper($key_new);
            if (substr($key_new, 0, 3) === 'WEB') {
                $list_orders_remain = Order::where('order_code', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', '<>', $shipper_id)->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->paginate(5);
                $count = Order::where('order_code', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', '<>', $shipper_id)->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')
                    ->count();
            } else if (is_numeric($key_new)) {
                $list_orders_remain = Order::where('order_number', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', '<>', $shipper_id)->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')


                    ->orWhere('order_total', 'like', '%' . $key_new . '%')->where('shipper_id', '<>', $shipper_id)
                    ->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->orWhere('order_code', 'like', '%' . $key_new . '%')->where('shipper_id', '<>', $shipper_id)
                    ->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->paginate(5);
                $count = Order::where('order_number', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', '<>', $shipper_id)->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->orWhere('order_total', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', '<>', $shipper_id)->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->orWhere('order_code', 'like', '%' . $key_new . '%')
                    ->where('shipper_id', '<>', $shipper_id)->where('order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')
                    ->count();
            } else {
                $list_orders_remain = Order::join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.id')
                    ->select('tbl_order.*')->where('tbl_shipping.shipping_name', 'like', '%' . $key_new . '%')
                    ->where('tbl_order.shipper_id', '<>', $shipper_id)
                    ->where('tbl_order.order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->paginate(5);
                $count =  Order::join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.id')
                    ->select('tbl_order.*')->where('tbl_shipping.shipping_name', 'like', '%' . $key_new . '%')
                    ->where('tbl_order.shipper_id', '<>', $shipper_id)
                    ->where('tbl_order.order_status', '<>', 'Thành công')
                    ->where('order_status', '<>', 'Hủy đơn hàng')

                    ->count();
            }
            return view('shipper.list_order.list_orders_remain')
                ->with('list_orders_remain', $list_orders_remain)
                ->with('count', $count);
        }
    }
}
