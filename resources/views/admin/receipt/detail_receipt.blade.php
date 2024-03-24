@extends('admin.layout.layout')
@section('content')
    <div id="content" class="detail-exhibition fl-right">
        <div class="section" id="info">
            <div class="section-head">
                <h3 class="section-title">Thông tin phiếu nhập</h3>
            </div>
            <ul class="list-item">
                <li>
                    <h3 class="title">Mã phiếu nhập</h3>
                    <span class="detail">WEB0{{ $receipt->id }}</span>
                </li>
                <li>
                    <h3 class="title">Tên và Địa chỉ nhà cung cấp</h3>
                    <span class="detail">{{ $receipt->supplier->supplier_name }} /
                        {{ $receipt->supplier->supplier_address }}
                    </span>
                </li>
                <li>
                    <h3 class="title">Phương thức thanh toán</h3>
                    <span class="detail">{{ $receipt->supplier->supplier_method_payment }}</span>
                </li>
                <form method="POST" action="{{ URL::to('update_status_receipt') }}/{{ $receipt->id }}">
                    @csrf
                    <li>
                        <h3 class="title">Tình trạng thanh toán</h3>
                        <select name="status">
                            <option @if ($receipt->status_receipt == 'Chưa thanh toán') selected='selected' @endif value='Chưa thanh toán'>
                                Chưa thanh toán</option>
                            <option @if ($receipt->status_receipt == 'Đã thanh toán') selected='selected' @endif value='Đã thanh toán'>
                                Đã thanh toán</option>

                        </select>
                        {{-- <input type="hidden" name="shipping_id" id="" value="{{ $shipping_id }}"> --}}
                        @if ($receipt->status_receipt == 'Đã thanh toán')
                            <input type="submit" disabled name="sm_status" value="Cập nhật phiếu">
                        @else
                            <input type="submit" name="sm_status" value="Cập nhật phiếu">
                        @endif
                    </li>
                </form>
            </ul>
        </div>
        <div class="section">
            <div class="section-head">
                <h3 class="section-title">Sản phẩm trong phiếu nhập</h3>
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
                            $i = 1;
                        @endphp
                        @foreach ($detail_receipt as $detail)
                            <tr>
                                <td class="thead-text">{{ $i }}</td>
                                <td class="thead-text">
                                    <div class="thumb">
                                        <img src="{{ URL::to('public/uploads/product') }}/{{ $detail->product->product_image }}"
                                            alt="">
                                    </div>
                                </td>
                                <td class="thead-text">{{ $detail->product->product_name }}</td>
                                <td class="thead-text">{{ number_format($detail->price) }}đ</td>
                                <td class="thead-text">{{ $detail->qty }}</td>
                                <td class="thead-text">
                                    {{ number_format($detail->price * $detail->qty) }}đ</td>
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
            <h3 class="section-title">Giá trị phiếu nhập</h3>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <span class="total-fee">Tổng số lượng</span>
                        <span class="total">Tổng đơn hàng</span>
                    </li>
                    <li>
                        <span class="total-fee">{{ $total_qty }} sản phẩm</span>
                        <span class="total">{{ number_format($total_price) }}đ</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
