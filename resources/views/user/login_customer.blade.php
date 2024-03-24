@extends('welcome')
@section('content')
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?page=home" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Đăng nhập</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp-reg">
                <div class="section-head">
                    <h1 class="section-title">Đăng Nhập</h1>
                </div>
                <div class="section-detail">
                    <span>{{ Session('message') }}</span>
                    <form method="POST" action="{{ URL::to('login_customer') }}" name="form-checkout">
                        @csrf
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email">
                            </div>
                            <div class="form-col fl-right">
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" id="password">
                            </div>
                        </div>

                        <div class="place-order-wp clearfix">

                            <span id="forget_pass">Chưa có tài khoản? </span><a href="{{ URL::to('regist') }}">Tạo tài
                                khoản</a>
                            <input type="submit" id="order-now" value="Đăng nhập">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
