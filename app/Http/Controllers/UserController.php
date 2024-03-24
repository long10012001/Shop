<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Shipper;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();
class UserController extends Controller
{
    //
    public function login_customer_page()
    {
        return view('user.login_customer');
    }
    public function regist()
    {
        return view('user.regist');
    }
    public function add_customer(Request $request)
    {
        $request->validate(
            [
                'customer_name' => 'required|regex:/[A-Za-z]/',
                'customer_email' => 'required|unique:tbl_customer',
                'customer_password' => 'required|regex:/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/',
                'customer_phone' => 'required|numeric|regex:/(0)[0-9]{9}/|digits:10',
            ],
            [
                'required' => 'Vui lòng nhập :attribute',
                'unique' => 'Email đã được đăng ký',
                'customer_name.regex' => 'Không sử dụng ký tự đặc biệt và số',
                'customer_password.regex' => 'Kí tự đầu tiên in hoa, độ dài từ 6-32 kí tự',
                'numeric' => 'Chỉ nhập số',
                'customer_phone.regex' => 'Số điện thoại không hợp lệ',
                'customer_phone.digits' => 'Số điện thoại không hợp lệ'
            ],
            [
                'customer_name' => 'họ và tên',
                'customer_email' => 'email',
                'customer_password' => 'mật khẩu',
                'customer_phone' => 'số điện thoại',

            ]
        );
        $data = $request->all();
        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_role = 1;
        $customer->customer_email = $data['customer_email'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->customer_phone = $data['customer_phone'];
        $customer->save();
        return Redirect::to('login_customer');
    }

    public function login_customer(Request $request)
    {
        $data = $request->all();
        $customer = Customer::where('customer_email', $data['email'])->where('customer_password', md5($data['password']))->first();
        if ($customer) {
            Session::put('user_name', $customer->customer_name);
            Session::put('user_id', $customer->id);

            return Redirect('trang-chu');
        } else {
            Session::flash('message', 'Email hoặc mật khẩu không đúng');
            return Redirect('login_customer');
        }
    }

    public function logout_customer()
    {
        Session::put('user_name', null);
        Session::put('user_id', null);
        $this->back_home();
    }

    public function info_customer($id)
    {
        $info = Customer::find($id);
        return view('user.info_customer')->with('info', $info);
    }

    public function my_list_order($id)
    {
        $list_order = Order::where('customer_id', $id)->orderBy('id', 'desc')->get();
        if (isset($list_order)) {
            if ($list_order->count() > 0) {
                if (count($list_order) == 0) {
                    $list_order_detail = '';
                } else {
                    foreach ($list_order as $order) {
                        $list_order_detail[] = Order_detail::where('order_id', $order->id)->get();
                    }
                }
                $product_image = [];
                foreach ($list_order_detail as $or) {
                    foreach ($or as $v) {
                        $product_image[] = Product::find($v->product_id);
                    }
                }
            } else {
                $list_order = '';
                $list_order_detail = '';
                $product_image = '';
            }
        } else {
            $list_order = '';
            $list_order_detail = '';
            $product_image = '';
        }

        return view('user.my_list_order')->with('list_order_detail', $list_order_detail)
            ->with('product_image', $product_image);
    }

    public function filter_list_order(Request $request)
    {
        $id = Session('user_id');
        $key = $request->actions;
        if ($key != 'Tất cả') {
            $list_order = Order::where('customer_id', $id)->where('order_status', $key)->orderBy('id', 'desc')->get();
            if (count($list_order) == 0) {
                $list_order = Order::where('customer_id', $id)->orderBy('id', 'desc')->get();
                foreach ($list_order as $order) {
                    $list_order_detail[] = Order_detail::where('order_id', $order->id)->get();
                }
                Session::flash('message', 'Không có đơn hàng nào trong tình trang ' . "'" . $key . "'");
            } else {
                foreach ($list_order as $order) {
                    $list_order_detail[] = Order_detail::where('order_id', $order->id)->get();
                }
            }
        } else {
            $list_order = Order::where('customer_id', $id)->orderBy('id', 'desc')->get();

            foreach ($list_order as $order) {
                $list_order_detail[] = Order_detail::where('order_id', $order->id)->get();
            }
        }
        $product_image = [];
        foreach ($list_order_detail as $or) {
            foreach ($or as $v) {
                $product_image[] = Product::find($v->product_id);
            }
        }
        Session::put('active_filter', $key);

        return view('user.my_list_order')->with('list_order_detail', $list_order_detail)
            ->with('product_image', $product_image);
    }

    public function update_info($id)
    {
        $info = Customer::find($id);
        return view('user.update_info')->with('info', $info);
    }

    public function save_update_info($id, Request $request)
    {
        $request->validate(
            [
                'customer_name' => 'required|regex:/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]*$/',
                'customer_phone' => 'required|numeric|regex:/(0)[0-9]{9}/|digits:10',
                'customer_address' => 'regex:/^[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s ,.]*$/|nullable',
            ],
            [
                'required' => 'Vui lòng nhập :attribute',
                'customer_name.regex' => 'Không sử dụng ký tự đặc biệt và số',
                'numeric' => 'Chỉ nhập số',
                'customer_phone.regex' => 'Số điện thoại không hợp lệ',
                'customer_phone.digits' => 'Số điện thoại không hợp lệ',
                'customer_address.regex' => 'Địa chỉ không hợp lệ'
            ],
            [
                'customer_name' => 'họ và tên',
                'customer_phone' => 'số điện thoại',
                'customer_address' => 'địa chỉ',
            ]
        );
        $data = $request->all();
        $customer = Customer::find($id);
        $customer->customer_name = $data['customer_name'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_address = $data['customer_address'];
        $customer->save();

        return redirect('info_customer/' . $id)->with('info', $customer);
    }

    // Account_user
    public function account_users()
    {
        $this->is_login();
        $list_account_user = Customer::paginate(5);
        $count = Customer::count();
        return view('admin.account.account_users')->with('list_account_user', $list_account_user)->with('count', $count);
    }

    public function search_account_users()
    {
        $this->is_login();
        $key = $_GET['key'];
        $new_key = htmlspecialchars($key);
        $list_account_user = Customer::where('customer_name', 'like', '%' . $new_key . '%')
            ->orwhere('customer_email', 'like', '%' . $new_key . '%')
            ->orwhere('customer_phone', 'like', '%' . $new_key . '%')
            ->orwhere('customer_address', 'like', '%' . $new_key . '%')->paginate(5);
        $count = $list_account_user->count();
        return view('admin.account.account_users')->with('list_account_user', $list_account_user)->with('count', $count);
    }

    public function delete_account_user($id)
    {
        $this->is_login();
        $account = Customer::find($id);
        $account->delete();
        $list_account_user = Customer::paginate(5);
        $count = Customer::count();
        return redirect('account_users')->with('list_account_user', $list_account_user)->with('count', $count);
    }

    // Account_admin
    public function account_admins()
    {
        $this->is_login();
        $list_account_admin = Admin::paginate(5);
        $count = Admin::count();
        return view('admin.account.account_admin')->with('list_account_admin', $list_account_admin)->with('count', $count);
    }

    public function search_account_admins()
    {
        $this->is_login();
        $key = $_GET['key'];
        $new_key = htmlspecialchars($key);
        $list_account_admin = Admin::where('admin_name', 'like', '%' . $new_key . '%')
            ->orwhere('email', 'like', '%' . $new_key . '%')
            ->orwhere('admin_phone', 'like', '%' . $new_key . '%')->paginate(5);
        $count = $list_account_admin->count();
        return view('admin.account.account_admin')->with('list_account_admin', $list_account_admin)->with('count', $count);
    }

    public function delete_account_admin($id)
    {
        $this->is_login();
        $account = Admin::find($id);
        if ($account->role_admin != "Admin") {
            $account->delete();
            Session::flash('message', 'Xóa tài khoản thành công');
        } else {
            Session::flash('message_delete', 'Không thể xóa tài khoản này');
        }
        $list_account_admin = Admin::paginate(5);
        $count = Admin::count();
        return redirect('account_admins')->with('list_account_admin', $list_account_admin)->with('count', $count);
    }

    public function delete_account_shipper($id)
    {
        $this->is_login();
        $account = Shipper::find($id);

        $account->delete();
        Session::flash('message', 'Xóa tài khoản thành công');

        $list_account_shipper = Shipper::paginate(5);
        $count = Shipper::count();
        return redirect('account_shipper')->with('list_account_shipper', $list_account_shipper)->with('count', $count);
    }

    public function cancel_order($id, Request $request)
    {
        $this->is_login();
        $id_user = Session('user_id');
        $status = $request->status;
        echo $status;
        $shipping_id = $request->shipping_id;
        $order = Order::find($id);
        $shipping = Shipping::find($shipping_id);

        $order->order_status = $status;
        $shipping->shipping_status = $status;
        $order->save();
        $shipping->save();
        return Redirect::to('my_list_order/' . $id_user);
    }
    public function account_shipper()
    {
        $this->is_login();
        $list_account_shipper = Shipper::paginate(5);
        $count = Shipper::count();
        return view('admin.account.account_shipper')->with('list_account_shipper', $list_account_shipper)->with('count', $count);
    }
}
