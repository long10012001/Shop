@extends('welcome')
@section('content')
    <div id="main-content-wp" class="cart-page">
        <div id="wrapper" class="wp-inner clearfix">
            <h1>Cảm ơn bạn đã đặt hàng tại trang web của chúng tôi!!. Đơn hàng của bạn đang được xử lý.</h1>
            <h1>Vui lòng thanh toán tại đây</h1>
            <input type="hidden" id="for_paypal" value="{{session('total_ship')}}">
            <div id="paypal-button"></div>
        </div>
    </div>
@endsection
