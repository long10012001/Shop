@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
            </div>
        </div>
        <span class="text-success" id="success">{{ Session('message') }}</span>

        <div class="section" id="detail-page">
            <div class="section-detail">
                <div class="filter-wp clearfix">
                    <ul class="post-status fl-left">
                        <li class="all"><a href="">Tất cả <span class="count">({{ $count }})</span></a>
                        </li>
                    </ul>
                    <form method="get" action="{{ URL::to('search_order') }}" class="form-s fl-right">
                        {{-- @csrf --}}
                        <input type="text" name="key" id="search_admin" class="search_admin"
                            placeholder="Mã đơn hàng chỉ nhập số">
                        <input type="submit" name="sm_s" value="Tìm kiếm" class="search_admin">
                    </form>
                </div>
                <div class="actions">
                    <form method="get" action="{{ URL::to('filter_status_order') }}" class="form-actions">
                        {{-- @csrf --}}
                        <select name="actions">
                            <option value="0">Trạng thái</option>
                            <option value="Đang chờ xử lý">Đang chờ xử lý</option>
                            <option value="Đang vận chuyển">Đang vận chuyển</option>
                            <option value="Thành công">Giao hàng thành công</option>
                        </select>
                        <input type="submit" name="sm_action" value="Áp dụng">
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table list-table-wp">
                        <thead>
                            <tr>

                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Mã đơn hàng</span></td>
                                <td><span class="thead-text">Họ và tên</span></td>
                                <td><span class="thead-text">Số sản phẩm</span></td>
                                <td><span class="thead-text">Tổng giá</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                                <td><span class="thead-text">Chi tiết</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($list_order as $order)
                                <tr>

                                    <td><span class="tbody-text">{{ $i++ }}</h3></span>
                                    <td><span class="tbody-text">
                                            @if (isset($order->order->id))
                                                {{ $order->order->order_code }}
                                            @else
                                                {{ $order->order_code }}
                                            @endif
                                            </h3>
                                        </span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{ $order->customer->customer_name }}</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a onclick="return confirm('Bạn có muốn xoá đơn hàng của {{ $order->order_code }}?')"
                                                    href="{{ URL::to('delete_order') }}/{{ $order->id }}" title="Xóa"
                                                    class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">{{ $order->order_number }}
                                            @if (isset($order->order->order_number))
                                                {{ $order->order->order_number }}
                                            @endif
                                        </span></td>
                                    <td><span class="tbody-text">{{ number_format($order->order_total) }}
                                            @if (isset($order->order->order_total))
                                                {{ number_format($order->order->order_total) }}
                                            @endif
                                            đ
                                        </span></td>
                                    <td><span class="tbody-text">{{ $order->order_status }}
                                            @if (isset($order->order->order_status))
                                                {{ $order->order->order_status }}
                                            @endif
                                        </span></td>
                                    <td><span class="tbody-text">{{ $order->created_at->format('d-m-Y') }}</span></td>
                                    <td><a href="{{ URL::to('order_detail1') }}/{{ $order->id }}" title=""
                                            class="tbody-text">Chi
                                            tiết</a></td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        @if (isset($_GET['actions']))
            {{ $list_order->appends(['actions' => $_GET['actions']])->links('/vendor/pagination/bootstrap-4') }}
        @elseif(isset($_GET['key']))
            {{ $list_order->appends(['key' => $_GET['key']])->links('/vendor/pagination/bootstrap-4') }}
        @else
            {{ $list_order->links('/vendor/pagination/bootstrap-4') }}
        @endif


    </div>
@endsection
