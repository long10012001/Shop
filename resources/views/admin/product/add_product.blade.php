@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
            </div>
        </div>
        <span class="text-success" id="success">{{ Session('message') }}</span>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <form method="POST" action="{{ URL::to('save_product') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="product-name">Tên sản phẩm</label>
                    <input type="text" name="product_name" id="product-name">
                    <label for="product-code">Mô tả</label>
                    <textarea name="product_desc" id="desc" class="ckeditor"></textarea>

                    <label for="price">Giá sản phẩm</label>
                    <input type="text" name="product_price" id="price">
                    <label for="product_qty">Số lượng sản phẩm</label>
                    <input type="text" name="product_qty" id="product_qty">
                    <label for="desc">Nội dung</label>
                    <textarea name="product_content" id="desc" class="ckeditor"></textarea>
                    <label>Hình ảnh</label>
                    <div id="uploadFile">
                        <input type="file" name="product_image" id="upload-thumb">
                    </div>
                    <label>Danh mục sản phẩm</label>
                    <select name="category_product">
                        @foreach ($cate_product as $cate)
                            <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                        @endforeach
                    </select>
                    <label>Thương hiệu</label>
                    <select name="brand_product">
                        @foreach ($brand_product as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" name="btn-submit" id="btn-submit">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
