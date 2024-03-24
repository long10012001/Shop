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
                            <a href="" title="">Cập nhật thông tin khách hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp-reg">
                <div class="section-head">
                    <h1 class="section-title">Cập nhật thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <form method="POST" action="{{ URL::to('save_update_info') }}/{{ Session('user_id') }}">
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="customer_name">Họ tên</label>
                                @error('customer_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" name="customer_name" id="customer_name"
                                    value="{{ $info->customer_name }}">

                            </div>
                           <div class="form-col fl-right">
                                <label for="customer_address">Địa chỉ</label>
                                @error('customer_address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" name="customer_address" id="customer_address"
                                    value="{{ $info->customer_address }}">
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            
                            <div class="form-col fl-left">
                                <label for="customer_phone">Số điện thoại</label>
                                @error('customer_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="tel" name="customer_phone" id="customer_phone"
                                    value="{{ $info->customer_phone }}">
                            </div>
                        </div>
                        @csrf
                        <button type="submit" name="btn-submit" id="btn-submit"
                            class="btn btn-danger border-1 rounded-0 float-right">Cập nhật</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
