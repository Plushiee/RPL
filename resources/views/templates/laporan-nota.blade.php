<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="MoneyTrash!" name="description" />
    <meta content="MoneyTrash!" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="/assets/navbar/logo.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/styles/navbar-css.css">

    @yield('css')

</head>

<body style="background-color: white !important;">
    <div id="wrapper" style="width: 210mm; height: 296mm; max-height: 296mm;" class="border">
        <div class="row h-100">
            <div class="col-1 text-center h-100 border me-0 pe-0">
                <div class="row">
                    <div class="col-12">
                    <img src="/assets/navbar/logo-long-dark vertical.png" alt="" width="50mm"
                        class="my-4 py-4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <img src="/assets/navbar/logo-long-dark vertical.png" alt="" width="50mm"
                        class="my-4 py-4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <img src="/assets/navbar/logo-long-dark vertical.png" alt="" width="50mm"
                        class="my-4 py-4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <img src="/assets/navbar/logo-long-dark vertical.png" alt="" width="50mm"
                        class="my-4 py-4">
                    </div>
                </div>
            </div>
            <div class="col-11 ps-0 h-100">
                <div class="navbar-custom" style="background-color: white !important">
                    <ul class="list-unstyled topnav-menu float-right mb-0">
                        <li class="dropdown notification-list">
                            <a class="nav-link nav-user mr-0" data-toggle="dropdown" role="button"
                                aria-haspopup="false" aria-expanded="false">
                                <img src="/assets/images/users/user-default.webp" alt="user-image"
                                    class="rounded-circle">
                                <span class="pro-user-name ml-1">
                                    {{ Auth::user()->name }}
                                </span>
                            </a>
                        </li>
                    </ul>

                    <div class="logo-box">
                        <a class="logo text-center logo-dark">
                            <span class="logo-lg">
                                <img src="/assets/navbar/logo-long.png" alt="" height="40">
                            </span>
                            <span class="logo-sm">
                                <img src="/assets/navbar/logo.png" alt="" height="22">
                            </span>
                        </a>
                    </div>
                </div>

                <h5 class="text-muted my-0 py-0 ms-4">
                    Jl. Dr. Wahidin Sudirohusodo No.5-25, Kotabaru, <br> Kec. Gondokusuman,
                    Kota Yogyakarta, <br>Daerah Istimewa Yogyakarta 55224
                </h5>
                <p class=" my-0 py-0 ms-4 mb-3">+62-274-563929</p>

                <div class="container-fluid px-3 border shadow h-100">
                    @yield('contents')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script src="/assets/js/vendor.min.js"></script>

    <script src="/assets/libs/morris-js/morris.min.js"></script>
    <script src="/assets/libs/raphael/raphael.min.js"></script>

    <script src="/assets/js/pages/dashboard.init.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/app.min.js"></script>

    @yield('scripts')
</body>

</html>
