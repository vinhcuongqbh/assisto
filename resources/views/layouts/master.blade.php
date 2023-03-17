<!DOCTYPE html>
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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/dist/css/asabo.css">
</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="dropdown-toggle btn btn-sm mr-1">{{ __('language') }}</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="/language/en" class="dropdown-item">{{ __('english') }}</a></li>
                        <li><a href="/language/jp" class="dropdown-item">{{ __('japanese') }}</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        {{ csrf_field() }}
                        <input class="btn btn-danger btn-sm" type="submit" value="{{ __('logout') }}">
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4 sidebar-light-teal">
            <!-- Brand Logo -->
            <div class="brand-link">
                <img src="/img/logo.svg" alt="アシストロボ Logo" class="brand-image img-size-64">
                <a class="brand-text font-weight-light text-sm text-bold text-olive" href="{{ route('user.show', Auth::user()->userId) }}">{{ Auth::user()->name }}</a>
            </div>

            <!-- Sidebar -->
            <div class="sidebar os-theme-light">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="/admin" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>{{ __('dashboard') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/center" class="nav-link">
                                <i class="nav-icon fas fa-warehouse"></i>
                                <p>{{ __('centerManagement') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/user" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>{{ __('userManagement') }}</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="/admin/store" class="nav-link">
                                <i class="nav-icon fas fa-store"></i>
                                <p>{{ __('storeManagement') }}</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="/admin/route" class="nav-link">
                                <i class="nav-icon fas fa-route"></i>
                                <p>{{ __('routeManagement') }}</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="/admin/accident" class="nav-link">
                                <i class="nav-icon fa fa-exclamation-triangle"></i>
                                <p>{{ __('accidentReports') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/track" class="nav-link">
                                <i class="nav-icon fas fa-truck-loading"></i>
                                <p>{{ __('trackReports') }}</p>
                            </a>
                        </li>                        
                        <li class="nav-item">
                            <a href="/admin/setting/slogan" class="nav-link">
                                <i class="fa fa-bookmark nav-icon"></i>
                                <p>{{ __('sloganSetting') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/setting/guide" class="nav-link">
                                <i class="far fa-file nav-icon"></i>
                                <p>{{ __('guideManagement') }}</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('heading')</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>

    @yield('css')
    @yield('js')
</body>

</html>
