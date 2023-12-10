@extends('templates.navbar-pengambil')

@section('title', 'MoneyTrash! - Pembayaran')
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
                <li class="breadcrumb-item"><a href="/pengambil/dashboard">Pengambil Sampah</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
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
                                        <h5 class="mt-0 mb-0 font-14">Pembayaran Aktif</h5>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body pt-4 pb-0">
                                        <div class="card-container-1" id="card-container-1">
                                            @foreach ($kumpulanTransaksi as $transaksi)
                                                @if ($transaksi->approved == false)
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
                                                                        <input type="hidden" name="csrf" id="csrf"
                                                                            value="{{ csrf_token() }}">
                                                                        <input type="hidden" name="id_transaksi"
                                                                            id="id_transaksi" value="{{ $transaksi->id }}">
                                                                        <input type="hidden" name="aksi"
                                                                            value="diterima">
                                                                        <div class="col-md-12">
                                                                            <button
                                                                                class="btn btn-info btn-block @if ($transaksi->terbayar == true && $transaksi->approved == false) setuju
                                                                        @else
                                                                            lihat @endif"
                                                                                data-id="{{ $transaksi->idPemilik }}"
                                                                                data-bukti="{{ $transaksi->buktibayar }}">Tampilkan
                                                                                Bukti</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr class="mb-4"
                                                                style="background-color: #e0e0e0; opacity: 1;">
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-md-2">
                                                                    <h5 class="text-muted mb-0 mt-0">Biaya</h5>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="d-flex justify-content-around mb-1">
                                                                        <p class="text-muted mt-1 mb-0 small ms-xl-5">
                                                                            @if ($transaksi->berat == 'small')
                                                                                Small (Maks. 5 Kg)
                                                                            @elseif ($transaksi->berat == 'medium')
                                                                                Medium (Maks. 20 Kg)
                                                                            @elseif ($transaksi->berat == 'large')
                                                                                Large (Maks. 100 Kg)
                                                                            @endif
                                                                        </p>
                                                                        <h5 class="text-muted mb-0 mt-0 ms-xl-5">
                                                                            @if ($transaksi->berat == 'small')
                                                                                Rp 10.000,00
                                                                            @elseif ($transaksi->berat == 'medium')
                                                                                Rp 30.000,00
                                                                            @elseif ($transaksi->berat == 'large')
                                                                                Rp 60.000,00
                                                                            @endif
                                                                        </h5>
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
                                        <h5 class="mt-0 mb-0 font-14">Riwayat Pembayaran</h5>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body pt-4 pb-0">
                                        <div class="card-container-2" id="card-container-2">
                                            @foreach ($kumpulanTransaksi as $transaksi)
                                                @if ($transaksi->approved == true)
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
                                                                        <div class="col-md-12"></div>
                                                                        <div class="col-md-12">
                                                                            <button class="btn btn-info btn-block lihat"
                                                                                data-id="{{ $transaksi->idPemilik }}"
                                                                                data-bukti="{{ $transaksi->buktibayar }}">Tampilkan
                                                                                Bukti</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr class="mb-4"
                                                                style="background-color: #e0e0e0; opacity: 1;">
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-md-2">
                                                                    <h5 class="text-muted mb-0 mt-0">Biaya</h5>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="d-flex justify-content-around mb-1">
                                                                        <p class="text-muted mt-1 mb-0 small ms-xl-5">
                                                                            @if ($transaksi->berat == 'small')
                                                                                Small (Maks. 5 Kg)
                                                                            @elseif ($transaksi->berat == 'medium')
                                                                                Medium (Maks. 20 Kg)
                                                                            @elseif ($transaksi->berat == 'large')
                                                                                Large (Maks. 100 Kg)
                                                                            @endif
                                                                        </p>
                                                                        <h5 class="text-muted mb-0 mt-0 ms-xl-5">
                                                                            @if ($transaksi->berat == 'small')
                                                                                Rp 10.000,00
                                                                            @elseif ($transaksi->berat == 'medium')
                                                                                Rp 30.000,00
                                                                            @elseif ($transaksi->berat == 'large')
                                                                                Rp 60.000,00
                                                                            @endif
                                                                        </h5>
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
    <script src="/javascript/pembayaran-pengambil.js"></script>
    <script src="/javascript/pagination.js"></script>
    @if (session('berhasil'))
        <script>
            $(document).ready(function() {
                // Alert
                var toastMixin = Swal.mixin({
                    toast: true,
                    icon: 'success',
                    title: 'General Title',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                toastMixin.fire({
                    animation: true,
                    title: 'Data Pembayaran Berhasil Ditambahkan'
                });
            });
        </script>
    @endif
    @if (session('gagal'))
        <script>
            $(document).ready(function() {
                // Alert
                var toastMixin = Swal.mixin({
                    toast: true,
                    icon: 'error',
                    title: 'General Title',
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                toastMixin.fire({
                    animation: true,
                    title: 'Data Pembayaran Tidak Berhasil Ditambahkan, Cek Kembali File!'
                });
            });
        </script>
    @endif
@endsection
