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
                            <a href="" title="">Thanh toán</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @if (!Session('user_name'))
            <h3>Vui lòng đăng nhập để có thể xem lại các đơn hàng đã mua</h3>
        @endif


        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <form method="POST" action="{{ URL::to('save_checkout') }}" name="form-checkout">
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="shipping_name">Họ tên</label>
                                @error('shipping_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" name="shipping_name" id="shipping_name"
                                    value="{{ $customer->customer_name }}">
                            </div>
                            <div class="form-col fl-right">
                                <label for="shipping_email">Email</label>
                                @error('shipping_email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="email" name="shipping_email" id="shipping_email"
                                    value="{{ $customer->customer_email }}">
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            {{-- <form method="POST"> --}}
                            {{-- @csrf --}}
                            <div class="form-col fl-left">
                                <label for="title">Quận, Huyện</label>
                                @error('district')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <select name="district" id="district" class="choose district">
                                    <option value="">-- Chọn Quận, Huyện --</option>
                                    @foreach ($district as $item)
                                        @if ($item->id_district == Session('id_district'))
                                            <option selected value="{{ $item->id_district }}">{{ $item->name_district }}
                                            </option>
                                        @else
                                            <option value="{{ $item->id_district }}">{{ $item->name_district }}</option>
                                        @endif
                                        {{-- <option selected value="{{ $item->id_district }}">{{ $item->name_district }}</option> --}}
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-col fl-right">
                                <label for="title">Xã Phường, Thị Trấn</label>
                                @error('wards')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <select name="wards" id="wards" class="wards">
                                    @if (Session('id_wards') != null)
                                        @foreach ($wards as $item)
                                            @if ($item->id_wards == Session('id_wards'))
                                                <option selected value="{{ $item->id_wards }}">{{ $item->name_wards }}
                                                </option>
                                            @else
                                                <option value="{{ $item->id_wards }}">{{ $item->name_wards }}</option>
                                            @endif
                                            {{-- <option selected value="{{ $item->id_district }}">{{ $item->name_district }}</option> --}}
                                        @endforeach
                                    @else
                                        <option value="">-- Chọn Xã Phường, Thị Trấn --</option>
                                    @endif
                                </select>
                            </div>
                            {{-- <button type="button" name="btn-submit" class="add_fee" id="btn-submit">Thêm phí vận
                                    chuyển</button> --}}
                            {{-- </form> --}}

                        </div>
                        {{-- {{Session('fee_ship')}} --}}
                        <div id="fee"></div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="shipping_address_detail">Địa chỉ cụ thể</label>
                                @error('shipping_address_detail')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="text" name="shipping_address_detail" id="shipping_address_detail"
                                    value="{{ $customer->customer_address }}">

                            </div>
                            <div class="form-col fl-right">
                                <label for="shipping_phone">Số điện thoại</label>
                                @error('shipping_phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="tel" name="shipping_phone" id="shipping_phone"
                                    value="{{ $customer->customer_phone }}">
                            </div>
                        </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $product)
                                <tr class="cart-item">
                                    <td class="product-name">{{ $product->name }}<strong class="product-quantity">x
                                            {{ $product->qty }}</strong></td>
                                    <td class="product-total">{{ number_format($product->price * $product->qty) }}đ</td>
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr class="order-total">

                                <td>Phí vận chuyển:</td>
                                <td><strong id="fee_ship"
                                        class="total-price">{{ number_format(Session('fee_ship')) }}đ</strong></td>

                            </tr>
                            <tr class="order-total">

                                <td>Tổng đơn hàng:</td>
                                <td><strong id="total" class="total-price">
                                        @if (Session('total_ship') != null)
                                            {{ number_format(Session('total_ship')) }}đ
                                        @else
                                            {{ Cart::subtotal(0) }}đ
                                        @endif
                                    </strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        @error('payment_method')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="payment-home" name="payment_method" value="Thanh toán tại nhà">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-paypal" @if (session('success_transaction') == '1') checked @endif
                                    name="payment_method" value="Thanh toán PayPal">

                                <label for="payment-paypal">
                                    @if (Session('href') != null)
                                        <a class="text-dark" href="http://localhost/shop/process-transaction"
                                            id="paypal">Thanh
                                            toán bằng
                                            PayPal</a>
                                    @else
                                        <a class="text-dark" href="" id="paypal">Thanh
                                            toán bằng
                                            PayPal</a>
                                    @endif
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">

                        <a href=""><input type="submit" id="order-now" value="Đặt hàng"></a>


                    </div>
                    @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
