@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Danh sách thương hiệu sản phẩm</h3>
                <a href="{{ URL::to('add_brand_product') }}" title="" id="add-new" class="fl-left">Thêm mới</a>
            </div>



        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <div class="filter-wp clearfix">
                    <ul class="post-status fl-left">
                        <li class="all"><a href="">Tất cả <span class="count">({{ $count }})</span></a>
                        </li>
                    </ul>
                    <form method="get" action="{{ URL::to('search_brand') }}" class="form-s fl-right">
                        {{-- @csrf --}}
                        <input type="text" name="key" id="search_admin" class="search_admin" placeholder="">
                        <input type="submit" name="sm_s" value="Tìm kiếm" class="search_admin">
                    </form>
                </div>
                <div class="actions">
                    <form method="get" action="{{ URL::to('filter_status_brand') }}" class="form-actions">
                        {{-- @csrf --}}
                        <select name="actions">
                            <option value="">Trạng thái</option>
                            <option value="1">Kích hoạt</option>
                            <option value="0">Không kích hoạt</option>

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
                                <td><span class="thead-text">Tiêu đề</span></td>
                                <td><span class="thead-text"></span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                                <td><span class="thead-text">Người tạo</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_brand_product as $key => $brand)
                                <tr>

                                    <td><span class="tbody-text">{{ $key + 1 }}</span></td>

                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{ $brand->brand_name }}</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="{{ URL::to('update_brand') }}/{{ $brand->id }}" title="Sửa"
                                                    class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a onclick="return confirm('Bạn có muốn xoá thương hiệu {{ $brand->brand_name }}?')"
                                                    href="{{ URL::to('delete_brand') }}/{{ $brand->id }}"
                                                    title="Xóa" class="delete"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">{{ $brand->brand_parent }}</span></td>
                                    {{-- <td><span class="tbody-text">Hoạt động</span></td> --}}
                                    <td><span class="tbody-text">
                                            @if ($brand->brand_status == 0)
                                                <a href="{{ URL::to('unactive_brand_product') }}/{{ $brand->id }}"
                                                    class="unact"><span class="fa fa-thumbs-down fa-thumbs"></span></a>
                                            @else
                                                <a href="{{ URL::to('active_brand_product') }}/{{ $brand->id }}"
                                                    class="act"><span class="fa fa-thumbs-up fa-thumbs"></span></a>
                                            @endif
                                        </span></td>
                                    <td><span class="tbody-text">{{ $brand->brand_by }}</span></td>
                                    <td><span class="tbody-text">{{ $brand->created_at->format('d-m-Y') }}</span></td>
                                </tr>
                            @endforeach


                        </tbody>

                    </table>
                </div>
                @if (isset($_GET['key']))
                    {{ $all_brand_product->appends(['key' => $_GET['key']])->links('/vendor/pagination/bootstrap-4') }}
                @elseif(isset($_GET['actions']))
                    {{ $all_brand_product->appends(['actions' => $_GET['actions']])->links('/vendor/pagination/bootstrap-4') }}
                @else
                    {{ $all_brand_product->links('/vendor/pagination/bootstrap-4') }}
                @endif
            </div>
        </div>
    </div>
@endsection
