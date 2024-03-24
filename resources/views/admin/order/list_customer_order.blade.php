@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
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
                    <form method="GET" action="{{ URL::to('search_customer') }}" class="form-s fl-right">

                        <input type="text" name="key" id="search_admin" class="search_admin">
                        <input type="submit" name="sm_s" value="Tìm kiếm" class="search_admin">
                    </form>
                </div>
                <div class="actions">
                    <form method="GET" action="{{ URL::to('filter_status_order_customer') }}" class="form-actions">

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
                                <td><span class="thead-text">Họ và tên</span></td>
                                <td><span class="thead-text">Số điện thoại</span></td>
                                <td><span class="thead-text">Email</span></td>
                                <td><span class="thead-text">Địa chỉ</span></td>
                                <td><span class="thead-text">Đơn hàng</span></td>
                                <td><span class="thead-text">Tình trạng</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($list_customer_order as $customer)
                                <tr>

                                    <td><span class="tbody-text">{{ $i++ }}</h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{ $customer->shipping_name }}</a>
                                        </div>
                                        <ul class="list-operation fl-right">

                                            <li><a onclick="return confirm('Bạn có muốn xoá khách hàng của {{ $customer->shipping_name }}?')"
                                                    href="{{ URL::to('delete_customer_order') }}/{{ $customer->id }}"
                                                    title="Xóa" class="delete"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">{{ $customer->shipping_phone }}</span></td>
                                    <td><span class="tbody-text">{{ $customer->shipping_email }}</span></td>
                                    <td><span class="tbody-text">{{ $customer->shipping_address }}</span></td>
                                    <td><span class="tbody-text">{{ $customer->order->order_code }}</span></td>
                                    <td><span class="tbody-text">{{ $customer->shipping_status }}</span></td>
                                    <td><span class="tbody-text">{{ $customer->created_at->format('d-m-Y') }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        @if (isset($_GET['actions']))
            {{ $list_customer_order->appends(['actions' => $_GET['actions']])->links('/vendor/pagination/bootstrap-4') }}
        @elseif(isset($_GET['key']))
            {{ $list_customer_order->appends(['key' => $_GET['key']])->links('/vendor/pagination/bootstrap-4') }}
        @else
            {{ $list_customer_order->links('/vendor/pagination/bootstrap-4') }}
        @endif

    </div>
@endsection
