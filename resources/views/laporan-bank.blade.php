@extends('templates.navbar-bank')

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
                <h2>Laporan Bank Sampah</h2>
                <div class="row">
                    <div class="row m-0 p-0">
                        <div class="col-12 col-md-6 d-flex align-items-stretch">
                            <div class="card" style="min-width: 100%;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <h5 class="card-title text-center">Banyak Sampah Hari Ini</h5>
                                    <h1 class="card-text m-0 p-0 text-center" id="banyakSampah" style="font-weight: bold">
                                        {{ $sumBerat[0]->totalBerat }}
                                        @if (!$sumBerat[0]->totalBerat)
                                            0
                                        @endif
                                    </h1>
                                    <h5 class="card-text text-center text-muted">Kilogram</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex align-items-stretch">
                            <div class="card" style="min-width: 100%;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <h5 class="card-title text-center">Banyak Transaksi Hari Ini</h5>
                                    <h1 class="card-text m-0 p-0 text-center" id="transaksiSampah"
                                        style="font-weight: bold">{{ $countTransaksi }}</h1>
                                    <h5 class="card-text text-center text-muted">Transaksi</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex align-items-stretch">
                            <div class="card" style="min-width: 100%;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <h5 class="card-title text-center">Pengirim Sampah Dengan Berat Terbanyak</h5>
                                    <h1 class="card-text text-center ">
                                        @if ($userPengirimTerbanyak)
                                            {{ $userPengirimTerbanyak->namaLengkap }}
                                        @else
                                            -
                                        @endif
                                    </h1>
                                    <h5 class="card-text m-0 p-0 text-muted text-center" id="transaksiSampah"
                                        style="font-weight: bold">
                                        @if (!$pengirimTerbanyak)
                                            0
                                        @else
                                            {{ $pengirimTerbanyak->totalBerat }}
                                        @endif
                                        Kilogram
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex align-items-stretch">
                            <div class="card" style="min-width: 100%;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                    <h5 class="card-title text-center">Pengirim Sampah Dengan Transaksi Terbanyak
                                    </h5>
                                    <h1 class="card-text text-center ">
                                        @if (!$pengirimTerbanyak)
                                            -
                                        @else
                                            {{ $pengirimTerbanyak->jumlahTransaksi }}
                                        @endif
                                    </h1>
                                    <h5 class="card-text m-0 p-0 text-muted text-center" id="transaksiSampah"
                                        style="font-weight: bold"> Transaksi</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 d-flex align-items-stretch">
                        <div class="card" style="min-width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title">Laporan Transaksi Bank Sampah</h5>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="startDate">Tanggal Mulai :</label>
                                        <input type="date" id="startDate1" class="form-control" name="startDate">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="endDate">Tanggal Akhir :</label>
                                        <input type="date" id="endDate1" class="form-control" name="endDate">
                                    </div>
                                    <div class="col-6 mt-3 m-md-0 p-md-0  d-flex align-items-center align-self-end">
                                        <button id="applyFilter1" class="btn btn-primary me-3">Apply Filter</button>
                                        <button id="resetFilter1" class="btn btn-secondary">Reset Filter</button>
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
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kumpulanTransaksi as $transaksi)
                                                    <tr>
                                                        <td>{{ $transaksi->id }}</td>
                                                        <td>{{ $transaksi->jenisSampah }}</td>
                                                        <td>{{ $transaksi->berat }} kg</td>
                                                        <td>{{ $transaksi->updated_at }}</td>
                                                        <td>
                                                            @if ($transaksi->diterima == false && $transaksi->terantar == false)
                                                                <span class="badge badge-danger"> &nbsp;Respon&nbsp; </span>
                                                            @endif
                                                            @if ($transaksi->diterima == true && $transaksi->terantar == false)
                                                                <span class="badge badge-warning"> &nbsp;Diterima&nbsp;
                                                                </span>
                                                            @endif
                                                            @if ($transaksi->diterima == true && $transaksi->terantar == true)
                                                                <span class="badge badge-success"> &nbsp;Selesai&nbsp;
                                                                </span>
                                                            @endif
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

                    <div class="col-12 col-lg-6 d-flex align-items-stretch">
                        <div class="card" style="min-width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title">Daftar Pengirim Sampah</h5>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="startDate">Tanggal Mulai :</label>
                                        <input type="date" id="startDate2" class="form-control" name="startDate">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="endDate">Tanggal Akhir :</label>
                                        <input type="date" id="endDate2" class="form-control" name="endDate">
                                    </div>
                                    <div class="col-6 mt-3 m-md-0 p-md-0  d-flex align-items-center align-self-end">
                                        <button id="applyFilter2" class="btn btn-primary me-3">Apply Filter</button>
                                        <button id="resetFilter2" class="btn btn-secondary">Reset Filter</button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <table id="pengirimTable" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Nama Pengirim</th>
                                                    <th>Email Pengirim</th>
                                                    <th>Nomor Pengirim</th>
                                                    <th>Alamat</th>
                                                    <th>Tanggal Transaksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kumpulanTransaksi as $transaksi)
                                                    <tr>
                                                        <td>{{ $transaksi->namaLengkap }}</td>
                                                        <td>{{ $transaksi->email }}</td>
                                                        <td>{{ $transaksi->nomor }} kg</td>
                                                        <td>{{ $transaksi->alamat }}, {{ $transaksi->kecamatan }},
                                                            {{ $transaksi->kota }}, {{ $transaksi->provinsi }}
                                                            {{ $transaksi->kodePos }}</td>
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

    <script src="/javascript/laporan-bank.js"></script>
@endsection