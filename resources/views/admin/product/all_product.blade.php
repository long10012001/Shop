@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                <a href="{{ URL::to('add_product') }}" title="" id="add-new" class="fl-left">Thêm mới</a>
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
                    <form method="get" action="{{ URL::to('search_product_admin') }}" class="form-s fl-right">
                        {{-- @csrf --}}
                        <input type="text" name="key" id="search_admin" class="search_admin">
                        <input type="submit" name="sm_s" value="Tìm kiếm" class="search_admin">
                    </form>
                </div>
                <div class="actions">
                    <form method="get" action="{{ URL::to('filter_search') }}" class="form-actions">
                        {{-- @csrf --}}
                        <select name="brand">
                            <option value="0">Danh mục</option>
                            @foreach ($list_brand as $brand)
                                @if ($brand_search == $brand->id)
                                    <option selected value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @else
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
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
                    <table class="table list-table-wp">
                        <thead>
                            <tr>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Mã sản phẩm</span></td>
                                <td style="width: 15%"><span class="thead-text">Hình ảnh</span></td>
                                <td>Ảnh liên quan</td>
                                <td><span class="thead-text">Tên sản phẩm</span></td>
                                <td><span class="thead-text">Giá bán ra</span></td>
                                <td><span class="thead-text">Giá nhập mới nhất</span></td>
                                <td><span class="thead-text">Số lượng</span></td>
                                <td><span class="thead-text">Danh mục</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
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

                                    <td><span class="tbody-text">{{ $i++ }}</span>
                                    <td><span class="tbody-text">WEB0{{ $item->id }}</span>
                                    <td>
                                        <div class="tbody-thumb">
                                            <img src="public/uploads/product/{{ $item->product_image }}" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('add_gallery') }}/{{ $item->id }}">Thêm ảnh liên quan</a>
                                    </td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{ $item->product_name }}</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="{{ URL::to('edit_product') }}/{{ $item->id }}" title="Sửa"
                                                    class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a onclick="return confirm('Bạn có muốn xoá sản phẩm của {{ $item->product_name }}?')"
                                                    href="{{ URL::to('delete_product') }}/{{ $item->id }}"
                                                    title="Xóa" class="delete"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">{{ number_format($item->product_price) }}đ</span></td>
                                    <td><span class="tbody-text">
                                            @if (isset($detail_receipt[$i - 2][0]->product_id))
                                                @if ($detail_receipt[$i - 2][0]->product_id == $item->id)
                                                    {{ number_format($detail_receipt[$i - 2][0]->price) }}đ
                                                @endif
                                            @endif
                                        </span></td>


                                    <td><span class="tbody-text">{{ $item->product_qty }}</span></td>
                                    <td><span class="tbody-text">{{ $item->category->category_name }}</span></td>
                                    <td><span class="tbody-text">
                                            @if ($item->product_status == 0)
                                                <a href="{{ URL::to('unactive_product') }}/{{ $item->id }}"><span
                                                        class="fa fa-thumbs-down fa-thumbs unact "></span></a>
                                            @else
                                                <a href="{{ URL::to('active_product') }}/{{ $item->id }}"><span
                                                        class="fa fa-thumbs-up fa-thumbs act"></span></a>
                                            @endif
                                        </span></td>
                                    <td><span class="tbody-text">{{ $item->product_by }}</span></td>
                                    <td><span class="tbody-text">{{ $item->brand->created_at->format('d-m-Y') }}</span>
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
            {{ $all_product->appends(['key' => $_GET['key']])->links('/vendor/pagination/bootstrap-4') }}
        @elseif (isset($_GET['category']))
            {{ $all_product->appends(['category' => $_GET['category'], 'status' => $_GET['status']])->links('/vendor/pagination/bootstrap-4') }}
        @else
            {{ $all_product->links('/vendor/pagination/bootstrap-4') }}
        @endif


    </div>
@endsection
