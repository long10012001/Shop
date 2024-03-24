<!DOCTYPE html>
<html>

<head>
    <title>PTL STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ URL::to('public/frontend/css/bootstrap/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('public/frontend/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('public/frontend/reset.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('public/frontend/css/carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('public/frontend/css/carousel/owl.theme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('public/frontend/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::to('public/frontend/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('public/frontend/responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('public/frontend/css/bootstrap/sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ URL::to('public/frontend/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('public/frontend/js/elevatezoom-master/jquery.elevatezoom.js') }}" type="text/javascript">
    </script>
    <script src="{{ URL::to('public/frontend/js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('public/frontend/js/carousel/owl.carousel.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('public/frontend/js/main.js') }}" type="text/javascript"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">

                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="{{ URL::to('trang-chu') }}" title="" id="logo" class="fl-left"><img
                                src="{{ URL::to('public/frontend/images/Tl__1_-removebg-preview (2).png') }}" /></a>
                        <div id="search-wp" class="fl-left">

                            <form method="get" action="{{ URL::to('search') }}">
                                <input type="text" name="key" id="s"
                                    placeholder="Nhập từ khóa tìm kiếm tại đây!">

                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>
                            @if (Session('message_search'))
                                <p class="text-light">{{ Session('message_search') }}</p>
                            @endif

                        </div>
                        <div id="action-wp" class="fl-right">
                            @if (Session('user_name'))
                                <div id="advisory-wp" class="fl-left">
                                    <span class="phone">Xin chào,</span>
                                    <span class="title">{{ Session('user_name') }}</span>
                                </div>
                            @endif
                            <a href="?page=cart" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>

                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num">{{ Cart::content()->count() }}</span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">Có <span>{{ Cart::content()->count() }} sản phẩm</span> trong giỏ
                                        hàng</p>
                                    <ul class="list-cart">
                                        @foreach (Cart::content() as $product)
                                            <li class="clearfix">
                                                <a href="" title="" class="thumb fl-left">
                                                    <img src="{{ URL::to('public/uploads/product') }}/{{ $product->options->image }}"
                                                        alt="">
                                                </a>
                                                <div class="info fl-right">
                                                    <a href="" title=""
                                                        class="product-name">{{ $product->name }}</a>
                                                    <p class="price">
                                                        {{ number_format($product->price * $product->qty) }}đ</p>
                                                    <p class="qty">Số lượng: <span>{{ $product->qty }}</span></p>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p>
                                        <p class="price fl-right">{{ Cart::subtotal(0) }}đ</p>
                                    </div>
                                    <div class="action-cart clearfix">
                                        <a href="{{ URL::to('show_cart') }}" title="Giỏ hàng"
                                            class="view-cart fl-left">Giỏ hàng</a>
                                        @if (Cart::content()->count() > 0)
                                            <a href="{{ URL::to('checkout') }}" title="Thanh toán"
                                                class="checkout fl-right">Thanh
                                                toán</a>
                                        @else
                                            <a disabled href="" title="Thanh toán"
                                                class="checkout fl-right">Thanh
                                                toán</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i> --}}
                            {{-- </div> --}}

                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <i class="fa fa-user" aria-hidden="true"></i>

                                </div>
                                <div id="dropdown" class="dro_user">
                                    <ul class="user">
                                        @if (Session('user_name'))
                                            <a href="{{ URL::to('info_customer') }}/{{ Session('user_id') }}">
                                                <li class="clearfix">Thông tin tài khoản</li>
                                            </a>
                                            <a href="{{ URL::to('my_list_order') }}/{{ Session('user_id') }}">
                                                <li class="clearfix">Lịch sử mua hàng</li>
                                            </a>
                                            <a href="{{ URL::to('logout') }}">
                                                <li class="clearfix">Thoát</li>
                                            </a>
                                        @else
                                            <a href="{{ URL::to('login_customer') }}">
                                                <li class="clearfix">Đăng Nhập</li>
                                            </a>
                                            <a href="{{ URL::to('regist') }}">
                                                <li class="clearfix">Đăng Ký</li>
                                            </a>
                                        @endif

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
            <div id="footer-wp">
                <div id="foot-body">
                    <div class="wp-inner clearfix">
                        <div class="block" id="info-company">
                            <img src="{{ URL::to('public/frontend/images/Tl__1_-removebg-preview (2).png') }}"
                                class="bg-danger" alt="">
                            <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng,
                                chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                            <div id="payment">
                                <div class="thumb">
                                    <img src="{{ URL::to('public/frontend/images/img-foot.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="block menu-ft" id="info-shop">
                            <h3 class="title">Thông tin cửa hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <p>abc - Cần Thơ</p>
                                </li>
                                <li>
                                    <p>0763946978</p>
                                </li>
                                <li>
                                    <p>longb1910250@student.ctu.edu.vn</p>
                                </li>
                            </ul>
                        </div>
                        <div class="block menu-ft policy" id="info-shop">
                            <h3 class="title">Chính sách mua hàng</h3>
                            <ul class="list-item">
                                <li>
                                    <a href="" title="">Quy định - chính sách</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách bảo hành - đổi trả</a>
                                </li>
                                <li>
                                    <a href="" title="">Chính sách hội viện</a>
                                </li>
                                <li>
                                    <a href="" title="">Giao hàng - lắp đặt</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block" id="newfeed">
                            <h3 class="title">Bảng tin</h3>
                            <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                            <div id="form-reg">
                                <form method="POST" action="">
                                    <input type="email" name="email" id="email"
                                        placeholder="Nhập email tại đây">
                                    <button type="submit" id="sm-reg">Đăng ký</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="menu-respon">
            <a href="?page=home" title="" class="logo">VSHOP</a>
            <div id="menu-respon-wp">
                <ul class="" id="main-menu-respon">
                    <li>
                        <a href="?page=home" title>Trang chủ</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Điện thoại</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?page=category_product" title="">Iphone</a>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Samsung</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=category_product" title="">Iphone X</a>
                                    </li>
                                    <li>
                                        <a href="?page=category_product" title="">Iphone 8</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Nokia</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Máy tính bảng</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Laptop</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title>Đồ dùng sinh hoạt</a>
                    </li>
                    <li>
                        <a href="?page=blog" title>Blog</a>
                    </li>
                    <li>
                        <a href="#" title>Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="btn-top"><img src="{{ URL::to('public/frontend/images/icon-to-top.png') }}" alt="" />
        </div>
        <div id="fb-root"></div>
        {{-- <script src="https://www.paypalobjects.com/api/checkout.js"></script> --}}
        <script src="{{ URL::to('public/frontend/js/checkout.js') }}"></script>

        {{-- <script>
            var vnd = $('#for_paypal').val();
            var usd = Math.round((vnd / 24185)*100)/100;
            
            paypal.Button.render({
                // Configure environment
                env: 'sandbox',
                client: {
                    sandbox: 'AbwbAQ_a77QbO4p6xjSyc5Khf2jw8GT7VRmkzW51StD5JDpo4wgH5snyDvqthFQXlxUUDjWgUMHX23yH',
                    production: 'demo_production_client_id'
                },
                // Customize button (optional)
                locale: 'en_US',
                style: {
                    size: 'small',
                    color: 'gold',
                    shape: 'pill',
                },

                // Enable Pay Now checkout flow (optional)
                commit: true,

                // Set up a payment
                payment: function(data, actions) {
                    return actions.payment.create({
                        transactions: [{
                            amount: {
                                total: `${usd}`,
                                currency: 'USD'
                            }
                        }]
                    });
                },
                // Execute the payment
                onAuthorize: function(data, actions) {
                    return actions.payment.execute().then(function() {
                        // Show a confirmation message to the buyer
                        window.alert('Thank you for your purchase!');
                    });
                }
            }, '#paypal-button');
        </script> --}}



        <script src="{{ URL::to('public/frontend/js/sweetalert.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                load_comment();

                function load_comment() {
                    var product_id = $('.comment_product_id').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        method: "POST",
                        url: '{{ url('/load_comment') }}',
                        data: {
                            product_id: product_id,
                            _token: _token
                        },
                        success: function(data) {
                            $('#show_comment').html(data);
                        }
                    });
                }


                $('#send-comment').click(function() {
                    var product_id = $(".comment_product_id").val();
                    var content_comment = $("#content_comment").val();
                    var user_comment = $(".user_comment").val();

                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                        method: "POST",
                        url: '{{ url('/send_comment') }}',
                        data: {
                            product_id: product_id,
                            content_comment: content_comment,
                            user_comment: user_comment,
                            _token: _token
                        },
                        success: function(data) {
                            load_comment();
                            $("#content_comment").val('');
                        }
                    });
                });
            });
        </script>
        <script>
            function remove_background(product_id) {
                for (var i = 1; i <= 5; i++) {
                    $('#' + product_id + '-' + i).css('color', '#ccc');
                }
            }

            $(document).on('mouseenter', '.rating', function() {
                var index = $(this).data("index");
                var product_id = $(this).data("product_id");
                remove_background(product_id);

                for (var i = 1; i <= index; i++) {
                    $('#' + product_id + '-' + i).css('color', '#ffcc00');
                }
            });

            $(document).on('mouseleave', '.rating', function() {
                var index = $(this).data("index");
                var product_id = $(this).data("product_id");
                var rating = $(this).data("rating");
                remove_background(product_id);

                for (var i = 1; i <= rating; i++) {
                    $('#' + product_id + '-' + i).css('color', '#ffcc00');
                }
            });


            $(document).on('click', '.rating', function() {
                var index = $(this).data("index");
                var product_id = $(this).data("product_id");
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    method: "POST",
                    url: "{{ url('/add_rating') }}",
                    data: {
                        index: index,
                        product_id: product_id,
                        _token: _token
                    },

                    success: function(data) {
                        $('#success_rating').html(data);
                    }
                });
            })
        </script>
        <script>
            $(document).ready(function() {
                $('.choose').change(function() {
                    var id = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    var result = '';
                    $.ajax({

                        method: "POST",
                        url: "{{ URL::to('select_address') }}",
                        data: {
                            id: id,
                            _token: _token
                        },

                        success: function(data) {
                            $('#wards').html(data);

                        }
                    });
                });
            })
        </script>
        <script>
            $(document).ready(function() {

                $('.wards').change(function() {
                    var district = $('.district').val();
                    var ward = $('.wards').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        method: "POST",
                        url: "{{ URL::to('add_fee') }}",
                        data: {
                            district: district,
                            ward: ward,
                            _token: _token
                        },
                        dataType: "json",
                        success: function(data) {
                            $('#fee_ship').html(data.fee_ship);
                            $('#total').html(data.total_ship);
                            $('#paypal').attr("href", data.href);

                        }

                    });
                });


            })
        </script>
</body>

</html>
