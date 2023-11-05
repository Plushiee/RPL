@extends('templates.navbar-pemilik')

@section('title', 'MoneyTrash! - Dashboard')
@section('css')
    <link rel="stylesheet" href="/assets/styles/akun-pengguna.css">
@endsection

@section('contents')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <!-- Start Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent !important">
                <li class="breadcrumb-item"><a href="pemilik">Pemilik Sampah</a></li>
                <li class="breadcrumb-item active" aria-current="page">Akun</li>
            </ol>
        </nav>
        <!-- End Breadcrumb -->

        <div class="content pt-0 mt-0">

            <!-- Start container-fluid -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <h4 class="header-title mb-3">Selamat
                                <?php
                                date_default_timezone_set('Asia/Jakarta');

                                $jam = date('H');

                                if ($jam >= 5 && $jam < 12) {
                                    $waktu = 'Pagi';
                                } elseif ($jam >= 12 && $jam < 18) {
                                    $waktu = 'Siang';
                                } else {
                                    $waktu = 'Malam';
                                }

                                echo $waktu;
                                ?>
                                , {{ Auth::user()->name }} </h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 info">
                        <div class="row header-title">
                            <div class="col-4">
                                <img src="/assets/images/users/avatar-1.jpg" width="128px" alt=""
                                    class="rounded-circle d-none d-sm-block">
                                <img src="/assets/images/users/avatar-1.jpg" width="74px" alt=""
                                    class="rounded-circle d-block d-sm-none">
                            </div>
                            <div class="col-8">
                                <div class="user-info align-items-center">
                                    <a href="#" style="font-weight: bold; color: black">{{ Auth::user()->name }}</a>
                                    <p class="text-muted m-0">
                                        @if (Auth::check() && Auth::user()->status === 'pemilik')
                                            Pemilik Sampah
                                        @else
                                            Administrator
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <h5 class="mt-0 mb-0 font-14">Data Akun
                        <button class="btn btn-primary float-end edit-btn py-1 px-2"><i
                                class="mdi mdi-settings-outline"></i> &nbsp;Edit Data Akun</button>
                    </h5>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Nama Akun</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">E-mail</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Nomor Handphone</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->nomor }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Status Verifikasi</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: <span style="color: red;"><i class="bi bi-ban"></i>&nbsp; Belum
                                    Terverivikasi! </span> <a href="">&nbsp;&nbsp; Verifikasi Sekarang!</a></p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Password</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: ***********</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <h5 class="mt-0 mb-0 font-14">Data Pengguna
                        <button class="btn btn-primary float-end edit-btn py-1 px-2"><i
                                class="mdi mdi-settings-outline"></i> &nbsp;Edit Data Pengguna</button>
                    </h5>
                    <div class="row ms-2 p-0 my-0 ">
                        <div class="col-3">
                            <p class="m-0 p-0">Nama Lengkap</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->namaLengkap }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Alamat Lengkap</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->alamat }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Kecamatan</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->kecamatan }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Kota</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->kota }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Provinsi</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->provinsi }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Kode Pos</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->kodePos }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Catatan Tambahan (Cth: Blok / Unit, No., Patokan)</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->catatan }}</p>
                        </div>
                    </div>
                </div>

                <div class="header-title"></div>

                <div class="row">
                    <h5 class="mt-3 mb-0 font-14">Daftar Sebagai</h5>
                    <div class="col-12 mx-0 px-0">
                        <div class="card-box widget-inline mt-0 pt-3" style="border: none">
                            <div class="row g-0 g-sm-3 g-md-3">
                                <div class="col-xl-6 col-sm-12 d-grid widget-inline-box text-center">
                                    <a href="dashboard/ambil">
                                        <button class="btn btn-warning btn-block mt-3 mt-sm-0 p-3" type="button"><i
                                                class="bi bi-truck"></i>&nbsp; Pengambil Sampah</button>
                                    </a>
                                </div>

                                <div class="col-xl-6 col-sm-12 d-grid widget-inline-box text-center" style="border: none !important">
                                    <button class="btn btn-success btn-block mt-3 mt-sm-0 p-3" type="button"><i
                                            class="bi bi-box-seam"></i>&nbsp; Bank Sampah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end row -->


                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- end container-fluid -->



        <!-- Footer Start -->
        {{-- <footer class="footer"> --}}
        {{-- <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        2017 - 2020 &copy; Simple theme by <a href="">Coderthemes</a>
                    </div>
                </div>
            </div> --}}
        {{-- </footer> --}}
        <!-- end Footer -->

    </div>
    <!-- end content -->

    </div>
    <!-- END content-page -->
@endsection
