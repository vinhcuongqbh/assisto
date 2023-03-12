<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Googlebot-News" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="robots" content="noindex, nofollow">
    <meta name="robots" content="noimageindex">
    <title>アシストロボ</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/dist/css/asabo.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-lg navbar-light navbar-white">
            <div class="container">
                <a href="/staff/" class="navbar-brand">
                    <img src="/img/logo.svg" alt="アシストロボ" class="img-size-64">
                    <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        {{-- <li class="nav-item">
                            <a href="/staff/route" class="nav-link">{{ __('route') }}</a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="/staff/store" class="nav-link text-nowrap">{{ __('store') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/staff/accident" class="nav-link text-nowrap">{{ __('accident') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/staff/track" class="nav-link text-nowrap">{{ __('track') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/staff/guide" class="nav-link text-nowrap">{{ __('guide') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">{{ __('language') }}</a>
                            <div class="dropdown-menu dropdown-menu-sm-left dropdown-menu-right">
                                <a href="/language/en" class="dropdown-item text-center">{{ __('english') }}</a>
                                <a href="/language/jp" class="dropdown-item text-center">{{ __('japanese') }}</a>
                            </div>
                        </li>
                        <li class="nav-item">
                                <form action="{{ route('logout') }}" method="post">
                                    {{ csrf_field() }}
                                    <button class="nav-link text-nowrap btn" type="submit" >{{ __('logout') }}</button>
                                </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-12" style="text-align:center">
                            <h1 class="m-0"> @yield('heading')</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                @yield('content')
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>

    @yield('css')
    @yield('js')
</body>

</html>
