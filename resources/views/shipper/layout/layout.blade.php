<!DOCTYPE html>
<html>

<head>
    <title>Quản lý vận chuyển PTL STORE</title>
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
    <link rel="icon" href="{{ URL::to('favicon1.ico') }}">


</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div class="wp-inner clearfix">
                    <a href="{{ URL::to('shipper_index') }}" title="" id="logo" class="fl-left">SHIPPER</a>

                    <div id="dropdown-user" class="dropdown dropdown-extended fl-right" style="height: 52px">
                        <button class="dropdown-toggle clearfix" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">
                            <div id="thumb-circle" class="fl-left">
                                <img src="{{ asset('public/backend/images/img-admin.png') }}">
                            </div>
                            <h3 id="account" class="fl-right">{{ Session('shipper_name') }}</h3>
                        </button>
                        <ul class="dropdown-menu">

                            <li><a href="{{ URL::to('logout_shipper') }}" title="Thoát">Thoát</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="main-content-wp" class="add-cat-page">
                <div class="wrap clearfix">
                    <div id="sidebar" class="fl-left">
                        <ul id="sidebar-menu">
                            <li class="nav-item">
                                <a href="" title="" class="nav-link nav-toggle">
                                    <span class="fa fa-bar-chart icon"></span>
                                    <span class="title">Đơn hàng cần vận chuyển</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="{{ URL::to('shipper_index') }}" title="" class="nav-link">Danh
                                            sách đơn đã nhận</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ URL::to('list_orders_remain') }}" title=""
                                            class="nav-link">Danh
                                            sách đơn trên hệ thống</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="" title="" class="nav-link nav-toggle">
                                    <span class="fa fa-users icon"></span>
                                    <span class="title">Đơn vận chuyển thành công</span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item">
                                        <a href="{{ URL::to('list_orders_success') }}" title=""
                                            class="nav-link">Đơn vận chuyển thành công</a>
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







</body>

</html>
