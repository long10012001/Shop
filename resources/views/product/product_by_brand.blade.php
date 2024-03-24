@extends('welcome')
@section('content')
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">

                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">{{ $name_brand->brand_name }}</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            @foreach ($get_product_by_brand as $product)
                                <li>
                                    <form action="{{ URL::to('save_cart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="qty" value="1" id="num-order">
                                        <a href="{{ URL::to('detail_product') }}/{{ $product->id }}" title=""
                                            class="thumb">
                                            <img
                                                src="{{ URL::to('public/uploads/product') }}/{{ $product->product_image }}">
                                        </a>
                                        <a href="{{ URL::to('detail_product') }}/{{ $product->id }}" title=""
                                            class="product-name">{{ $product->product_name }}</a>
                                        <div class="price">
                                            <span class="new">{{ number_format($product->product_price) }}đ</span>
                                            {{-- <span class="old">8.990.000đđ</span> --}}
                                        </div>
                                        <div class="action clearfix">
                                            <input type="submit" title="Thêm giỏ hàng" class="add-cart"
                                                value="Thêm giỏ hàng">

                                    </form>
                                    <form action="{{ URL::to('save_cart_and_checkout') }}" method="POST"
                                        class="save_cart_and_checkout">
                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="qty" value="1" id="num-order">
                                        <input type="submit" title="Thêm giỏ hàng" class="buy-now fl-right add-cart"
                                            value="Mua ngay">
                                    </form>
                    </div>
                    </li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">

            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        @foreach ($category_product as $cate)
                            <li>
                                <a href="{{ URL::to('category_product') }}/{{ $cate->id }}"
                                    title="">{{ $cate->category_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Thương hiệu</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        @foreach ($brand_product as $brand)
                            <li>
                                <a href="{{ URL::to('brand_product') }}/{{ $brand->id }}"
                                    title="">{{ $brand->brand_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>


        </div>
    </div>
    </div>
@endsection
