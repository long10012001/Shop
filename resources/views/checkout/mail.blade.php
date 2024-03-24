<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pb-2">
                <p>Đây là mail tự động, vui lòng không trả lời mail này.</p>
            </div>
            <div class="col-12 text-center">
                <h1>Trang Mua Sắm Trực Tuyến ISMART</h1>
                <h3>Mail Xác Nhận Đơn Hàng!!!</h3>
            </div>
            <div class="col-12">
                <p><strong>Gửi: </strong>{{ $shipping_array['shipping_name'] }}</p>
                <p>Xin trân thành cảm ơn bạn đã quyết định mua sắm tại trang web của chúng tôi. Dưới đây là thông tin
                    đơn hàng của bạn!</p>
                <h5>Thông Tin Đơn Hàng:</h5>
                <p><strong>Mã đơn hàng: </strong>{{ $shipping_array['order_code'] }}</p>
                <p><strong>Hình thức thanh toán: </strong>{{ $shipping_array['shipping_method'] }}</p>
                <h5>Thông Tin Người Nhận:</h5>
                <p><strong>Họ tên người nhận: </strong>{{ $shipping_array['shipping_name'] }}</p>
                <p><strong>Email: </strong>{{ $shipping_array['shipping_mail'] }}</p>
                <p><strong>Địa chỉ nhận hàng: </strong>{{ $shipping_array['shipping_address'] }}</p>
                <p><strong>Số điện thoại: </strong>{{ $shipping_array['shipping_phone'] }}</p>
            </div>
            <div class="col-12">
                <h5>Sản Phẩm Đã Đặt:</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Giá tiền</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($cart_array as $product)
                            <tr>
                                <td>{{ $product['product_name'] }}</td>
                                <td>{{ number_format($product['product_price']) }} đ</td>
                                <td>{{ $product['product_qty'] }}</td>
                                <td>{{ number_format($product['product_price'] * $product['product_qty']) }} đ</td>
                            </tr>
                            @php
                                $total += $product['product_price'] * $product['product_qty'];
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right">Tổng tiền thanh toán: {{ number_format($total) }} đ</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-12">
                <p>Mọi chi tiết thắc mắc vui lòng liền hệ: <strong>0988888888</strong>. Xin cảm ơn quý khách!!!</p>
            </div>
        </div>
    </div>
</body>

</html>
