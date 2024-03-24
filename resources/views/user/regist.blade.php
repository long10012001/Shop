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
                            <a href="" title="">Đăng Ký</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp-reg">
                <div class="section-head">
                    <h1 class="section-title">Đăng Ký</h1>
                </div>
                <div class="section-detail">
                    <form method="POST" action="{{ URL::to('add_customer') }}" name="form-checkout">

                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="customer_name">Họ tên</label>
                                @error('customer_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" name="customer_name" id="customer_name">

                            </div>
                            <div class="form-col fl-right">
                                <label for="customer_email">Email</label>
                                @error('customer_email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="email" name="customer_email" id="customer_email">
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="customer_password">Mật khẩu</label>
                                @error('customer_password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="password" name="customer_password" id="customer_password">
                            </div>
                            <div class="form-col fl-right">
                                <label for="customer_phone">Số điện thoại</label>
                                @error('customer_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="tel" name="customer_phone" id="customer_phone">
                            </div>
                        </div>
                        {{-- <div class="form-row">
                            <div class="form-col">
                                <label for="customer_address">Địa chỉ</label>
                                @error('customer_address')
                                    <p>{{ $message }}</p>
                                @enderror
                                <textarea name="customer_address" id="customer_address"></textarea>
                            </div>
                        </div> --}}
                        <div class="place-order-wp clearfix">
                            <span id="forget_pass">Đã có tài khoản? </span><a href="{{ URL::to('login_customer') }}">Đăng
                                nhập</a><br>
                            <input type="submit" id="order-now" value="Đăng Ký">
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
