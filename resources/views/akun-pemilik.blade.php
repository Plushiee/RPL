@extends('templates.navbar-pemilik')

@section('title', 'MoneyTrash! - Dashboard')
@section('css')
    <link rel="stylesheet" href="/assets/styles/dashboard-pengguna.css">
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
                <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ambil di Rumah</li>
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
                                , ...</h4>
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
                                    <a href="#" style="font-weight: bold; color: black">Stanley Jones</a>
                                    <p class="text-muted m-0">Administrator</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <h5 class="mt-0 mb-2 font-14">Data Akun</h5>
                    <div class="row ms-2 p-0 my-0 ">
                        <div class="col-3">
                            <p class="m-0 p-0">Nama Akun</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: Stanley Jones</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">E-mail</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: StanleyJones@gmail.com</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Nomor Handphone</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: +62-812-8993-6969</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <h5 class="mt-0 mb-2 font-14">Data Pengguna</h5>
                    <div class="row ms-2 p-0 my-0 ">
                        <div class="col-3">
                            <p class="m-0 p-0">Nama Lengkap</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: Stanley Jones</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Alamat</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: StanleyJones@gmail.com</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Nomor Handphone</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: +62-812-8993-6969</p>
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

@section('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPCyuCDP-NsuKm_SVIyga-LHZilnWyzmo&callback=initMap"></script>
@endsection
