<!DOCTYPE html>
<html>

<head>
    <title>Quản lý PTL STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('public/backend/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/css/bootstrap/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/reset.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/backend/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/css/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/css/morris.css') }}" rel="stylesheet" type="text/css" />


</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div class="wp-inner clearfix">
                    @if (Session('role') == 'Admin')
                        <a href="{{ URL::to('admin_index') }}" title="" id="logo" class="fl-left">ADMIN</a>
                    @else
                        <a href="{{ URL::to('list_order') }}" title="" id="logo" class="fl-left">ADMIN</a>
                    @endif

                    <div id="dropdown-user" class="dropdown dropdown-extended fl-right" style="height: 52px">
                        <button class="dropdown-toggle clearfix" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">
                            <div id="thumb-circle" class="fl-left">
                                <img src="{{ asset('public/backend/images/img-admin.png') }}">
                            </div>
                            <h3 id="account" class="fl-right">{{ Session('admin_name') }}</h3>
                        </button>
                        <ul class="dropdown-menu">

                            <li><a href="{{ URL::to('logout_admin') }}" title="Thoát">Thoát</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="main-content-wp" class="add-cat-page">
                <div class="wrap clearfix">
                    <div id="sidebar" class="fl-left">
                        <ul id="sidebar-menu">
                            @if (Session('role') == 'Admin')
                                <li class="nav-item">
                                    <a href="" title="" class="nav-link nav-toggle">
                                        <span class="fa fa-bar-chart icon"></span>
                                        <span class="title">Thống Kê</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item">
                                            <a href="{{ URL::to('statistical') }}" title=""
                                                class="nav-link">Thống kê
                                                doanh số</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="" title="" class="nav-link nav-toggle">
                                        <span class="fa fa-users icon"></span>
                                        <span class="title">Người dùng</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item">
                                            <a href="{{ URL::to('create_account') }}" title=""
                                                class="nav-link">Tạo
                                                tài khoản</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ URL::to('account_users') }}" title=""
                                                class="nav-link">Danh
                                                sách người dùng</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ URL::to('account_admins') }}" title=""
                                                class="nav-link">Danh
                                                sách người dùng quản trị</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ URL::to('account_shipper') }}" title=""
                                                class="nav-link">Danh
                                                sách shipper</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="" title="" class="nav-link nav-toggle">
                                        <span class="fa fa-clipboard icon"></span>
                                        <span class="title">Danh mục</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item">
                                            <a href="{{ URL::to('add_category_product') }}" title=""
                                                class="nav-link">Thêm mới
                                                danh mục</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ URL::to('all_category_product') }}" title=""
                                                class="nav-link">Danh mục sản
                                                phẩm</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="" title="" class="nav-link nav-toggle">
                                        <span class="fa fa-tags icon"></span>
                                        <span class="title">Thương hiệu</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item">
                                            <a href="{{ URL::to('add_brand_product') }}" title=""
                                                class="nav-link">Thêm mới thương
                                                hiệu</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ URL::to('all_brand_product') }}" title=""
                                                class="nav-link">Thương hiệu sản
                                                phẩm</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="" title="" class="nav-link nav-toggle">
                                        <span class="fa fa-product-hunt icon"></span>
                                        <span class="title">Sản phẩm</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item">
                                            <a href="{{ URL::to('add_product') }}" title=""
                                                class="nav-link">Thêm
                                                mới sản phẩm</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ URL::to('all_product') }}" title=""
                                                class="nav-link">Danh
                                                sách sản
                                                phẩm</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ URL::to('all_receipts') }}" title=""
                                                class="nav-link">Danh
                                                sách phiếu nhập</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" title="" class="nav-link nav-toggle">
                                        <i class="fa fa-sliders" aria-hidden="true"></i>
                                        <span class="title">Slider</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item">
                                            <a href="{{ URL::to('add_slider') }}" title=""
                                                class="nav-link">Thêm
                                                mới</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ URL::to('manager_slider') }}" title=""
                                                class="nav-link">Danh sách slider</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" title="" class="nav-link nav-toggle">
                                        <i class="fa fa-truck" aria-hidden="true"></i>
                                        <span class="title">Tính phí vận chuyển</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item">
                                            <a href="{{ URL::to('add_fee_ship') }}" title=""
                                                class="nav-link">Thêm
                                                mới phí vận chuyển</a>
                                        </li>

                                    </ul>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="" title="" class="nav-link nav-toggle">
                                    <span class="fa fa-commenting icon"></span>
                                    <span class="title">Bình luần sản phẩm</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="{{ URL::to('list_comment') }}" title="" class="nav-link">Danh
                                            sách bình luận</a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="" title="" class="nav-link nav-toggle">
                                    <span class="fa fa-database icon"></span>
                                    <span class="title">Bán hàng</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="{{ URL::to('list_order') }}" title="" class="nav-link">Danh
                                            sách đơn hàng</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ URL::to('list_customer_order') }}" title=""
                                            class="nav-link">Danh sách khách hàng</a>
                                    </li>
                                </ul>
                            </li>




                        </ul>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/backend/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/backend/js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/backend/js/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/backend/js/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/backend/js/jquery-ui.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/backend/js/morris.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/backend/js/raphael-min.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            load_gallery();

            function load_gallery() {
                var product_id = $('#product_id').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    method: "POST",
                    url: "{{ URL::to('load_gallery') }}",
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#gallery').html(data);
                    }
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            load_fee();
            $('.choose').change(function() {
                var id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                $.ajax({

                    method: "POST",
                    url: "{{ URL::to('select_delivery') }}",
                    data: {
                        id: id,
                        _token: _token
                    },

                    success: function(data) {
                        $('#wards').html(data);
                        load_fee();
                    }
                });
            })

            $('.add_fee').click(function() {
                var district = $('.district').val();
                var ward = $('.wards').val();
                var fee = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    method: "POST",
                    url: "{{ URL::to('save_fee_ship') }}",
                    data: {
                        district: district,
                        ward: ward,
                        fee: fee,
                        _token: _token
                    },

                    success: function(data) {
                        $('#success').html(data);
                        load_fee();
                    }
                });
            })

            function load_fee() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    method: "POST",
                    url: "{{ URL::to('load_fee') }}",
                    data: {
                        _token: _token
                    },

                    success: function(data) {
                        $('#load_fee').html(data);
                    }
                });
            }

            $(document).on('blur', '.fee_edit', function() {
                var fee_ship_id = $(this).data('fee_ship_id');
                var fee_ship = $(this).text();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    method: "POST",
                    url: "{{ URL::to('update_fee') }}",
                    data: {
                        fee_ship_id: fee_ship_id,
                        fee_ship: fee_ship,
                        _token: _token
                    },

                    success: function(data) {
                        load_fee();
                    }
                });
            })

        });
    </script>

    <script>
        $(document).ready(function() {
            filter_30_day_auto();
            var chart = new Morris.Bar({

                element: 'myfirstchart',
                hideHover: 'auto',
                parseTime: false,

                xkey: 'period',
                ykeys: ['order', 'sales', 'profit', 'quantity'],

                labels: ['Đơn hàng', 'Doanh số', 'Lợi nhuận', 'Số lượng']
            });

            var chart2 = new Morris.Bar({

                element: 'mysecondchart',
                hideHover: 'auto',
                parseTime: false,

                xkey: 'id',

                ykeys: ['qty_bill', 'qty'],

                labels: ['Số lượng đơn mua', 'số lượng bán'],


            });

            $('#from').datepicker({
                prevText: "Tháng Trước",
                nextText: "Thánh Sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7",
                    "Tháng 8",
                    "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
                ],

            });
            $('#to').datepicker({
                prevText: "Tháng Trước",
                nextText: "Thánh Sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ Nhật"],
                monthNames: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7",
                    "Tháng 8",
                    "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"
                ],

            });

            $('#btn-submit').click(function() {
                var from_date = $('#from').val();
                var to_date = $('#to').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    type: "method",
                    method: "POST",
                    url: "{{ URL::to('filter_day') }}",
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        _token: _token
                    },
                    dataType: "json",
                    success: function(data) {
                        chart.setData(data);
                    }
                });
            });

            $('.filter_statistic').change(function() {
                var filter_val = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    type: "method",
                    method: "POST",
                    url: "{{ URL::to('filter_statistic') }}",
                    data: {

                        filter_val: filter_val,
                        _token: _token
                    },
                    dataType: "json",
                    success: function(data) {
                        chart.setData(data['0']);
                        chart2.setData(data['1']);
                    }
                });

            })

            function filter_30_day_auto() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    type: "method",
                    method: "POST",
                    url: "{{ URL::to('filter_30_day_auto') }}",
                    data: {
                        _token: _token
                    },
                    dataType: "json",
                    success: function(data) {
                        chart.setData(data['0']);
                        chart2.setData(data['1']);
                    }
                });
            }
        })
    </script>


</body>

</html>
