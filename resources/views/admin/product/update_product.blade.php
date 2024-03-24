@extends('admin.layout.layout')
@section('content')
    <div id="content" class="fl-right">
        <div class="section" id="title-page">
            <div class="clearfix">
                <h3 id="index" class="fl-left">Cập nhật sản phẩm</h3>
            </div>
        </div>
        <span class="text-success" id="success">{{ Session('message') }}</span>
        <div class="section" id="detail-page">
            <div class="section-detail">
                <form method="POST" action="{{ URL::to('update_product') }}/{{ $edit_product->id }}"
                    enctype="multipart/form-data">
                    @csrf
                    <label for="product-name">Tên sản phẩm</label>
                    <input type="text" name="product_name" id="product-name" value="{{ $edit_product->product_name }}">
                    <label for="product-code">Mô tả</label>
                    <textarea name="product_desc" id="desc" class="ckeditor">{{ $edit_product->product_desc }}</textarea>

                    {{-- <input type="text" name="product_desc" id="product-code" value="{{ $edit_product->product_desc }}"> --}}
                    <label for="price">Giá sản phẩm bán ra</label>
                    <input type="text" name="product_price" id="price" value="{{ $edit_product->product_price }}">
                    {{-- <label for="product_qty">Số lượng sản phẩm</label>
                            <input type="text" name="product_qty" id="product_qty" value="{{ $edit_product->product_qty }}"> --}}
                    <label for="desc">Nội dung</label>
                    <textarea name="product_content" id="desc" class="ckeditor">{{ $edit_product->product_content }}</textarea>
                    <label>Hình ảnh</label>
                    <div id="uploadFile">
                        <input type="file" name="product_image" id="upload-thumb">
                    </div>
                    <label>Danh mục sản phẩm</label>
                    <select name="category_product">
                        @foreach ($cate_product as $cate)
                            @if ($cate->id === $edit_product->category_id)
                                <option selected value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                            @else
                                <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <label>Thương hiệu</label>
                    <select name="brand_product">
                        @foreach ($brand_product as $brand)
                            @if ($brand->id == $edit_product->brand_id)
                                <option selected="selected" value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @else
                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <button type="submit" name="btn-submit" id="btn-submit">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
