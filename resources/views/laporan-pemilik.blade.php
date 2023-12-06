@extends('templates.navbar-pemilik')

@section('title', 'MoneyTrash! - Laporan')
@section('css')
    <link rel="stylesheet" href="/assets/styles/akun-pengguna.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <style>
        #transaksiTable tbody tr:hover {
            background-color: #a9a9a9 !important;
            cursor: pointer;
        }

        /* Gaya saat diklik */
        #transaksiTable tbody tr.clicked {
            background-color: #a9a9a9 !important;
        }
    </style>
@endsection

@section('contents')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <!-- Start Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent !important">
                <li class="breadcrumb-item"><a href="/bank">Bank Sampah</a></li>
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
                <h2>Laporan Pemilik</h2>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Laporan Transaksi</h5>
                                <form action="/pemilik/laporan/download" method="POST" class="d-inline">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label for="startDate">Tanggal Mulai :</label>
                                            <input type="date" id="startDate1" class="form-control" name="startDate">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="endDate">Tanggal Akhir :</label>
                                            <input type="date" id="endDate1" class="form-control" name="endDate">
                                        </div>
                                        <div class="col-6 mt-3 m-md-0 p-md-0 d-flex align-items-center align-self-end"
                                            style="font-weight: bold;">
                                            <button id="applyFilter" class="btn btn-primary me-3"
                                                style="font-weight: bold;">Apply Filter</button>
                                            <button id="resetFilter" class="btn btn-secondary me-3"
                                                style="font-weight: bold;">Reset Filter</button>
                                            <button type="submit" class="btn btn-success">
                                                Unduh Laporan
                                            </button>
                                        </div>

                                    </div>
                                </form>

                                <div class="row">
                                    <div class="col-12">
                                        <table id="transaksiTable" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="d-none">Id</th>
                                                    <th class="d-none">Nama</th>
                                                    <th class="d-none">Alamat</th>
                                                    <th>Jenis Sampah</th>
                                                    <th>Berat</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kumpulanTransaksi as $transaksi)
                                                    <tr>
                                                        <td class="d-none">{{ $transaksi->id }}</td>
                                                        <td class="d-none">{{ $transaksi->nama }}</td>
                                                        <td class="d-none">
                                                            {{ $transaksi->alamat }}({{ $transaksi->catatan }}),
                                                            {{ $transaksi->kecamatan }}, {{ $transaksi->kota }},
                                                            {{ $transaksi->provinsi }}, {{ $transaksi->kodePos }}</td>
                                                        <td>{{ $transaksi->jenisSampah }}</td>
                                                        <td>
                                                            @if ($transaksi->berat == 'small')
                                                                Small (Maks. 5 Kg)
                                                            @elseif ($transaksi->berat == 'medium')
                                                                Medium (Maks. 20 Kg)
                                                            @elseif ($transaksi->berat == 'large')
                                                                Large (Maks. 100 Kg)
                                                            @endif
                                                        </td>
                                                        <td>{{ $transaksi->updated_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Grafik Perbandingan Transaksi Jenis Sampah</h5>
                                <canvas id="jenisSampahChart" width="100%" height="100px"
                                    style="max-height: 400px"></canvas>
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
    <script src="https://unpkg.com/html2pdf.js"></script>

    <script src="/javascript/laporan-pemilik.js"></script>

    <script>
        $(document).ready(function() {
            var labels = {!! $labels !!};
            var data = {!! $data !!};

            var ctx = document.getElementById('jenisSampahChart').getContext('2d');
            var jenisSampahChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                        ],
                    }]
                },
            });

            // Pop Up Swall
            document.addEventListener('DOMContentLoaded', function() {
                var rows = document.querySelectorAll('#transaksiTable tbody tr');

                rows.forEach(function(row) {
                    row.addEventListener('mouseover', function() {
                        row.style.backgroundColor = '#a9a9a9';
                    });

                    row.addEventListener('mouseout', function() {
                        row.style.backgroundColor = '';
                    });

                    row.addEventListener('click', function() {
                        var id = row.cells[0].innerText;
                        var nama = row.cells[1].innerText;
                        var alamat = row.cells[2].innerText;
                        var jenisSampah = row.cells[3].innerText;
                        var berat = row.cells[4].innerText;
                        var tanggal = row.cells[5].innerText;

                        Swal.fire({
                            title: 'Informasi Transaksi',
                            html: `
                        <p><strong>Id Transaksi :</strong><br> ${id}</p>
                        <p><strong>Atas nama :</strong><br> ${nama}</p>
                        <p><strong>Alamat :</strong><br> ${alamat}</p>
                        <p><strong>Jenis Sampah :</strong><br> ${jenisSampah}</p>
                        <p><strong>Berat :</strong><br> ${berat}</p>
                        <p><strong>Tanggal :</strong><br> ${tanggal}</p>
                    `,
                            icon: 'info',
                            confirmButtonText: 'OK'
                        });
                    });
                });
            });
        });
    </script>
@endsection
