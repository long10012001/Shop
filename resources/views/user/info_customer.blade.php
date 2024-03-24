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
                            <a href="" title="">Thông tin khách hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp-reg">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    

                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="customer_name">Họ tên</label>
                               
                                <input type="text" name="customer_name" id="customer_name" disabled value="{{$info->customer_name}}">

                            </div>
                            <div class="form-col fl-right">
                                <label for="customer_email">Email</label>
                                
                                <input type="email" name="customer_email" id="customer_email" disabled value="{{$info->customer_email}}">
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="customer_address">Địa chỉ</label>
                               
                                <input type="text" name="customer_address" id="customer_address" disabled value="{{$info->customer_address}}">
                            </div>
                            <div class="form-col fl-right">
                                <label for="customer_phone">Số điện thoại</label>
                               
                                <input type="tel" name="customer_phone" id="customer_phone" disabled value="{{$info->customer_phone}}">
                            </div>
                        </div>
                        
                        
                    </div>
                    <button class="btn btn-danger border-1 rounded-0 float-right"><a href="{{URL::to('update_info')}}/{{Session('user_id')}} " class="text-white">Cập nhật thông tin</a></button>
                </div>
        </div>
    </div>
@endsection
