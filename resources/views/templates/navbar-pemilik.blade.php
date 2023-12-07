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
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome {{ Auth::user()->name }} !</h6>
                        </div>

                        <!-- item-->
                        <a href="/pemilik/akun" class="dropdown-item notify-item">
                            <i class="mdi mdi-settings-outline"></i>
                            <span>Akun</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="/logout" class="dropdown-item notify-item">
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
                        @if (Auth::check() && Auth::user()->status === 'pemilik')
                            Pemilik Sampah
                        @else
                            Administrator
                        @endif
                    </p>
                </div>
            </div>

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <ul class="metismenu" id="side-menu">
                    <li class="menu-title">Navigasi</li>
                    <li>
                        <a href="/pemilik/dashboard" class="@if (request()->is('pemilik/dashboard*')) active-class active-txt @endif mb-0">
                            <i class="bi bi-house"></i>
                            <span> Home</span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="/pemilik/dashboard"
                                    class="mt-0 @if (request()->is('pemilik/dashboard')) active-class active-txt @endif"><i
                                        class="bi bi-speedometer2"></i>&nbsp; Dashboard</a></li>
                            <li><a href="/pemilik/dashboard/ambil"
                                    class="@if (request()->is('pemilik/dashboard/ambil*')) active-class active-txt @endif"><i
                                        class="bi bi-truck"></i>&nbsp; Ambil Di Rumah</a></li>
                            <li><a href="/pemilik/dashboard/antar"
                                    class="@if (request()->is('pemilik/dashboard/antar*')) active-class active-txt @endif"><i
                                        class="bi bi-box-seam"></i>&nbsp; Antar Sendiri</a></li>
                        </ul>
                    </li>

                    <li class="@if (request()->is('pemilik/pembayaran*')) active-class @endif">
                        <a href="/pemilik/pembayaran">
                            <i class="bi bi-cash-stack @if (request()->is('pemilik/pembayaran*')) active-txt @endif"></i>
                            <span class="@if (request()->is('pemilik/pembayaran*')) active-txt @endif"> Pembayaran </span>
                            @if ($hitungBelumTerbayar > 0)
                                <span class="badge badge-danger float-right">{{ $hitungBelumTerbayar }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="@if (request()->is('pemilik/riwayat*')) active-class @endif">
                        <a href="/pemilik/riwayat">
                            <i class="bi bi-clock-history @if (request()->is('pemilik/riwayat*')) active-txt @endif"></i>
                            <span class="@if (request()->is('pemilik/riwayat*')) active-txt @endif"> Riwayat </span>
                            @if ($hitungTransaksiBerjalanPemilik > 0)
                                <span class="badge badge-warning float-right">{{ $hitungTransaksiBerjalanPemilik }}</span>
                            @endif
                        </a>
                    </li>

                    <li class="@if (request()->is('pemilik/laporan*')) active-class @endif">
                        <a href="/pemilik/laporan">
                            <i
                                class="bi bi-bar-chart @if (request()->is('pemilik/laporan*')) active-txt @endif"></i>
                            <span class="@if (request()->is('pemilik/laporan*')) active-txt @endif"> Laporan </span>
                        </a>
                    </li>

                    <li class="@if (request()->is('pemilik/akun*')) active-class @endif">
                        <a href="/pemilik/akun">
                            <i
                                class="mdi mdi-settings-outline noti-ico @if (request()->is('pemilik/akun*')) active-txt @endif"></i>
                            <span class="@if (request()->is('pemilik/akun*')) active-txt @endif"> Akun </span>
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

    <script>
        $(document).ready(function() {
            function tampilkanSweetAlert() {
                Swal.fire({
                    title: "Selamat datang di Dashboard MoneyTrash!",
                    html: `Anda harus mengisi data sebelum melanjutkan.
                    <form action="/pemilik/simpanAkunAwal" method="POST" class="mt-3">
                        @csrf
                        <div class="mb-3">
                            <input class="form-control" type="text" name="nama" placeholder="Nama Pemilik Akun" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="nomor" class="form-label mb-0">Nomor Telepon</label>
                            <input class="form-control" type="text" name="nomor" id="nomor" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="alamat" class="form-label mb-0">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" name="kecamatan" placeholder="Kecamatan" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" name="kota" placeholder="Kota atau Kabupaten" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" name="provinsi" placeholder="Provinsi" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="number" name="kodePos" placeholder="Kode Pos" required>
                        </div>
                        <div class=" text-start">
                            <label for="catatan" class="form-label mb-0">Catatan Tambahan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                        </div>
                    </form>`,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showCancelButton: false,
                    confirmButtonText: "Simpan",
                    preConfirm: () => {
                        const namaLengkap = Swal.getPopup().querySelector("input[name='nama']").value;
                        const nomor = Swal.getPopup().querySelector("input[name='nomor']").value;
                        const alamat = Swal.getPopup().querySelector("textarea[name='alamat']").value;
                        const kecamatan = Swal.getPopup().querySelector("input[name='kecamatan']")
                            .value;
                        const kota = Swal.getPopup().querySelector("input[name='kota']").value;
                        const provinsi = Swal.getPopup().querySelector("input[name='provinsi']").value;
                        const kodePos = Swal.getPopup().querySelector("input[name='kodePos']").value;
                        const catatan = Swal.getPopup().querySelector("textarea[name='catatan']").value;

                        if (!namaLengkap || !nomor || !alamat || !kecamatan || !kota || !provinsi || !
                            kodePos) {
                            Swal.showValidationMessage("Semua Kolom Harus Terisi!");
                        } else {
                            return $.ajax({
                                type: "POST",
                                url: "/pemilik/simpanAkunAwal", // Sesuaikan dengan route Anda
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    namaLengkap: namaLengkap,
                                    nomor: nomor,
                                    alamat: alamat,
                                    kecamatan: kecamatan,
                                    kota: kota,
                                    provinsi: provinsi,
                                    kodePos: kodePos,
                                    catatan: catatan,
                                },
                                success: function(response) {
                                    Swal.fire("Data Tersimpan", response.message,
                                        "success");
                                },
                                error: function(error) {
                                    Swal.fire("Error",
                                        "Terjadi kesalahan saat menyimpan data.",
                                        "error");
                                }
                            });
                        }
                    }
                });
            }

            const isUserBaru = {{ Auth::user()->baru}};

            if (isUserBaru) {
                tampilkanSweetAlert();
            }
        });
    </script>

    <!-- Script per page -->
    @yield('scripts')


</body>

</html>
