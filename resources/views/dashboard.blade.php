@extends('templates.navbar')

@section('contents')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

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
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box widget-inline">
                            <h5 class="mt-0 font-14">Jenis Layanan</h5>
                            <div class="row">
                                <div class="col-xl-6 col-sm-6 d-grid widget-inline-box text-center">
                                    <button class="btn btn-warning btn-block mt-3 mt-sm-0 p-3" type="button"><i
                                            class="bi bi-truck"></i>&nbsp; Ambil Di Rumah</button>
                                </div>

                                <div class="col-xl-6 col-sm-6 d-grid widget-inline-box text-center">
                                    <button class="btn btn-success btn-block mt-3 mt-sm-0 p-3" type="button"><i
                                            class="bi bi-box-seam"></i>&nbsp; Antar Sendiri</button>
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
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-3">
                        <div class="card-box">
                            <h5 class="mt-0 font-14">Pengumuman</h5>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- end container-fluid -->



        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        2017 - 2020 &copy; Simple theme by <a href="">Coderthemes</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>
    <!-- end content -->

    </div>
    <!-- END content-page -->
@endsection

@section('scripts')
<script async defer
        src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=AIzaSyBPCyuCDP-NsuKm_SVIyga-LHZilnWyzmo"></script>
@endsection
