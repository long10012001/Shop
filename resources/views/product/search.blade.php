@extends('welcome')
@section('content')
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">
                
                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Kết quả</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            @foreach ($search_product as $product)
                            <li>
                                <a href="{{URL::to('detail_product')}}/{{$product->id}}" title="" class="thumb">
                                    <img src="{{URL::to('public/uploads/product')}}/{{$product->product_image}}">
                                </a>
                                <a href="{{URL::to('detail_product')}}/{{$product->id}}" title="" class="product-name">{{$product->product_name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($product->product_price)}}đ</span>
                                    {{-- <span class="old">8.990.000đđ</span> --}}
                                </div>
                                <div class="action clearfix">
                                    <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @if (isset($_GET['key']))
                    {{$search_product->appends(['key' => $_GET['key']])->links('vendor/pagination/bootstrap-4')}}
                        
                    {{-- @else
                    {{$search_product->links('vendor/pagination/bootstrap-4')}} --}}
                    @endif
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
                                    <a href="{{URL::to('category_product')}}/{{$cate->id}}" title="">{{$cate->category_name}}</a>
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
                                    <a href="{{URL::to('brand_product')}}/{{$brand->id}}" title="">{{$brand->brand_name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
