<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Shipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

session_start();


class AdminController extends Controller
{
    //
    public function login()
    {
        return view('admin.login');
    }

    public function admin_index()
    {
        $this->is_login();
        return view('admin.main');
    }

    public function check_login(Request $request)
    {
        $email = $request->admin_email;
        $password = md5($request->admin_password);
        $admin = Admin::where('email', $email)->where('admin_password', $password)->first();

        if ($admin) {
            if ($admin->role_admin == "Admin") {
                Session::put('admin_name', $admin->admin_name);
                Session::put('admin_id', $admin->id);
                Session::put('role', $admin->role_admin);
                redirect('admin_index')->send();
            } else {
                Session::put('admin_name', $admin->admin_name);
                Session::put('admin_id', $admin->id);
                Session::put('role', $admin->role_admin);
                redirect('list_order')->send();
            }
        } else {
            Session::flash('message', 'Email hoặc mật khẩu không đúng');

            return view('admin.login');
        }
    }

    public function logout_admin()
    {
        $this->is_login();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        Session::put('role', null);
        return view('admin.login');
    }

    public function create_account()
    {
        $this->is_login();
        return view('admin.account.create_account');
    }

    public function save_account_by_admin(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required|regex:/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]*$/',
                'email' => 'required|unique:tbl_admin|unique:tbl_shipper',
                'password' => 'required|regex:/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/',
                'phone' => 'required|numeric|regex:/(0)[0-9]{9}/|digits:10',
                'identity_number' => 'required|numeric|regex:/[0-9]{12}/|digits:12',
                'role' => 'required',
                'address' => 'regex:/^[a-zA-Z0-9ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s ,.]*$/|nullable'
            ],
            [
                'required' => 'Vui lòng nhập :attribute',
                'unique' => 'Email đã được đăng ký',
                'fullname.regex' => 'Không sử dụng ký tự đặc biệt và số',
                'password.regex' => 'Kí tự đầu tiên in hoa, độ dài từ 6-32 kí tự',
                'numeric' => 'Chỉ nhập số',
                'phone.regex' => 'Số điện thoại không hợp lệ',
                'phone.digits' => 'Số điện thoại không hợp lệ',
                'identity_number.regex' => 'Số điện thoại không hợp lệ',
                'identity_number.digits' => 'Số điện thoại không hợp lệ',
                'address.regex' => 'Địa chỉ không hợp lệ',

            ],
            [
                'fullname' => 'họ và tên',
                'email' => 'email',
                'password' => 'mật khẩu',
                'phone' => 'số điện thoại',
                'role' => 'vai trò',
                'identity_number' => 'Số căng cước',
                'address' => 'Địa chỉ',
            ]
        );
        $data = $request->all();

        if ($data['role'] == 'admin') {
            $admin = new Admin();
            $admin->email = $data['email'];
            $admin->admin_password = md5($data['password']);
            $admin->admin_name = $data['fullname'];
            $admin->role_admin = "Nhân viên";
            $admin->admin_phone = $data['phone'];
            $admin->identity_number = $data['identity_number'];
            $admin->address = $data['address'];
            $admin->save();

            Session::flash('message', 'Thêm tài khoản thành công');
            return Redirect::to('create_account');
        } else {
            $shipper = new Shipper();
            $shipper->fullname = $data['fullname'];
            $shipper->email = $data['email'];
            $shipper->phonenumber = $data['phone'];
            $shipper->identity_number = $data['identity_number'];
            $shipper->address = $data['address'];
            $shipper->password = md5($data['password']);
            $shipper->save();

            Session::flash('message', 'Thêm tài khoản shipper thành công');
            return Redirect::to('create_account');
        }
    }
}
