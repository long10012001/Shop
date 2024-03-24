@extends('welcome')
@section('content')
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">
                <div class="section" id="slider-wp">
                    <div class="section-detail">
                        @foreach ($list_slider as $slider)
                            <div class="item">
                                <img src="{{ URL::to('public/uploads/slider') }}/{{ $slider->slider_images }}"
                                    alt="{!! $slider->slider_desc !!}">
                            </div>
                        @endforeach


                    </div>
                </div>
                <div class="section" id="support-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li>
                                <div class="thumb">
                                    <img src="public/frontend/images/icon-1.png">
                                </div>
                                <h3 class="title">Miễn phí vận chuyển</h3>
                                <p class="desc">Tới tận tay khách hàng</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="public/frontend/images/icon-2.png">
                                </div>
                                <h3 class="title">Tư vấn 24/7</h3>
                                <p class="desc">1900.9999</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="public/frontend/images/icon-3.png">
                                </div>
                                <h3 class="title">Tiết kiệm hơn</h3>
                                <p class="desc">Với nhiều ưu đãi cực lớn</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="public/frontend/images/icon-4.png">
                                </div>
                                <h3 class="title">Thanh toán nhanh</h3>
                                <p class="desc">Hỗ trợ nhiều hình thức</p>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="public/frontend/images/icon-5.png">
                                </div>
                                <h3 class="title">Đặt hàng online</h3>
                                <p class="desc">Thao tác đơn giản</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="section" id="feature-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm mới</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($all_product as $product)
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
                                            {{-- <span class="old">6.190.000đ</span> --}}
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
                <div class="section-head">
                    <h3 class="section-title">sản phẩm</h3>
                    <div class="actions row fl-right mt-5">
                        <form method="get" action="{{ URL::to('filter_home') }}" class="form-actions">

                            <select name="actions">
                                <option value="0">- - - Sắp xếp theo - - - </option>
                                <option value="1">Giá (Cao-Thấp)</option>
                                <option value="2">Giá (Thấp-Cao)</option>
                                <option value="3">Tên (A-Z)</option>
                                <option value="4">Tên (Z-A)</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                        </form>
                    </div>

                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($all_product_2 as $product)
                            <li>
                                <form action="{{ URL::to('save_cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="qty" value="1" id="num-order">
                                    <a href="{{ URL::to('detail_product') }}/{{ $product->id }}" title=""
                                        class="thumb">
                                        <img src="{{ URL::to('public/uploads/product') }}/{{ $product->product_image }}">
                                    </a>
                                    <a href="{{ URL::to('detail_product') }}/{{ $product->id }}" title=""
                                        class="product-name">{{ $product->product_name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($product->product_price) }}đ</span>
                                        {{-- <span class="old">6.190.000đ</span> --}}
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
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if (isset($_GET['actions']))
                    {{ $all_product_2->appends(['actions' => $_GET['actions']])->links('vendor/pagination/bootstrap-4') }}
                @else
                    {{ $all_product_2->links('vendor/pagination/bootstrap-4') }}
                @endif
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
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($pro as $item)
                            <li class="clearfix">
                                <a href="?page=detail_product" title="" class="thumb fl-left">
                                    <img src="{{ URL::to('public/uploads/product') }}/{{ $item->product_image }}"
                                        alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title=""
                                        class="product-name">{{ $item->product_name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($item->product_price) }}đ</span>
                                    </div>
                                    <form action="{{ URL::to('save_cart_and_checkout') }}" method="POST"
                                        class="save_cart_and_checkout">
                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <input type="hidden" name="qty" value="1" id="num-order">
                                        <input type="submit" title="Thêm giỏ hàng" class="buy-now" value="Mua ngay">
                                    </form>
                                    {{-- <a href="" title="" class="buy-now">Mua ngay</a> --}}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
