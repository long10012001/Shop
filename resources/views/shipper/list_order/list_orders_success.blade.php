@extends('shipper.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Danh sách đơn hàng đã giao thành công</h3>
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
                    <form method="get" action="{{ URL::to('search_order_shipper') }}" class="form-s fl-right">
                        {{-- @csrf --}}
                        <input type="text" name="key_order_success" id="search_admin" class="search_admin"
                            placeholder="Nhập thông tin tìm kiếm">
                        <input type="submit" name="sm_s" value="Tìm kiếm" class="search_admin">
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

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($list_order_success as $key => $order)
                                <tr>

                                    <td><span class="tbody-text">{{ $key + 1 }}</h3></span>
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

                                    </td>
                                    <td><span class="tbody-text">{{ $order->order_number }}
                                            @if (isset($order->order->order_number))
                                                {{ $order->order->order_number }}
                                            @endif
                                        </span></td>
                                    <td><span class="tbody-text">
                                            @if (isset($order->order->order_total))
                                                {{ number_format($order->order->order_total) }}
                                            @else
                                                {{ number_format($order->order_total) }}
                                            @endif
                                            đ
                                        </span></td>
                                    <td><span class="tbody-text">{{ $order->order_status }}
                                            @if (isset($order->order->order_status))
                                                {{ $order->order->order_status }}
                                            @endif
                                        </span></td>
                                    <td><span class="tbody-text">{{ $order->created_at }}</span></td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        @if (isset($_GET['actions']))
            {{ $list_order_success->appends(['actions' => $_GET['actions']])->links('/vendor/pagination/bootstrap-4') }}
        @elseif(isset($_GET['key_order_success']))
            {{ $list_order_success->appends(['key_order_success' => $_GET['key_order_success']])->links('/vendor/pagination/bootstrap-4') }}
        @else
            {{ $list_order_success->links('/vendor/pagination/bootstrap-4') }}
        @endif


    </div>
@endsection
