@extends('admin.layout.layout')
@section('content')

        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới danh mục sản phẩm</h3>
                </div>
            </div>
            <span class="text-success" id="success">{{ Session('message') }}</span>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="{{URL::to('save_category_product')}}">
                        @csrf
                        <label for="title">Tên danh mục</label>
                        <input type="text" name="title_category" id="title">
                        {{-- <label for="title">Slug ( Friendly_url )</label> --}}
                        {{-- <input type="text" name="slug" id="slug"> --}}
                        <label for="desc">Mô tả</label>
                        <textarea name="desc_category" id="desc" class="ckeditor"></textarea>

                        <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>

@endsection