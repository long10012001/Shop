@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Danh sách phiếu nhập sản phẩm</h3>
                <a href="{{ URL::to('add_receipt') }}" title="" id="add-new" class="fl-left">Thêm phiếu nhập
                    hàng</a>
            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <div class="filter-wp clearfix">
                    <ul class="post-status fl-left">
                        <li class="all"><a href="">Tất cả <span class="count">({{ $count }})</span></a>
                        </li>
                    </ul>

                </div>
                <div class="actions">
                    <form method="get" action="{{ URL::to('filter_receipt') }}" class="form-actions">
                        <select name="id_receipt">
                            <option value="0">Mã phiếu nhập</option>
                            @foreach ($list_receipt as $receipt)
                                @if ($id_receipt == $receipt->id)
                                    <option selected value="{{ $receipt->id }}">WEB0{{ $receipt->id }}</option>
                                @else
                                    <option value="{{ $receipt->id }}">WEB0{{ $receipt->id }}</option>
                                @endif
                            @endforeach

                        </select>

                        <select name="status">
                            <option value="0">Trạng thái</option>

                            <option @if ($status == 'Chưa thanh toán') {{ $selected = 'selected' }} @endif
                                value="Chưa thanh toán">Chưa thanh toán
                            </option>

                            <option @if ($status == 'Đã thanh toán') {{ $selected = 'selected' }} @endif
                                value="Đã thanh toán">
                                Đã thanh toán
                            </option>

                        </select>
                        <input type="submit" name="sm_action" value="Áp dụng">
                    </form>
                </div>
                @if (Session::get('message'))
                    <span class="text-success mr-5">{{ Session::get('message') }}</span>
                @endif
                <div class="table-responsive">
                    <table class="table list-table-wp">
                        <thead>
                            <tr>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Mã sản phẩm</span></td>

                                <td><span class="thead-text">Tên nhà phân phối</span></td>
                                <td><span class="thead-text">Số lượng</span></td>
                                <td><span class="thead-text">Phương thức thanh toán</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>

                                <td><span class="thead-text">Người tạo</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($all_receipts as $receipt)
                                <tr>

                                    <td><span class="tbody-text">{{ $i++ }}</span>
                                    <td><span class="tbody-text">WEB0{{ $receipt->id }}</span>


                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="{{ URL::to('detail_receipt') }}/{{ $receipt->id }}"
                                                title="">{{ $receipt->supplier->supplier_name }}</a>
                                        </div>

                                    </td>

                                    <td><span class="tbody-text">{{ $receipt->total_receipt }}</span></td>
                                    <td><span class="tbody-text">{{ $receipt->supplier->supplier_method_payment }}</span>
                                    </td>
                                    <td><span class="tbody-text">{{ $receipt->status_receipt }}</span></td>

                                    <td><span class="tbody-text">{{ $receipt->admin->admin_name }}</span></td>
                                    <td><span class="tbody-text">{{ $receipt->created_at->format('d-m-Y') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @if (isset($_GET['key']))
            {{ $all_receipts->appends(['key' => $_GET['key']])->links('/vendor/pagination/bootstrap-4') }}
        @elseif (isset($_GET['category']))
            {{ $all_receipts->appends(['category' => $_GET['category'], 'status' => $_GET['status']])->links('/vendor/pagination/bootstrap-4') }}
        @else
            {{ $all_receipts->links('/vendor/pagination/bootstrap-4') }}
        @endif


    </div>
@endsection
