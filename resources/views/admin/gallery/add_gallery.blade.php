@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Thêm ảnh liên quan của sản phẩm</h3>
            </div>
        </div>
        <span>{{ Session('message') }}</span>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <form method="POST" action="{{ URL::to('insert_gallery') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id" class="product_id" value="{{ $product_id }}">
                    <label>Hình ảnh</label>
                    <div id="uploadFile">
                        <input type="file" name="file[]" id="gallery_img" accept="image/*" multiple>
                    </div>
                    <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                </form>
            </div>
            <div id="gallery">

            </div>

        </div>
    </div>
@endsection
