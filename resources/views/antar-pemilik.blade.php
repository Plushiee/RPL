@extends('templates.navbar-pemilik')

@section('title', 'MoneyTrash! - Antar Sendiri')
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
                <li class="breadcrumb-item"><a href="/pemilik/dashboard">Pemilik Sampah</a></li>
                <li class="breadcrumb-item"><a href="/pemilik/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Antar Sendiri</li>
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
                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box widget-inline pt-1 mb-0 pb-2" style="border: none !important">
                            <h5 class="mt-0 font-14">Jenis Sampah dan Kuantitas</h5>
                            <div class="row g-md-4 g-sm-4 g-1">
                                <div class="col-xl-2 col-sm-6 d-grid widget-inline-box text-center">
                                    <input type="checkbox" class="btn-check" id="organik" autocomplete="off">
                                    <label class="btn btn-outline-dark btn-block mt-3 mt-sm-0 p-3 organik mb-0"
                                        type="button" style="font-size: 18px; font-weight: bold" for="organik"><img
                                            src="\assets\sampah\Organik.png" alt="organik.png"
                                            width="96"><br>Organik</label>
                                </div>

                                <div class="col-xl-2 col-sm-6 d-grid widget-inline-box text-center kertas">
                                    <input type="checkbox" class="btn-check" id="kertas" autocomplete="off">
                                    <label class="btn btn-outline-dark btn-block mt-3 mt-sm-0 p-3 mb-0" type="button"
                                        style="font-size: 18px; font-weight: bold" for="kertas"><img
                                            src="\assets\sampah\Kertas.png" alt="kertas.png"
                                            width="96"><br>Kertas</label>
                                </div>
                                <div class="col-xl-2 col-sm-6 d-grid widget-inline-box text-center plastik">
                                    <input type="checkbox" class="btn-check" id="plastik" autocomplete="off">
                                    <label class="btn btn-outline-dark btn-block mt-3 mt-sm-0 p-3 mb-0" type="button"
                                        style="font-size: 18px; font-weight: bold" for="plastik"><img
                                            src="\assets\sampah\Plastik.png" alt="plastik.png"
                                            width="96"><br>Plastik</label>
                                </div>

                                <div class="col-xl-2 col-sm-6 d-grid widget-inline-box text-center kaca">
                                    <input type="checkbox" class="btn-check" id="kaca" autocomplete="off">
                                    <label class="btn btn-outline-dark btn-block mt-3 mt-sm-0 p-3 mb-0" type="button"
                                        style="font-size: 18px; font-weight: bold" for="kaca"><img
                                            src="\assets\sampah\Kaca.png" alt="kaca.png" width="96"><br>Kaca</label>
                                </div>
                                <div class="col-xl-2 col-sm-6 d-grid widget-inline-box text-center logam">
                                    <input type="checkbox" class="btn-check" id="logam" autocomplete="off">
                                    <label class="btn btn-outline-dark btn-block mt-3 mt-sm-0 p-3 mb-0" type="button"
                                        style="font-size: 18px; font-weight: bold" for="logam"><img
                                            src="\assets\sampah\Logam.png" alt="logam.png" width="96"><br>Logam</label>
                                </div>

                                <div class="col-xl-2 col-sm-6 d-grid widget-inline-box text-center lainnya"
                                    style="border: none !important;">
                                    <input type="checkbox" class="btn-check" id="lainnya" autocomplete="off">
                                    <label class="btn btn-outline-dark btn-block mt-3 mt-sm-0 p-3 mb-0" type="button"
                                        style="font-size: 18px; font-weight: bold" for="lainnya"><img
                                            src="\assets\sampah\Lainnya.png" alt="lainnya.png"
                                            width="96"><br>Lainnya</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="card-box my-0 py-0" style="border: none !important">
                        <div class="col-12">
                            <button type="button" class="btn btn-success float-end" id="antar">Antar Sekarang
                                &nbsp;>></button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9">
                        <div class="card-box">
                            <h5 class="mt-0 font-14">Peta</h5>
                            <div class="row m-0 p-0 border">
                                <div id="map" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-3">
                        <div class="card-box">
                            <h5 class="mt-0 font-14">Pengumuman</h5>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                            </div>
                        </div>
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
        <!-- Auth Data Share -->
        <div id="authData" data-name="{{ Auth::user()->name }}" data-nomor="{{ Auth::user()->nomor }}"
            data-csrf="{{ csrf_token() }}"></div>
        <!-- EndAuth Data Share -->

    </div>
    <!-- end content -->

    {{-- </div> --}}
    <!-- END content-page -->
@endsection

@section('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg-aZ-Iammau9oEl569JVpJu5olD_2rbQ&callback=initMap&libraries=places">
    </script>
    <script src="/javascript/gps-map.js"></script>
    <script src="/javascript/pemilik-antar.js"></script>

@endsection
