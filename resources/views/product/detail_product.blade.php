@extends('welcome')
@section('content')
    <div id="main-content-wp" class="clearfix detail-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="{{ URL::to('trang-chu') }}" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">{{ $one_product->category->category_name }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="" title="" id="main-thumb">
                                <img id="zoom"
                                    src="{{ URL::to('public/uploads/product') }}/{{ $one_product->product_image }}" />
                            </a>
                            <div id="list-thumb">
                                @foreach ($gallery_product as $item)
                                <a href=""
                                    data-image="{{ URL::to('public/uploads/gallery') }}/{{$item->gallery_images}}"
                                    data-zoom-image="{{ URL::to('public/uploads/gallery') }}/{{$item->gallery_images}}">
                                    <img id="zoom"
                                        src="{{ URL::to('public/uploads/gallery') }}/{{$item->gallery_images}}" />
                                </a>
                               @endforeach
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="{{ URL::to('public/frontend/images/img-pro-01.png') }}" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name">{{ $one_product->product_name }}</h3>
                            <div class="desc">
                                {!!$one_product->product_desc!!}
                            </div>
                            <div class="num-product">
                                <p class="title">Số lượng: {{ $one_product->product_qty }}</p>
                                @if ($one_product->product_qty == 0)
                                    <p class="status">Hết hàng</p>
                                @else
                                    <p class="status">Còn hàng</p>
                                @endif

                            </div>
                            <p class="price">{{ number_format($one_product->product_price) }}đ</p>
                            <form action="{{ URL::to('save_cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $one_product->id }}">
                                <div id="num-order-wp">
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="qty" value="1"
                                        max="{{ $one_product->product_qty }}" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                </div>
                                {{-- <a href="?page=cart" type="" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a> --}}
                                <input type="submit" title="Thêm giỏ hàng" class="add-cart" value="Thêm giỏ hàng">
                            </form>

                        </div>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        {!!$one_product->product_content !!}
                    </div>
                </div>

                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Đánh giá sản phẩm</h3>
                    </div>
                    <div class="rating_div mb-3">
                        <ul class="list-inline" >
                            @for ($i = 1; $i <= 5; $i++)
                                @php
                                    if ($i <= $rating) {
                                        $color = 'color:#ffcc00;';
                                    } else {
                                        $color = 'color:#ccc;';
                                    }
                                @endphp
                                <li class="rating list-inline-item" style="{{ $color }}" 
                                    id="{{ $one_product->id }}-{{ $i }}" data-index="{{ $i }}"
                                    data-product_id="{{ $one_product->id }}" data-rating="{{ $rating }} ">&#9733;
                                </li>
                            @endfor

                        </ul>
                        <span id="success_rating" class="text-success m-0"></span>
                    </div>
                    <div class="section-detail">

                        <input type="hidden" class="comment_product_id" name="comment_product_id"
                            value="{{ $one_product->id }}">
                        <div id="show_comment"></div>
                        <hr>
                        @if (Session('user_name') && $result != 0)
                            <form action="" class="ml-4">
                                <div class="row">
                                    @csrf
                                    <input type="hidden" class="comment_product_id" name="comment_product_id"
                                        value="{{ $one_product->id }}">
                                    <input type="hidden" class="user_comment" name="user_comment"
                                        value="{{ Session('user_name') }}">
                                    <div class="col-10"><input type="text" class="w-100 form-control rounded-0"
                                            name="content_comment" id="content_comment"></div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-danger rounded-0" id="send-comment">Đánh
                                            giá</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>


                <div class="section" id="same-category-wp">
                    <div class="section-head">
                        <h3 class="section-title">Cùng chuyên mục</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">

                            @foreach ($relate_product as $product)
                                <li>
                                    <a href="{{ URL::to('detail_product') }}/{{ $product->id }}" title=""
                                        class="thumb">
                                        <img src="{{ URL::to('public/uploads/product') }}/{{ $product->product_image }}">
                                    </a>
                                    <a href="{{ URL::to('detail_product') }}/{{ $product->id }}" title=""
                                        class="product-name">{{ $product->product_name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($product->product_price) }}đ</span>
                                        {{-- <span class="old">8.990.000đđ</span> --}}
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ
                                            hàng</a>
                                        <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sidebar fl-left">
                <div class="section" id="category-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Danh mục sản phẩm</h3>
                    </div>
                    <div class="secion-detail">
                        <ul class="list-item">
                            <ul class="list-item">
                                @foreach ($category_product as $cate)
                                    <li>
                                        <a href="{{ URL::to('category_product') }}/{{ $cate->id }}"
                                            title="">{{ $cate->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
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
