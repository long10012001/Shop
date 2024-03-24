@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Thêm slider</h3>
            </div>
        </div>
        <span class="text-success" id="success">{{ Session('message') }}</span>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <form method="POST" action="{{ URL::to('save_slider') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="slider_name">Tên slider</label>
                    <input type="text" name="slider_name" id="slider_name">
                    <label for="slider_desc">Mô tả slider</label>
                    <textarea name="slider_desc" id="desc" class="ckeditor"></textarea>
                    <label>Hình ảnh</label>
                    <div id="uploadFile">
                        <input type="file" name="slider_image" id="upload-thumb">
                    </div>
                    <label>Trạng thái</label>
                    <select name="slider_status">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiện</option>
                    </select>
                    <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
