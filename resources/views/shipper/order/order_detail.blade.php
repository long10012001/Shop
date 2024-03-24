@extends('shipper.layout.layout')
@section('content')
    <div id="content" class="detail-exhibition fl-right">
        <div class="section" id="info">
            <div class="section-head">
                <h3 class="section-title">Thông tin đơn hàng</h3>
            </div>
            <ul class="list-item">
                <li>
                    <h3 class="title">Mã đơn hàng</h3>
                    <span class="detail">{{ $order->order_code }}</span>
                </li>
                <li>
                    <h3 class="title">Địa chỉ nhận hàng</h3>
                    <span class="detail">{{ $shipping['shipping_address'] }}</span>
                </li>
                <li>
                    <h3 class="title">Khách hàng</h3>
                    <span class="detail">{{ $shipping->shipping_name }} / {{ $shipping['shipping_phone'] }}</span>
                </li>
                <li>
                    <h3 class="title">Thông tin vận chuyển</h3>
                    <span class="detail">{{ $order->payment_method }}</span>
                </li>
                <form method="POST" action="{{ URL::to('update_status_order_shipper') }}/{{ $order->id }}">
                    @csrf
                    <li>
                        <h3 class="title">Tình trạng đơn hàng</h3>
                        <select name="status">
                            <option @if ($order->order_status == 'Đang chờ xử lý') selected='selected' @endif value='Đang chờ xử lý'>Đang
                                chờ xử lý</option>
                            <option @if ($order->order_status == 'Đang vận chuyển') selected='selected' @endif value='Đang vận chuyển'>
                                Đang vận chuyển</option>
                            <option @if ($order->order_status == 'Thành công') selected='selected' @endif value='Thành công'>Thành
                                công</option>
                        </select>
                        <input type="hidden" name="shipping_id" id="" value="{{ $shipping->id }}">
                        @if ($order->order_status == 'Thành công')
                            <input type="submit" disabled name="sm_status" value="Cập nhật đơn hàng">
                        @else
                            <input type="submit" name="sm_status" value="Cập nhật đơn hàng">
                        @endif
                    </li>
                </form>
            </ul>
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
                        <span class="total-fee">{{ $order->order_number }} sản phẩm</span>
                        <span class="total">{{ number_format($order->order_total) }}đ</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
