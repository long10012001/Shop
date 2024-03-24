@extends('welcome')
@section('content')
    <div id="main-content-wp" class="cart-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ 'trang-chu' }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Giỏ hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @if (Cart::count() > 0)
            <div id="wrapper" class="wp-inner clearfix">
                <div class="section" id="info-cart-wp">
                    <div class="section-detail table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Mã sản phẩm</td>
                                    <td>Ảnh sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Giá sản phẩm</td>
                                    <td>Số lượng</td>
                                    <td colspan="2">Thành tiền</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $product)
                                    <tr>
                                        <td>HCA00031</td>
                                        <td>
                                            <a href="{{ URL::to('detail_product') }}/{{ $product->id }}" title=""
                                                class="thumb">
                                                <img src="{{ URL::to('public/uploads/product') }}/{{ $product->options->image }}"
                                                    alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('detail_product') }}/{{ $product->id }}" title=""
                                                class="name-product">{{ $product->name }}</a>
                                        </td>
                                        <td>{{ number_format($product->price) }}đ</td>
                                        <td>
                                            <form action="{{ URL::to('update_cart_qty') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" id=""
                                                    value="{{ $product->rowId }}">
                                                <input type="number" name="qty_product" value="{{ $product->qty }}"
                                                    min='1' max="{{ $product->options->qty_store }}"
                                                    class="num-order">
                                                <input type="submit" value="Cập nhật" name="update" class="btn_submit">
                                            </form>
                                        </td>
                                        <td>{{ number_format($product->price * $product->qty) }}đ</td>
                                        <td>
                                            <a onclick="return confirm('Bạn có muốn xoá sản phẩm {{ $product->name }}?')"
                                                href="{{ URL::to('delete_product_cart') }}/{{ $product->rowId }}"
                                                title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <p id="total-price" class="fl-right">Tổng giá:
                                                <span>{{ Cart::subtotal(0) }}đ</span>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <div class="fl-right">

                                                <a href="{{ URL::to('checkout') }}" title="" id="checkout-cart">Thanh
                                                    toán</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng
                            <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.
                        </p>
                        <a href="{{ URL::to('trang-chu') }}" title="" id="buy-more">Mua tiếp</a><br />

                    </div>
                </div>
            </div>
        @else
            <div id="wrapper" class="wp-inner clearfix">
                <div class="section" id="info-cart-wp">
                    <h1 class="h3">Không có sản phẩm nào trong giỏ hàng!!!</h1>
                </div>
            </div>
        @endif

    </div>
@endsection
