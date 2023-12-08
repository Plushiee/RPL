@extends('templates.navbar-pengambil')

@section('title', 'MoneyTrash! - Laporan')
@section('css')
    <link rel="stylesheet" href="/assets/styles/akun-pengguna.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

@endsection

@section('contents')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <!-- Start Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent !important">
                <li class="breadcrumb-item"><a href="/bank">Pengambil Sampah</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan</li>
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
                    <div class="col-12">
                        <h2>Laporan Pengambil Sampah Tahun {{ \Carbon\Carbon::now()->year }}
                            <a href="/pengambil/laporan/download" target="_blank" rel="noopener noreferrer" class=" d-none d-md-inline btn btn-primary mb-3 float-right">Download
                                PDF</a>
                        </h2>

                        <a href="/pengambil/laporan/download" target="_blank" rel="noopener noreferrer" class="d-block d-md-none btn btn-primary mb-3 mt-3">Download
                            PDF</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Grafik Transaksi Pengambilan Sampah</h5>
                                <canvas id="myChart" width="100%" height="400px"
                                    style="min-height: 200px; max-height: 500px;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Grafik Transaksi Pengambilan Sampah</h5>
                                <canvas id="monthlyTransactionsChart" width="100%" height="400px"
                                    style=" min-height: 200px; max-height: 500px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Peta Penyebaran Pengambilan Sampah</h5>
                                <div id="map" style="width: 100%; height: 500px;"></div>
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

@section('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg-aZ-Iammau9oEl569JVpJu5olD_2rbQ&callback=initMap&libraries=places">
    </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"
        integrity="sha512-pdCVFUWsxl1A4g0uV6fyJ3nrnTGeWnZN2Tl/56j45UvZ1OMdm9CIbctuIHj+yBIRTUUyv6I9+OivXj4i0LPEYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Automatically provides/replaces `Promise` if missing or broken. -->
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>

    <!-- Minified version of `es6-promise-auto` below. -->
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>

    <script>
        // Jenis sampah
        var jenisSampah = {!! $jenisSampah !!};
        var banyakTransaksi = {!! $totalTransactions !!};

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: jenisSampah,
                datasets: [{
                    label: 'Banyak Pengambilan Sampah ',
                    data: banyakTransaksi,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                }
            }
        });

        // Transaksi per tahun
        var labels = {!! $labels !!};
        var transactionsPerMonth = {!! $transactionsPerMonth !!};

        var ctx2 = document.getElementById('monthlyTransactionsChart').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Banyak Transaksi Per Bulan',
                    data: transactionsPerMonth,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                }
            }
        });

        // Map peta penyebaran
        function initMap(latitude, longitude) {
            // Data lokasi pengambilan dari PHP
            var locations = {!! json_encode($userLocations) !!};

            // Inisialisasi peta dengan nilai zoom dan pusat
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                zoom: 14
            });

            // Menambahkan lingkaran untuk setiap lokasi
            locations.forEach(function(location) {
                const langs = parseFloat(location.lang);
                const longs = parseFloat(location.long);
                var latLng = new google.maps.LatLng(langs, longs);

                // Garis Lingkaran Luar
                var outlineCircle = new google.maps.Circle({
                    center: latLng,
                    radius: 60,
                    strokeColor: 'red',
                    strokeOpacity: 0.8,
                    strokeWeight: 3,
                    fillOpacity: 0,
                    map: map
                });

                // Lingkaran dalam
                var filledCircle = new google.maps.Circle({
                    center: latLng,
                    radius: 60,
                    strokeWeight: 0,
                    fillColor: 'red',
                    fillOpacity: 0.2,
                    map: map
                });
            });
        }

        // Mendapatkan lokasi pengambil
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;
                        initMap(latitude, longitude);
                    },
                    (error) => {
                        console.error('Error getting geolocation:', error);
                        initMap(0, 0);
                    }
                );
            } else {
                console.error('Geolocation is not supported by your browser.');
            }
        }

        getLocation();

        $('#downloadPdfBtn').click(function(e) {
            e.preventDefault();
            alert();

            html2pdf(document.body, {
                margin: 15,
                filename: 'MoneyTrash_Laporan.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            });
        });
    </script>
@endsection
