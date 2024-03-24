@extends('admin.layout.layout')
@section('content')
    <div id="content" class="detail-exhibition fl-right">
        <div class="section" id="info">
            <div class="section-head">
                <h3 class="section-title">Thông tin đơn hàng</h3>
            </div>
            <ul class="list-item">
                <li>
                    <h3 class="title">Mã đơn hàng</h3>
                    <span class="detail">{{ $order_code }}</span>
                </li>
                <li>
                    <h3 class="title">Địa chỉ nhận hàng</h3>
                    <span class="detail">{{ $info['shipping_address'] }} / {{ $info['shipping_phone'] }}</span>
                </li>
                <li>
                    <h3 class="title">Thông tin vận chuyển</h3>
                    <span class="detail">{{ $payment_method }}</span>
                </li>
                <form method="POST" action="{{ URL::to('update_status_order') }}/{{ $id }}">
                    @csrf
                    <li>
                        <h3 class="title">Tình trạng đơn hàng</h3>
                        <select name="status">
                            <option @if ($status == 'Đang chờ xử lý') selected='selected' @endif value='Đang chờ xử lý'>Đang
                                chờ xử lý</option>
                            <option @if ($status == 'Đang vận chuyển') selected='selected' @endif value='Đang vận chuyển'>
                                Đang vận chuyển</option>
                            <option @if ($status == 'Thành công') selected='selected' @endif value='Thành công'>Thành
                                công</option>
                        </select>
                        <input type="hidden" name="shipping_id" id="" value="{{ $shipping_id }}">
                        @if ($status == 'Thành công')
                            <input type="submit" disabled name="sm_status" value="Cập nhật đơn hàng">
                        @else
                            <input type="submit" name="sm_status" value="Cập nhật đơn hàng">
                        @endif
                    </li>
                </form>
            </ul>
        </div>
        <div class="section">
            <div class="section-head">
                <h3 class="section-title">Sản phẩm đơn hàng</h3>
            </div>
            <div class="table-responsive">
                <table class="table info-exhibition">
                    <thead>
                        <tr>
                            <td class="thead-text">STT</td>
                            <td class="thead-text">Ảnh sản phẩm</td>
                            <td class="thead-text">Tên sản phẩm</td>
                            <td class="thead-text">Đơn giá</td>
                            <td class="thead-text">Số lượng</td>
                            <td class="thead-text">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($detail as $product)
                            <tr>
                                <td class="thead-text">1</td>
                                <td class="thead-text">
                                    <div class="thumb">
                                        <img src="{{ URL::to('public/uploads/product') }}/{{ $product_image[$i]->product_image }}"
                                            alt="">
                                    </div>
                                </td>
                                <td class="thead-text">{{ $product->product_name }}</td>
                                <td class="thead-text">{{ number_format($product->product_price) }}đ</td>
                                <td class="thead-text">{{ $product->product_qty }}</td>
                                <td class="thead-text">
                                    {{ number_format($product->product_price * $product->product_qty) }}đ</td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="section">
            <h3 class="section-title">Giá trị đơn hàng</h3>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <span class="total-fee">Tổng số lượng</span>
                        <span class="total">Tổng đơn hàng</span>
                    </li>
                    <li>
                        <span class="total-fee">{{ $total_qty }} sản phẩm</span>
                        <span class="total">{{ number_format($product->order->order_total) }}đ</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
