@extends('admin.layout.layout')
@section('content')
<div id="content" class="fl-right">
    <div class="section" id="title-page">
        <div class="clearfix">
            <h3 id="index" class="fl-left">Thêm mới thương hiệu sản phẩm</h3>
        </div>
    </div>
    <span class="text-success" id="success">{{ Session('message') }}</span>
    <div class="section" id="detail-page">
        <div class="section-detail">
            <form method="POST" action="{{URL::to('save_brand_product')}}">
                @csrf
                <label for="title">Tên thương hiệu</label>
                <input type="text" name="title_brand" id="title">
                {{-- <label for="title">Slug ( Friendly_url )</label> --}}
                {{-- <input type="text" name="slug" id="slug"> --}}
                <label for="desc">Mô tả</label>
                <textarea name="desc_brand" id="desc" class="ckeditor"></textarea>

                <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection