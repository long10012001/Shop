@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Cập nhật slider</h3>
            </div>
        </div>
        <span class="text-success" id="success">{{ Session('message') }}</span>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <form method="POST" action="{{ URL::to('save_update_slider') }}/{{$slider->id}}" enctype="multipart/form-data">
                    @csrf
                    <label for="slider_name">Tên slider</label>
                    <input type="text" name="slider_name" id="slider_name" value="{{$slider->slider_name}}">
                    <label for="slider_desc">Mô tả slider</label>
                    <textarea name="slider_desc" id="desc" class="ckeditor">{{$slider->slider_desc}}</textarea>
                    <label>Hình ảnh</label>
                    <div id="uploadFile">
                        <input type="file" name="slider_image" id="upload-thumb">
                    </div>
                    <label>Trạng thái</label>
                    <select name="slider_status">
                        <option @if ($slider->slider_status == 0)
                            {{ $selected ='selected'}}
                        @endif value="0">Ẩn</option>
                        <option @if ($slider->slider_status == 1)
                            {{ $selected ='selected'}}
                        @endif value="1">Hiện</option>
                    </select>
                    <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
