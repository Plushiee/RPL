@extends('templates.navbar-pengambil')

@section('title', 'MoneyTrash! - Dashboard')
@section('css')
    <link rel="stylesheet" href="/assets/styles/dashboard-pengambil.css">
@endsection

@section('contents')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <!-- Start Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent !important">
                <li class="breadcrumb-item"><a href="pemilik">Pengambil Sampah</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                                , {{ Auth::user()->name }}</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="card" style="width: 22rem;">
                            <div class="card-body shadow">
                                <h1 class="card-title mt-2">Pengumuman Pengambil Sampah</h1>
                                <p class="card-text">Pengumuman akan dikirimkan kepada seluruh pemilik sampah yang anda terima pesanannya. Maksimal pengumuman aktif sebanyak 3</p>
                                <a href="#" class="btn btn-primary btn-block" id="buatLogbook">Buat Pengumuman</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <!-- Cards go here -->
                        <div class="card-container">

                            <!-- Card Mulai -->
                                   <div class="row">'
                                    <div class="col-12">
                                    <div class="card" style="width: 100%;">
                                    <div class="card-body rounded shadow">
                                    <div class="row mb-2">
                                    <div class="col-1">
                                    <img src="assets/images/ok.webp" alt="Ok.png" width ="40">'
                                    </div>
                                    <div class="col-11">
                                    <h1 class="card-title m-0 p-0">hari Tanggal</h1>
                                    </div>
                                    </div>
                                    <p class="card-text text-muted mb-0 pb-0">Isi Pengumuman</p>
                                    <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis, libero?</p>
                                    <hr class="my-3" style="border-width: 2px; border-color: black;">
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                            <!-- Card Selesai -->

                        </div>

                        <!-- Pagination -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-3">
                                <li class="page-item" id="prev-page">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <!-- Page indicators will be dynamically added here -->
                                <li class="page-item" id="next-page">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
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
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg-aZ-Iammau9oEl569JVpJu5olD_2rbQ&callback=initMap&libraries=places">
    </script>
    <script src="/javascript/gps-pengambil.js"></script>
@endsection
