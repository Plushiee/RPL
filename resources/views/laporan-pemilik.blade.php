@extends('templates.navbar-pemilik')

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
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="startDate">Tanggal Mulai :</label>
                                        <input type="date" id="startDate" class="form-control" name="startDate">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="endDate">Tanggal Akhir :</label>
                                        <input type="date" id="endDate" class="form-control" name="endDate">
                                    </div>
                                    <div class="col-6 mt-3 m-md-0 p-md-0  d-flex align-items-center">
                                        <button id="applyFilter" class="btn btn-primary me-3">Apply Filter</button>
                                        <button id="resetFilter" class="btn btn-secondary">Reset Filter</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <table id="transaksiTable" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Jenis Sampah</th>
                                                    <th>Berat</th>
                                                    <th>Tanggal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kumpulanTransaksi as $transaksi)
                                                    <tr>
                                                        <td>{{ $transaksi->id }}</td>
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
                                                        <td>
                                                            <button class="btn btn-primary" disabled="disabled"></button>
                                                        </td>
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

    <script src="/javascript/laporan-pemilik.js"></script>
@endsection
