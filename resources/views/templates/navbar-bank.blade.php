<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="MoneyTrash!" name="description" />
    <meta content="MoneyTrash!" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/navbar/logo.png">
    <!-- App css -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/styles/navbar-css.css">

    <!-- CSS per Page-->
    @yield('css')

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">


        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="/assets/images/users/user-default.webp" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ml-1">
                            {{ Auth::user()->name }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome {{ Auth::user()->name }} !</h6>
                        </div>

                        <!-- item-->
                        <a href="/bank/akun" class="dropdown-item notify-item">
                            <i class="mdi mdi-settings-outline"></i>
                            <span>Akun</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="/bank/logout" class="dropdown-item notify-item">
                            <i class="mdi mdi-logout-variant"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="/" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="/assets/navbar/logo-long.png" alt="" height="40">
                        <!-- <span class="logo-lg-text-dark">Simple</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-lg-text-dark">S</span> -->
                        <img src="/assets/navbar/logo.png" alt="" height="22">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>
            </ul>
        </div>
        <!-- end Topbar -->
        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">
            <div class="user-box">
                <div class="float-left">
                    <img src="/assets/images/users/user-default.webp" alt="" class="avatar-md rounded-circle">
                </div>
                <div class="user-info">
                    <a href="#">{{ Auth::user()->name }}</a>
                    <p class="text-muted m-0">
                        Bank Sampah
                    </p>
                </div>
            </div>

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <ul class="metismenu" id="side-menu">
                    <li class="menu-title">Navigasi</li>
                    <li>
                        <a href="/bank/dashboard"
                            class="@if (request()->is('bank/dashboard*')) active-class active-txt @endif mb-0">
                            <i class="bi bi-house"></i>
                            <span> Home</span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="/bank/dashboard"
                                    class="mt-0 @if (request()->is('bank/dashboard')) active-class active-txt @endif"><i
                                        class="bi bi-speedometer2"></i>&nbsp; Dashboard</a></li>
                            <li><a href="/bank/dashboard/terima"
                                    class="@if (request()->is('bank/dashboard/terima*')) active-class active-txt @endif"><i
                                        class="bi bi-truck"></i>&nbsp; Terima Pesansan</a></li>
                            <li><a href="/bank/dashboard/pengumuman"
                                    class="@if (request()->is('bank/dashboard/pengumuman*')) active-class active-txt @endif"><i
                                        class="bi bi-bell"></i>&nbsp; Buat Pengumuman</a></li>
                        </ul>
                    </li>

                    <li class="@if (request()->is('bank/riwayat*')) active-class @endif">
                        <a href="/bank/riwayat">
                            <i class="bi bi-clock-history @if (request()->is('bank/riwayat*')) active-txt @endif"></i>
                            <span class="@if (request()->is('bank/riwayat*')) active-txt @endif"> Riwayat </span>
                            @if ($hitungTransaksiBank > 0 && $hitungPermintaanAprroveBank == 0)
                                <span
                                    class="badge badge-warning float-right">{{ $hitungTransaksiBank }}</span>
                            @endif

                            @if ($hitungPermintaanAprroveBank != 0)
                                    <span
                                        class="badge badge-danger float-right">{{ $hitungPermintaanAprroveBank }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="@if (request()->is('bank/laporan*')) active-class @endif">
                        <a href="/bank/laporan">
                            <i
                                class="bi bi-bar-chart @if (request()->is('bank/laporan*')) active-txt @endif"></i>
                            <span class="@if (request()->is('bank/laporan*')) active-txt @endif"> Laporan </span>
                        </a>
                    </li>

                    <li class="@if (request()->is('bank/akun*')) active-class @endif">
                        <a href="/bank/akun">
                            <i
                                class="mdi mdi-settings-outline noti-ico @if (request()->is('bank/akun*')) active-txt @endif"></i>
                            <span class="@if (request()->is('bank/akun*')) active-txt @endif"> Akun </span>
                        </a>
                    </li>
                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>


        </div>
        <!-- Left Sidebar End -->

        {{-- Contents --}}
        @yield('contents')
        {{-- Contents --}}
    </div>
    <!-- END wrapper -->

    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <!-- Vendor js -->
    <script src="/assets/js/vendor.min.js"></script>

    <script src="/assets/libs/morris-js/morris.min.js"></script>
    <script src="/assets/libs/raphael/raphael.min.js"></script>

    <script src="/assets/js/pages/dashboard.init.js"></script>

    <!-- App js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/app.min.js"></script>

    <!-- Script per page -->
    @yield('scripts')


</body>

</html>
