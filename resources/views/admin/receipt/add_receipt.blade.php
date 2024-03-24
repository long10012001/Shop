@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Thêm phiếu nhập sản phẩm đã có</h3>
                <a href="{{ URL::to('add_product') }}" title="" id="add-new" class="fl-left">Thêm mới sản phẩm</a>

            </div>
        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <div class="filter-wp clearfix">
                    <ul class="post-status fl-left">
                        <li class="all"><a href="">Tất cả <span class="count">({{ $count }})</span></a>
                        </li>
                    </ul>
                    <form method="get" action="{{ URL::to('search_product_receipt_admin') }}" class="form-s fl-right">
                        {{-- @csrf --}}
                        <input type="text" name="key" id="search_admin" class="search_admin">
                        <input type="submit" name="sm_s" value="Tìm kiếm" class="search_admin">
                    </form>
                </div>
                <div class="actions">
                    <form method="get" action="{{ URL::to('filter_product_receipt_search') }}" class="form-actions">
                        {{-- @csrf --}}
                        <select name="category">
                            <option value="0">Thương hiệu</option>
                            @foreach ($list_category as $category)
                                @if ($category_search == $category->id)
                                    <option selected value="{{ $category->id }}">{{ $category->brand_name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->brand_name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <select name="status">

                            <option @if ($status == 1) {{ $selected = 'selected' }} @endif value="1">Ẩn
                            </option>

                            <option @if ($status == 0) {{ $selected = 'selected' }} @endif value="0">
                                Hiện
                            </option>

                        </select>
                        <input type="submit" name="sm_action" value="Áp dụng">
                    </form>
                </div>
                @if (Session::get('message'))
                    <span class="text-success mr-5">{{ Session::get('message') }}</span>
                @endif
                <div class="table-responsive">
                    <form method="POST" action="{{ URL::to('save_receipt') }}">
                        <button type="submit" name="btn-submit" id="btn-submit">Thêm phiếu nhập</button>
                        <label for="supplier_name">Nhà cung cấp</label>
                        <input type="text" id='supplier_name' name='supplier_name'>
                        <label for="supplier_address">Địa chỉ nhà cung cấp</label>
                        <input type="text" id='supplier_address' name="supplier_address">
                        <select name="status_receipt">
                            <option value="0">Trạng thái</option>
                            <option value="Chưa thanh toán">Chưa thanh toán</option>
                            <option value="Đã thanh toán">Đã thanh toán</option>
                        </select>
                        <select name="supplier_method_payment">
                            <option value="0">Phương thức thanh toán</option>
                            <option value="Chuyển khoản">Chuyển khoản</option>
                            <option value="Nhận tiền mặt">Nhận tiền mặt</option>
                        </select>
                        @csrf
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã sản phẩm</span></td>
                                    <td style="width: 15%"><span class="thead-text">Hình ảnh</span></td>

                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Số lượng</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>

                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($all_product as $item)
                                    <tr>
                                        <td><input type="checkbox" name="checkItem[]" class="checkItem"
                                                value="{{ $item->id }}"></td>
                                        <td><span class="tbody-text">{{ $i++ }}</span>
                                        <td><span class="tbody-text">WEB0{{ $item->id }}</span>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="public/uploads/product/{{ $item->product_image }}"
                                                    alt="">
                                            </div>
                                        </td>

                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title="">{{ $item->product_name }}</a>
                                            </div>

                                        </td>
                                        <td><span class="tbody-text">{{ number_format($item->product_price) }}đ</span></td>
                                        <td><span class="tbody-text">{{ $item->product_qty }}</span></td>
                                        <td><span class="tbody-text">{{ $item->category->category_name }}</span></td>

                                        <td><span class="tbody-text">{{ $item->product_by }}</span></td>
                                        <td><span class="tbody-text">{{ $item->brand->created_at->format('d-m-Y') }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        @if (isset($_GET['key']))
            {{ $all_product->appends(['key' => $_GET['key']])->links('/vendor/pagination/bootstrap-4') }}
        @elseif (isset($_GET['category']))
            {{ $all_product->appends(['category' => $_GET['category'], 'status' => $_GET['status']])->links('/vendor/pagination/bootstrap-4') }}
        @else
            {{ $all_product->links('/vendor/pagination/bootstrap-4') }}
        @endif


    </div>
@endsection
