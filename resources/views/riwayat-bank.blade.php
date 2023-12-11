@extends('templates.navbar-bank')

@section('title', 'MoneyTrash! - Riwayat')
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
                <li class="breadcrumb-item"><a href="/bank/dashboard">Bank Sampah</a></li>
                <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
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
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card-box widget-inline pt-1" style="border: none !important">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header mt-0 pt-0">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h5 class="mt-0 mb-0 font-14">Pesanan Aktif</h5>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body pt-4 pb-0">
                                        <div class="card-container-1" id="card-container-1">
                                            @foreach ($kumpulanTransaksi as $transaksi)
                                                @if ($transaksi->diterima == true && $transaksi->terantar == false)
                                                    <div class="card shadow-0 border mb-4">
                                                        <div class="card-body pt-2">
                                                            <div class="row mb-3">
                                                                <div class="col-12 col-sm-10 d-flex align-items-center">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <h4 class="m-0 p-0">Sampah
                                                                                {{ $transaksi->jenisSampah }}
                                                                            </h4>
                                                                            <p class="m-0 p-0">
                                                                                {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d-m-Y') }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-12 col-sm-2 d-flex align-items-center justify-content-end">
                                                                    @if ($transaksi->diterima == true && $transaksi->terantar == false)
                                                                        <span class="badge badge-warning"> &nbsp;Belum
                                                                            Terantar&nbsp; </span>
                                                                    @endif
                                                                    @if ($transaksi->diterima == true && $transaksi->terantar == true)
                                                                        <span class="badge badge-success"> &nbsp;Sudah
                                                                            Terantar&nbsp; </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <h5 class="text-muted mb-0 mt-0 pt-0">
                                                                        {{ $transaksi->name }}</h5>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <h5 class="text-muted mb-0 mt-0 pt-0">
                                                                        {{ $transaksi->nama }}
                                                                    </h5>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <p class="text-muted mb-0 small">{{ $transaksi->nomor }}
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <p class="text-muted mb-0 small">
                                                                        <b>Catatan Tambahan : </b><br>
                                                                        @if ($transaksi->catatanTambahan == null)
                                                                            -
                                                                        @else
                                                                            {{ $transaksi->catatanTambahan }}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <p class="text-muted mb-0 small">
                                                                        <b>Berat :</b><br>{{ $transaksi->berat }} Kg
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 mt-3 mt-sm-2 mt-md-0 text-center d-flex justify-content-center align-items-center">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <form action="/bank/dashboard/terantar"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="id_transaksi"
                                                                                    value="{{ $transaksi->id }}">
                                                                                <input type="hidden" name="berat"
                                                                                    value="{{ $transaksi->berat }}">
                                                                                @if ($transaksi->diterima == true && $transaksi->terantar == false)
                                                                                    <input type="hidden" name="aksi"
                                                                                        value="terantar">
                                                                                    <button type="submit" id="terantar"
                                                                                        class="btn btn-info btn-block mb-2 terantar">
                                                                                        Terima Pesanan
                                                                                    </button>
                                                                                @endif
                                                                            </form>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <button type="button"
                                                                                class="btn btn-info small mt-2 mt-sm-2 mt-md-0 btn-block informasi"
                                                                                id="informasi"
                                                                                data-id="{{ $transaksi->idPemilik }}"
                                                                                data-jenis="{{ $transaksi->jenisSampah }}"
                                                                                data-bukti="{{ $transaksi->bukti }}"
                                                                                data-banksampah="{{ $transaksi->name }}"
                                                                                data-alamat="{{ $transaksi->alamat }} ({{ $transaksi->catatan }}), {{ $transaksi->kecamatan }}, {{ $transaksi->kota }}, {{ $transaksi->provinsi }}, {{ $transaksi->kodePos }}"
                                                                                data-lang="{{ $transaksi->lang }}"
                                                                                data-long="{{ $transaksi->long }}">Informasi
                                                                                Lainnya</button>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <hr class="mb-4"
                                                                style="background-color: #e0e0e0; opacity: 1;">
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-md-2">
                                                                    <h5 class="text-muted mb-0 mt-0">Track Order</h5>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="progress"
                                                                        style="height: 6px; border-radius: 16px;">
                                                                        <div class="progress-bar" role="progressbar"
                                                                            style="
                                                                @if ($transaksi->diterima == true && $transaksi->terkirim == false) width: 50%;
                                                                @elseif ($transaksi->diterima == true && $transaksi->terkirim == true)
                                                                width: 100%;
                                                                @else
                                                                width: 0%; @endif
                                                                 border-radius: 16px; background-color: #18be55;"
                                                                            aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-around mb-1">
                                                                        <p class="text-muted mt-1 mb-0 small ms-xl-5">
                                                                            Diterima
                                                                        </p>
                                                                        <p class="text-muted mt-1 mb-0 small ms-xl-5">
                                                                            Terkirim
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <nav aria-label="Page navigation" class="pagination-container" id="pagination-1">
                                            <ul class="pagination justify-content-center mt-3">
                                                <li class="page-item" id="prev-page">
                                                    <a class="page-link" href="#" tabindex="-1"
                                                        aria-disabled="true">Previous</a>
                                                </li>
                                                <!-- Page indicators will be dynamically added here -->
                                                <li class="page-item" id="next-page">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header mt-0 pt-0">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <h5 class="mt-0 mb-0 font-14">Riwayat Pesanan</h5>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body pt-4 pb-0">
                                        <div class="card-container-2" id="card-container-2">
                                            @foreach ($kumpulanTransaksi as $transaksi)
                                                @if ($transaksi->terantar == true)
                                                    <div class="card shadow-0 border mb-4">
                                                        <div class="card-body pt-2">
                                                            <div class="row mb-3">
                                                                <div class="col-12 col-sm-10 d-flex align-items-center">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <h4 class="m-0 p-0">Sampah
                                                                                {{ $transaksi->jenisSampah }}
                                                                            </h4>
                                                                            <p class="m-0 p-0">
                                                                                {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d-m-Y') }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-12 col-sm-2 d-flex align-items-center justify-content-end">
                                                                    @if ($transaksi->diterima == false && $transaksi->terantar == false)
                                                                        <span class="badge badge-warning"> &nbsp;Menunggu
                                                                            Respon&nbsp; </span>
                                                                    @endif
                                                                    @if ($transaksi->diterima == true && $transaksi->terantar == false)
                                                                        <span class="badge badge-danger"> &nbsp;Belum
                                                                            Diantar&nbsp; </span>
                                                                    @endif
                                                                    @if ($transaksi->diterima == true && $transaksi->terantar == true)
                                                                        <span class="badge badge-success"> &nbsp;Sudah
                                                                            Diantar&nbsp; </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <h5 class="text-muted mb-0 mt-0 pt-0">
                                                                        {{ $transaksi->name }}</h5>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <h5 class="text-muted mb-0 mt-0 pt-0">
                                                                        {{ $transaksi->nama }}
                                                                    </h5>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <p class="text-muted mb-0 small">
                                                                        {{ $transaksi->nomor }}</p>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <p class="text-muted mb-0 small">
                                                                        <b>Catatan Tambahan : </b><br>
                                                                        @if ($transaksi->catatanTambahan == null)
                                                                            -
                                                                        @else
                                                                            {{ $transaksi->catatanTambahan }}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <p class="text-muted mb-0 small">
                                                                        <b>Berat :</b><br>{{ $transaksi->berat }} Kg
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 mt-3 mt-sm-2 mt-md-0 text-center d-flex justify-content-center align-items-center">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <button type="button"
                                                                                class="btn btn-info small mt-2 mt-sm-2 mt-md-0 btn-block informasi"
                                                                                id="informasi"
                                                                                data-id="{{ $transaksi->idPemilik }}"
                                                                                data-jenis="{{ $transaksi->jenisSampah }}"
                                                                                data-bukti="{{ $transaksi->bukti }}"
                                                                                data-banksampah="{{ $transaksi->name }}"
                                                                                data-alamat="{{ $transaksi->alamat }} ({{ $transaksi->catatan }}), {{ $transaksi->kecamatan }}, {{ $transaksi->kota }}, {{ $transaksi->provinsi }}, {{ $transaksi->kodePos }}"
                                                                                data-lang="{{ $transaksi->lang }}"
                                                                                data-long="{{ $transaksi->long }}">Informasi
                                                                                Lainnya</button>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <hr class="mb-4"
                                                                style="background-color: #e0e0e0; opacity: 1;">
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-md-2">
                                                                    <h5 class="text-muted mb-0 mt-0">Track Order</h5>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="progress"
                                                                        style="height: 6px; border-radius: 16px;">
                                                                        <div class="progress-bar" role="progressbar"
                                                                            style="
                                                        @if ($transaksi->diterima == true && $transaksi->terantar == false) width: 50%;
                                                        @elseif ($transaksi->diterima == true && $transaksi->terantar == true)
                                                        width: 100%;
                                                        @else
                                                        width: 0%; @endif
                                                         border-radius: 16px; background-color: #18be55;"
                                                                            aria-valuemin="0" aria-valuemax="100">
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-around mb-1">
                                                                        <p class="text-muted mt-1 mb-0 small ms-xl-5">
                                                                            Diterima
                                                                        </p>
                                                                        <p class="text-muted mt-1 mb-0 small ms-xl-5">
                                                                            Terkirim
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <nav aria-label="Page navigation" class="pagination-container" id="pagination-2">
                                            <ul class="pagination justify-content-center mt-3">
                                                <li class="page-item" id="prev-page">
                                                    <a class="page-link" href="#" tabindex="-1"
                                                        aria-disabled="true">Previous</a>
                                                </li>
                                                <!-- Page indicators will be dynamically added here -->
                                                <li class="page-item" id="next-page">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script src="/javascript/riwayat-bank.js"></script>
    <script src="/javascript/pagination.js"></script>
@endsection
