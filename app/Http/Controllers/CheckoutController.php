<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\District;
use App\Models\FeeShip;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Shipping;
use App\Models\Wards;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

session_start();

class CheckoutController extends Controller
{
    //
    public function checkout()
    {
        if (Session('user_id')) {
            $id = Session('user_id');
            $customer = Customer::where('id', $id)->first();
            $district = District::orderBy('id_district', 'ASC')->get();
            $id = Session('id_district');
            // $wards = Wards::where('id_district', $data['id'])->orderBy('id_wards', 'ASC')->get();
            $wards = Wards::where('id_district', $id)->orderBy('id_wards', 'ASC')->get();

            return view('checkout.checkout')->with('customer', $customer)->with('district', $district)->with('wards', $wards);
        } else {
            return view('user.login_customer');
        }
    }


    // public function login_checkout()
    // {
    //     return view('login');
    // }

    public function save_checkout(Request $request)
    {
        $request->validate(
            [
                'shipping_name' => 'required|not_regex:/[!@#$%^&*(){}<>:"]/',
                'shipping_email' => 'required|email',
                'district' => 'required',
                'wards' => 'required',
                'shipping_phone' => 'required|numeric|regex:/(0)[0-9]{9}/',
                'shipping_address_detail' => 'required|not_regex:/[!@#$%^&*()><{}]/',
                'payment_method' => 'required'
            ],
            [
                'required' => 'Vui lòng nhập :attribute',
                'unique' => 'Email đã được đăng ký',
                'shipping_name.not_regex' => 'Không sử dụng ký tự đặc biệt và số',
                'shipping_address_detail.not_regex' => 'Không sử dụng ký tự đặc biệt',
                'numeric' => 'Chỉ nhập số',
                'shipping_phone.regex' => 'Số điện thoại không hợp lệ'

            ],
            [
                'shipping_name' => 'họ và tên',
                'shipping_email' => 'email',
                'shipping_phone' => 'số điện thoại',
                'shipping_address_detail' => 'địa chỉ',
                'district' => 'Quận, huyện',
                'wards' => 'Xã phường, thị trấn',
                'payment_method' => 'Phương thức thanh toán'
            ]
        );
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;

        $data['payment_method'] = $request->payment_method;
        $data['customer_id'] = Session('user_id');
        $data['district'] = Session('id_district');
        $data['ward'] = Session('id_wards');

        $district = District::find($data['district']);
        $ward = Wards::find($data['ward']);
        $data['shipping_address'] = $request->shipping_address_detail . ', ' . $ward->name_wards . ', ' . $district->name_district;
        // return Session('total_ship');
        // Insert shipping
        $shipping = new Shipping();
        $shipping['shipping_name'] = $data['shipping_name'];
        $shipping['shipping_email'] = $data['shipping_email'];
        $shipping['shipping_address'] = $data['shipping_address'];
        $shipping['shipping_phone'] = $data['shipping_phone'];

        $shipping['customer_id'] = $data['customer_id'];
        $shipping['shipping_status'] = 'Đang chờ xử lý';
        $shipping->save();
        $shipping_id = $shipping->id;

        // Insert order
        $order_code = 'WEB' . substr(uniqid(rand(0, 1), true), 16, 3);
        $order = new Order();
        $order['order_code'] = $order_code;
        $order['customer_id'] = $data['customer_id'];
        $order['shipping_id'] = $shipping_id;
        if (session('success_transaction') == 1) {
            $order['payment_method'] = 'Đã thanh toán bằng PayPal';
        } else {
            $order['payment_method'] = $data['payment_method'];
        }
        $order['order_number'] = Cart::count();
        $order['order_total'] = Session('total_ship');
        $order['order_status'] = 'Đang chờ xử lý';

        $order->save();
        $order_id = $order->id;

        // Send mail
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = 'Đơn xác nhận ngày: ' . $now;
        $customer = $data['shipping_name'];
        $data['mail'][] = $data['shipping_email'];
        foreach (Cart::content() as $product) {
            $cart_array[] = array(
                'product_name' => $product->name,
                'product_price' => $product->price,
                'product_qty' => $product->qty,
            );
        }
        $shipping_array = array(
            'shipping_name' => $data['shipping_name'],
            'shipping_mail' => $data['shipping_email'],
            'shipping_address' => $data['shipping_address'],
            'shipping_phone' => $data['shipping_phone'],
            'shipping_method' => $data['payment_method'],
            'order_code' => $order_code
        );

        // Insert order_detail
        foreach (Cart::content() as $product) {
            $order_detail = new Order_detail();
            $order_detail['order_id'] = $order_id;
            $order_detail['product_id'] = $product->id;
            $order_detail['product_name'] = $product->name;
            $order_detail['product_price'] = $product->price;
            $order_detail['product_qty'] = $product->qty;
            $order_detail->save();
        }
        Cart::destroy();

        Session::forget('total_ship');
        Session::forget('success_transaction');
        Session::forget('id_district');
        Session::forget('id_wards');
        Session::forget('fee_ship');
        Session::forget('href', 'http://localhost/shop/process-transaction');
        // $method = $data['payment_method'];
        // if ($method === 'Thanh toán tại nhà') {

        Mail::send('checkout.mail', ['cart_array' => $cart_array, 'shipping_array' => $shipping_array], function ($message) use ($title_mail, $data) {
            $message->to($data['mail'])->subject($title_mail);
            $message->from($data['mail'], $title_mail);
        });

        return view('checkout.handcash');
    }

    public function select_address(Request $request)
    {
        $data = $request->all();
        Session::put('id_district', $data['id']);
        $id = Session('id_district');
        // $wards = Wards::where('id_district', $data['id'])->orderBy('id_wards', 'ASC')->get();
        $wards = Wards::where('id_district', $id)->orderBy('id_wards', 'ASC')->get();
        $output = '';
        $output .= '<option>-- Chọn Xã Phường, Thị Trấn --</option>';
        foreach ($wards as $item) {
            if ($item->id_wards == Session('id_wards')) {
                $output .= '<option selected value="' . $item->id_wards . '">' . $item->name_wards . '</option>';
            } else {

                $output .= '<option value="' . $item->id_wards . '">' . $item->name_wards . '</option>';
            }
        }
        echo $output;
    }

    public function add_fee(Request $request)
    {
        $data = $request->all();
        $fee_ship = FeeShip::Where('id_district', $data['district'])->where('id_wards', $data['ward'])->first();
        Session::put('fee_ship', $fee_ship->fee_ship);
        Session::save();
        $cart = Cart::subtotal(0);
        $total = str_replace(',', '', $cart);
        $fee_ship = session('fee_ship');

        $total_ship = $total + $fee_ship;
        Session::put('total_ship', $total_ship);
        Session::put('fee_ship', $fee_ship);
        Session::put('id_district', $data['district']);
        Session::put('id_wards', $data['ward']);
        Session::put('href', 'http://localhost/shop/process-transaction');
        $output = [
            'fee_ship' => number_format($fee_ship) . 'đ',
            'total_ship' => number_format($total_ship) . 'đ',
            'href' => 'http://localhost/shop/process-transaction',
        ];

        echo json_encode($output);
    }
}
