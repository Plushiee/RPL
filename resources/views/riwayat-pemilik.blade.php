@extends('templates.navbar-pemilik')

@section('title', 'MoneyTrash! - Dashboard')
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
                        <h5 class="mt-0 font-14">Riwayat Pesanan</h5>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header mt-0 pt-0">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Diambil Di Rumah
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body pt-4 pb-0">
                                        @foreach ($kumpulanTransaksi as $transaksi)
                                            <div class="card shadow-0 border mb-4">
                                                <div class="card-body pt-2">
                                                    <div class="row mb-3">
                                                        <div class="col-12 col-sm-10 d-flex align-items-center">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <h4 class="m-0 p-0">Sampah {{ $transaksi->jenisSampah }}
                                                                    </h4>
                                                                    <p class="m-0 p-0">
                                                                        {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d-m-Y') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="col-12 col-sm-2 d-flex align-items-center justify-content-end">
                                                            @if (!$transaksi->terbayar)
                                                                <span class="badge badge-warning"> &nbsp;Belum
                                                                    Terbayar&nbsp; </span>
                                                            @else
                                                                <span class="badge badge-warning"> &nbsp;Sudah
                                                                    Terbayar&nbsp; </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2 text-center">
                                                            <img src="\assets\sampah\{{ $transaksi->jenisSampah }}.png"
                                                                alt="{{ $transaksi->jenisSampah }}.png" width="80"
                                                                class="img-fluid">
                                                        </div>
                                                        <div
                                                            class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                            <h5 class="text-muted mb-0 mt-0 pt-0">{{ $transaksi->nama }}
                                                            </h5>
                                                        </div>
                                                        <div
                                                            class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                            <p class="text-muted mb-0 small">{{ $transaksi->nomor }}</p>
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
                                                            <p class="text-muted mb-0 small">{{ $transaksi->alamat }}
                                                                ({{ $transaksi->catatan }})
                                                                , {{ $transaksi->kecamatan }},
                                                                {{ $transaksi->kota }}, {{ $transaksi->provinsi }},
                                                                {{ $transaksi->kodePos }}</p>
                                                        </div>
                                                        <div
                                                            class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                            <button type="button" class="btn btn-info small mt-2 mt-sm-2 mt-md-0" id="bukti" data-id="{{ $transaksi->idPemilik }}" data-bukti="{{ $transaksi->bukti }}" data-jenis="{{ $transaksi->jenisSampah }}">Tampilkan
                                                                Bukti Barang</button>
                                                        </div>
                                                    </div>
                                                    <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col-md-2">
                                                            <h5 class="text-muted mb-0 mt-0">Track Order</h5>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="progress" style="height: 6px; border-radius: 16px;">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="
                                                                    @if ($transaksi->approved === true && $transaksi->terambil === false) width: 50%;
                                                                    @elseif ($transaksi->approved === true && $transaksi->terambil === true)
                                                                    width: 100%;
                                                                    @else
                                                                    width: 0%; @endif
                                                                     border-radius: 16px; background-color: #18be55;"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-around mb-1">
                                                                <p class="text-muted mt-1 mb-0 small ms-xl-5">Approved</p>
                                                                <p class="text-muted mt-1 mb-0 small ms-xl-5">Diambil</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header mt-0 pt-0">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Antar Sendiri
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                        until the collapse plugin adds the appropriate classes that we use to style each
                                        element. These classes control the overall appearance, as well as the showing and
                                        hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                        our default variables. It's also worth noting that just about any HTML can go within
                                        the <code>.accordion-body</code>, though the transition does limit overflow.
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
    <script src="/javascript/riwayat-pemilik.js"></script>

@endsection
