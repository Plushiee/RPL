@extends('templates.navbar-bank')

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
                <li class="breadcrumb-item"><a href="pemilik">Bank Sampah</a></li>
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
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box widget-inline">
                            <div class="row">
                                <div class="col-xl-6 col-sm-6 d-grid widget-inline-box text-center">
                                    <a href="dashboard/ambil">
                                        <button class="btn btn-warning btn-block mt-3 mt-sm-0 p-3" type="button"><i
                                                class="bi bi-truck"></i>&nbsp; Ambil Pesanan</button>
                                    </a>
                                </div>

                                <div class="col-xl-6 col-sm-6 d-grid widget-inline-box text-center">
                                    <a href="dashboard/pengumuman">
                                        <button class="btn btn-success btn-block mt-3 mt-sm-0 p-3" id="buatPengumuman"
                                            type="button"><i class="bi bi-bell"></i>&nbsp; Buat Pengumuman</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row -->

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
                                <div class="pagination-container">
                                    {{-- @foreach ($daftarPengumuman as $pengumuman)
                                        <div class="accordion-item pengumuman-card">
                                            <h2 class="accordion-header" id="flush-heading{{ $pengumuman->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapse{{ $pengumuman->id }}"
                                                    aria-expanded="false"
                                                    aria-controls="flush-collapse{{ $pengumuman->id }}">
                                                    <b>{{ $pengumuman->judulPengumuman }}</b>
                                                </button>
                                            </h2>
                                            <div id="flush-collapse{{ $pengumuman->id }}"
                                                class="accordion-collapse collapse"
                                                aria-labelledby="flush-heading{{ $pengumuman->id }}"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <h6 class="text-muted">
                                                        <b>
                                                            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->locale('id')->isoFormat('dddd') }}<br>
                                                            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
                                                        </b>
                                                    </h6>
                                                    <p>{{ $pengumuman->isiPengumuman }}</p>
                                                    <!-- Add other properties as needed -->
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach --}}
                                </div>
                                <div class="pagination mt-2 d-flex justify-content-center">
                                    <button id="prev-page" class="btn btn-primary"><i class="bi bi-caret-left"></i></button>
                                    &nbsp;
                                    <button id="next-page" class="btn btn-primary"><i
                                            class="bi bi-caret-right"></i></button>
                                </div>
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

    </div>
    <!-- end content -->

    </div>
    <!-- END content-page -->
@endsection

@section('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg-aZ-Iammau9oEl569JVpJu5olD_2rbQ&callback=initMap&libraries=places">
    </script>
    <script src="/javascript/gps-map.js"></script>
    <script src="/javascript/pengumuman-view.js"></script>
@endsection
