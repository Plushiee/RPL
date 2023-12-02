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
                <h2>Laporan Pengambil Sampah</h2>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Grafik Transaksi Pengambilan Sampah</h5>
                                <canvas id="myChart" width="100%"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <canvas id="myChart" width="100%"></canvas>
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
    <script>
        var jenisSampah = {!! $jenisSampah !!};
        var banyakTransaksi = {!! $totalTransactions !!};

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: jenisSampah,
                datasets: [{
                    label: 'Pengambilan Sampah',
                    data: banyakTransaksi,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1, // Adjust this value to set the step size
                            precision: 0 // Number of decimal places
                        }
                    }
                }
            }
        });
    </script>


    <script src="/javascript/laporan-pengambil.js"></script>
@endsection
