@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Danh sách slider</h3>
                <a href="{{ URL::to('add_slider') }}" title="" id="add-new" class="fl-left">Thêm mới</a>
            </div>
            <span class="text-success" id="success">{{ Session('message') }}</span>


        </div>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <div class="filter-wp clearfix">
                    <ul class="post-status fl-left">
                        <li class="all"><a href="">Tất cả <span class="count">({{ $count }})</span></a>
                        </li>
                    </ul>
                    <form method="post" action="{{ URL::to('search_slider') }}" class="form-s fl-right">
                        @csrf
                        <input type="text" name="key" id="search_admin" class="search_admin" placeholder="">
                        <input type="submit" name="sm_s" value="Tìm kiếm" class="search_admin">
                    </form>
                </div>
                <div class="actions">
                    <form method="post" action="{{ URL::to('filter_status_slider') }}" class="form-actions">
                        @csrf
                        <select name="actions">
                            <option value="">Trạng thái</option>
                            <option value="1">Kích hoạt</option>
                            <option value="0">Không kích hoạt</option>
                        </select>
                        <input type="submit" name="sm_action" value="Áp dụng">
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table list-table-wp">
                        <thead>
                            <tr>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Tên slider</span></td>
                                <td><span class="thead-text">Hình ảnh</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                                <td><span class="thead-text">Người tạo</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_slider as $key => $slider)
                                <tr>

                                    <td><span class="tbody-text">{{ $key + 1 }}</span></td>

                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">{{ $slider->slider_name }}</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="{{ URL::to('update_slider') }}/{{ $slider->id }}" title="Sửa"
                                                    class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a onclick="return confirm('Bạn có muốn xoá slider của {{ $slider->slider_name }}?')"
                                                    href="{{ URL::to('delete_slider') }}/{{ $slider->id }}"
                                                    title="Xóa" class="delete"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>

                                    <td class="thumb_slider">
                                        <div class="tbody-thumb">
                                            <img src="public/uploads/slider/{{ $slider->slider_images }}" alt="">
                                        </div>
                                    </td>
                                    <td><span class="tbody-text">
                                            @if ($slider->slider_status == 0)
                                                <a href="{{ URL::to('unactive_slider') }}/{{ $slider->id }}"
                                                    class="unact"><span class="fa fa-thumbs-down fa-thumbs"></span></a>
                                            @else
                                                <a href="{{ URL::to('active_slider') }}/{{ $slider->id }}"
                                                    class="act"><span class="fa fa-thumbs-up fa-thumbs"></span></a>
                                            @endif
                                        </span></td>
                                    <td><span class="tbody-text">{{ $slider->slider_by }}</span></td>
                                    <td><span class="tbody-text">{{ $slider->created_at->format('d-m-Y') }}</span></td>
                                </tr>
                            @endforeach


                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
