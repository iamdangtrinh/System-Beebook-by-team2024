<!DOCTYPE html>
<html>

<?php
$routeName = basename(route('order.index'));
$currentSegment = Request::segment(2);

$routeName = basename(route('order.index')); // Lấy tên route của 'order.index'
$currentSegment = Request::segment(2);

?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bee Book | @yield('title', 'Quản trị')</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />

    <link href="{{ asset('/') }}backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}backend/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/') }}client/js/lib/toastr.css">
    <link href="{{ asset('/') }}backend/css/animate.css" rel="stylesheet">
    <link href="{{ asset('/') }}backend/css/style.css" rel="stylesheet">
    <link href="{{ asset('/') }}backend/css/custom.css" rel="stylesheet">
    <link href="{{ asset('/') }}backend/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{ asset('/') }}backend/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css"
        rel="stylesheet">
    <link href="{{ asset('/') }}backend/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="{{ asset('/') }}backend/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="{{ asset('/') }}backend/css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="{{ asset('/') }}backend/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}backend/css/plugins/codemirror/codemirror.css" rel="stylesheet">
    <script src="{{ asset('/') }}backend/js/jquery-3.1.1.min.js"></script>

</head>

<body class="fixed-navigation">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" style="position: fixed" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="image" class="img-circle" src="/client/images/logo.webp" />
                            </span>
                        </div>
                    </li>

                    <li class="active"><a href="{{ route('overview.index') }}"><i class="fa fa-th-large"></i> <span
                                class="nav-label">Dashboards</span><span class="fa arrow"></span></a>
                    </li>
                    <li class=""><a href="{{ route('adminCategory.index') }}"><i class="fa fa-list"></i> <span
                        class="nav-label">Danh mục</span></a>
            </li>
                    <li class=""><a href="{{ route('order.index') }}"><i class="fa fa-list"></i> <span
                                class="nav-label">Đơn hàng</span></a>
                    </li>
                    <li class=""><a href="{{ route('adminproduct.index') }}"><i class="fa fa-book"></i> <span
                                class="nav-label">Sách</span></a>
                    </li>
                    <li class=""><a href="{{ route('adminUser.index') }}"><i class="fa fa-user"></i> <span
                                class="nav-label">Tài Khoản</span></a>
                    </li>
                    <li class=""><a href="{{ route('admin.banner.index') }}"><i class="fa fa-image"></i> <span
                                class="nav-label">Quản lý banner</span></a>
                    </li>
                    <li class=""><a href="{{ route('adminUser.index') }}"><i class="fa fa-image"></i> <span
                                class="nav-label">Lịch sử giao dịch</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg sidebar-content">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                class="fa fa-bars"></i> </a>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="{{ route('logout.index') }}">
                                <i class="fa fa-sign-out"></i> Đăng xuất
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            {{-- Nội dung ở đây  --}}
            <div class="wrapper wrapper-content">
                @yield('body')
            </div>

            {{-- <div class="footer mt-3">
                <a class="text-dark" href="https://www.facebook.com/profile.php?id=61566989045999">Được xây dựng bởi
                    nhóm Bee Book 2024</a>
            </div> --}}
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('/') }}backend/js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    {{-- <script src="{{ asset('/') }}backend/js/plugins/flot/jquery.flot.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/flot/curvedLines.js"></script> --}}

    <!-- Peity -->
    {{-- <script src="{{ asset('/') }}backend/js/plugins/peity/jquery.peity.min.js"></script> --}}

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('/') }}backend/js/inspinia.js"></script>
    {{-- <script src="{{ asset('/') }}backend/js/plugins/pace/pace.min.js"></script> --}}

    <!-- jQuery UI -->
    <script src="{{ asset('/') }}backend/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    {{-- <script src="{{ asset('/') }}backend/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('/') }}backend/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> --}}

    <!-- Sparkline -->
    {{-- <script src="{{ asset('/') }}backend/js/plugins/sparkline/jquery.sparkline.min.js"></script> --}}

</body>

</html>
