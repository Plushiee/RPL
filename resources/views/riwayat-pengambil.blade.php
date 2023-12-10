@extends('templates.navbar-pengambil')

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
                <li class="breadcrumb-item"><a href="/pengambil/dashboard">Pemilik Sampah</a></li>
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
                                                @if ($transaksi->terambil == false && $transaksi->diterima == true)
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
                                                                    @if (!$transaksi->terbayar && !$transaksi->approved)
                                                                        <span class="badge badge-danger"> &nbsp;Belum
                                                                            Terbayar&nbsp; </span>
                                                                    @elseif($transaksi->terbayar && !$transaksi->approved)
                                                                        <span class="badge badge-warning"> &nbsp;Menunggu
                                                                            Konfirmasi&nbsp; </span>
                                                                    @else
                                                                        <span class="badge badge-success">
                                                                            &nbsp;Terbayar&nbsp;
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2 text-center">
                                                                    <img src="\assets\sampah\{{ $transaksi->jenisSampah }}.png"
                                                                        alt="{{ $transaksi->jenisSampah }}.png"
                                                                        width="80" class="img-fluid">
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
                                                                        @if ($transaksi->berat == 'small')
                                                                            Small (Maks. 5 Kg)
                                                                        @elseif ($transaksi->berat == 'medium')
                                                                            Medium (Maks. 20 Kg)
                                                                        @elseif ($transaksi->berat == 'large')
                                                                            Large (Maks. 100 Kg)
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <p class="text-muted mb-0 small">
                                                                        {{ $transaksi->alamat }}
                                                                        ({{ $transaksi->catatan }})
                                                                        , {{ $transaksi->kecamatan }},
                                                                        {{ $transaksi->kota }},
                                                                        {{ $transaksi->provinsi }},
                                                                        {{ $transaksi->kodePos }}</p>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 mt-3 mt-sm-2 mt-md-0 text-center d-flex justify-content-center align-items-center">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <form action="/pengambil/riwayat/terambil"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="id_transaksi"
                                                                                    value="{{ $transaksi->id }}">
                                                                                @if (
                                                                                    $transaksi->diterima == true &&
                                                                                        $transaksi->terbayar == true &&
                                                                                        $transaksi->approved == true &&
                                                                                        $transaksi->terambil == false)
                                                                                    <input type="hidden" name="aksi"
                                                                                        value="terambil">
                                                                                    <button type="submit" id="terambil"
                                                                                        class="btn btn-info btn-block mb-2 approved">
                                                                                        Sampah Terambil
                                                                                    </button>
                                                                                @endif
                                                                            </form>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <button class="btn btn-info btn-block informasi"
                                                                                id="informasi"
                                                                                data-id="{{ $transaksi->idPemilik }}"
                                                                                data-bukti="{{ $transaksi->bukti }}"
                                                                                data-jenis="{{ $transaksi->jenisSampah }}"
                                                                                data-lang="{{ $transaksi->lang }}"
                                                                                data-long="{{ $transaksi->long }}"
                                                                                data-alamat="{{ $transaksi->alamat }}
                                                                ({{ $transaksi->catatan }})
                                                                , {{ $transaksi->kecamatan }},
                                                                {{ $transaksi->kota }}, {{ $transaksi->provinsi }},
                                                                {{ $transaksi->kodePos }}">Informasi
                                                                                Lainnya</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr class="mb-4"
                                                                style="background-color: #e0e0e0; opacity: 1;">
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <h5 class="text-muted mb-0 mt-0">Biaya</h5>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="d-flex justify-content-around mb-1">
                                                                                <p
                                                                                    class="text-muted mt-1 mb-0 pe-3 pe-md-0 small ms-xl-5">
                                                                                    @if ($transaksi->berat == 'small')
                                                                                        Small (Maks. 5 Kg)
                                                                                    @elseif ($transaksi->berat == 'medium')
                                                                                        Medium (Maks. 20 Kg)
                                                                                    @elseif ($transaksi->berat == 'large')
                                                                                        Large (Maks. 100 Kg)
                                                                                    @endif
                                                                                </p>
                                                                                <b>
                                                                                    <h5
                                                                                        class="text-muted mb-0 mt-0 ms-xl-5 text-center">
                                                                                        @if ($transaksi->berat == 'small')
                                                                                            Rp 10.000,00
                                                                                        @elseif($transaksi->berat == 'medium')
                                                                                            Rp 30.000,00
                                                                                        @elseif($transaksi->berat == 'large')
                                                                                            Rp 60.000,00
                                                                                        @endif
                                                                                    </h5>
                                                                                </b>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-2">
                                                                            <h5 class="text-muted mb-0 mt-0">Track Order
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="progress"
                                                                                style="height: 6px; border-radius: 16px;">
                                                                                <div class="progress-bar"
                                                                                    role="progressbar"
                                                                                    style="
                                                                    @if ($transaksi->diterima == true && $transaksi->approved == false && $transaksi->terkirim == false) width: 33.33%;
                                                                    @elseif ($transaksi->diterima == true && $transaksi->approved == true && $transaksi->terkirim == false)
                                                                    width: 66.66%;
                                                                    @elseif ($transaksi->diterima == true && $transaksi->approved == true && $transaksi->terkirim == true)
                                                                    width: 100%;
                                                                    @else
                                                                    width: 0%; @endif
                                                                     border-radius: 16px; background-color: #18be55;"
                                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-around mb-1">
                                                                                <p
                                                                                    class="text-muted mt-1 mb-0 small ms-xl-5">
                                                                                    Diterima</p>
                                                                                <p
                                                                                    class="text-muted mt-1 mb-0 small ms-xl-5">
                                                                                    Approved</p>
                                                                                <p
                                                                                    class="text-muted mt-1 mb-0 small ms-xl-5">
                                                                                    Terambil</p>
                                                                            </div>
                                                                        </div>
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
                                                @if ($transaksi->terambil == true)
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
                                                                    @if (!$transaksi->terbayar && !$transaksi->approved)
                                                                        <span class="badge badge-danger"> &nbsp;Belum
                                                                            Terbayar&nbsp; </span>
                                                                    @elseif($transaksi->terbayar && !$transaksi->approved)
                                                                        <span class="badge badge-warning"> &nbsp;Menunggu
                                                                            Konfirmasi&nbsp; </span>
                                                                    @else
                                                                        <span class="badge badge-success">
                                                                            &nbsp;Terbayar&nbsp;
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2 text-center">
                                                                    <img src="\assets\sampah\{{ $transaksi->jenisSampah }}.png"
                                                                        alt="{{ $transaksi->jenisSampah }}.png"
                                                                        width="80" class="img-fluid">
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
                                                                        {{ $transaksi->nomor }}
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <p class="text-muted mb-0 small">
                                                                        @if ($transaksi->berat == 'small')
                                                                            Small (Maks. 5 Kg)
                                                                        @elseif ($transaksi->berat == 'medium')
                                                                            Medium (Maks. 20 Kg)
                                                                        @elseif ($transaksi->berat == 'large')
                                                                            Large (Maks. 100 Kg)
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                                    <p class="text-muted mb-0 small">
                                                                        {{ $transaksi->alamat }}
                                                                        ({{ $transaksi->catatan }})
                                                                        , {{ $transaksi->kecamatan }},
                                                                        {{ $transaksi->kota }},
                                                                        {{ $transaksi->provinsi }},
                                                                        {{ $transaksi->kodePos }}</p>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 mt-3 mt-sm-2 mt-md-0 text-center d-flex justify-content-center align-items-center">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <form action="/pengambil/dashboard/ambil"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="id_transaksi"
                                                                                    value="{{ $transaksi->id }}">
                                                                                @if (
                                                                                    $transaksi->diterima == false &&
                                                                                        $transaksi->terbayar == false &&
                                                                                        $transaksi->approved == false &&
                                                                                        $transaksi->terambil == false)
                                                                                    <input type="hidden" name="aksi"
                                                                                        value="diterima">
                                                                                    <button type="submit" id="terima"
                                                                                        class="btn btn-info btn-block mb-2 terima">
                                                                                        Terima Pesanan
                                                                                    </button>
                                                                                @elseif (
                                                                                    $transaksi->diterima == true &&
                                                                                        $transaksi->terbayar == true &&
                                                                                        $transaksi->approved == true &&
                                                                                        $transaksi->terambil == false)
                                                                                    <button type="submit" id="approved"
                                                                                        class="btn btn-info btn-block mb-2 approved">
                                                                                        Sampah Terambil
                                                                                    </button>
                                                                                @endif
                                                                            </form>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <button
                                                                                class="btn btn-info btn-block informasi"
                                                                                id="informasi"
                                                                                data-id="{{ $transaksi->idPemilik }}"
                                                                                data-bukti="{{ $transaksi->bukti }}"
                                                                                data-jenis="{{ $transaksi->jenisSampah }}"
                                                                                data-lang="{{ $transaksi->lang }}"
                                                                                data-long="{{ $transaksi->long }}"
                                                                                data-alamat="{{ $transaksi->alamat }}
                                                            ({{ $transaksi->catatan }})
                                                            , {{ $transaksi->kecamatan }},
                                                            {{ $transaksi->kota }}, {{ $transaksi->provinsi }},
                                                            {{ $transaksi->kodePos }}">Informasi
                                                                                Lainnya</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr class="mb-4"
                                                                style="background-color: #e0e0e0; opacity: 1;">
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-md-2">
                                                                            <h5 class="text-muted mb-0 mt-0">Biaya</h5>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div
                                                                                class="d-flex justify-content-around mb-1">
                                                                                <p
                                                                                    class="text-muted mt-1 mb-0 pe-3 pe-md-0 small ms-xl-5">
                                                                                    @if ($transaksi->berat == 'small')
                                                                                        Small (Maks. 5 Kg)
                                                                                    @elseif ($transaksi->berat == 'medium')
                                                                                        Medium (Maks. 20 Kg)
                                                                                    @elseif ($transaksi->berat == 'large')
                                                                                        Large (Maks. 100 Kg)
                                                                                    @endif
                                                                                </p>
                                                                                <b>
                                                                                    <h5
                                                                                        class="text-muted mb-0 mt-0 ms-xl-5 text-center">
                                                                                        @if ($transaksi->berat == 'small')
                                                                                            Rp 10.000,00
                                                                                        @elseif($transaksi->berat == 'medium')
                                                                                            Rp 30.000,00
                                                                                        @elseif($transaksi->berat == 'large')
                                                                                            Rp 60.000,00
                                                                                        @endif
                                                                                    </h5>
                                                                                </b>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-2">
                                                                            <h5 class="text-muted mb-0 mt-0">Track Order
                                                                            </h5>
                                                                        </div>
                                                                        <div class="col-md-10">
                                                                            <div class="progress"
                                                                                style="height: 6px; border-radius: 16px;">
                                                                                <div class="progress-bar"
                                                                                    role="progressbar"
                                                                                    style="
                                                                @if ($transaksi->diterima == true && $transaksi->approved == false && $transaksi->terambil == false) width: 33.33%;
                                                                @elseif ($transaksi->diterima == true && $transaksi->approved == true && $transaksi->terambil == false)
                                                                width: 66.66%;
                                                                @elseif ($transaksi->diterima == true && $transaksi->approved == true && $transaksi->terambil == true)
                                                                width: 100%;
                                                                @else
                                                                width: 0%; @endif
                                                                 border-radius: 16px; background-color: #18be55;"
                                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-around mb-1">
                                                                                <p
                                                                                    class="text-muted mt-1 mb-0 small ms-xl-5">
                                                                                    Diterima</p>
                                                                                <p
                                                                                    class="text-muted mt-1 mb-0 small ms-xl-5">
                                                                                    Approved</p>
                                                                                <p
                                                                                    class="text-muted mt-1 mb-0 small ms-xl-5">
                                                                                    Terambil</p>
                                                                            </div>
                                                                        </div>
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
    <script src="/javascript/riwayat-pengambil.js"></script>
    <script src="/javascript/pagination.js"></script>
@endsection
