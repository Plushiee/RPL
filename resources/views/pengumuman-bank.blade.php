@extends('templates.navbar-bank')

@section('title', 'MoneyTrash! - Pengumuman')
@section('css')
    <link rel="stylesheet" href="/assets/styles/dashboard-pengambil.css">
@endsection

@section('contents')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <!-- Start Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent !important">
                <li class="breadcrumb-item"><a href="bank">Bank Sampah</a></li>
                <li class="breadcrumb-item"><a href="/bank/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
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
                                , {{ Auth::user()->name }}</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="card">
                            <div class="card-body shadow">
                                <h1 class="card-title mt-2">Pengumuman Pengambil Sampah</h1>
                                <p class="card-text">Pengumuman akan dikirimkan kepada seluruh pemilik sampah yang anda
                                    terima pesanannya. Maksimal pengumuman aktif sebanyak
                                    <b>{{ $hitungPengumumanAktif }}</b>/5 Pengumuman
                                </p>
                                <button class="btn btn-primary btn-block buatPengumuman  @if ($hitungPengumumanAktif > 4) disabled @endif"
                                    id="buatPengumuman">Buat
                                    Pengumuman</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8">
                        <!-- Cards go here -->
                        <div class="card-container">
                            <!-- Card Mulai -->
                            @foreach ($daftarPengumuman as $pengumuman)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card" style="width: 100%;">
                                            <div class="card-body rounded shadow">
                                                <div class="row mb-2">
                                                    <div class="col-2 col-sm-1">
                                                        @if ($pengumuman->aktif == true)
                                                            <img src="/assets/images/warning.png" alt="warning.png"
                                                                width ="40">
                                                        @else
                                                            <img src="/assets/images/ok.webp" alt="Ok.png" width ="40">
                                                        @endif
                                                    </div>
                                                    <div class="col-10 col-sm-11">
                                                        <h1 class="card-title m-0 p-0">
                                                            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->locale('id')->isoFormat('dddd') }}
                                                            @if ($pengumuman->aktif == true)
                                                                <button type="submit"
                                                                    class="btn btn-outline-warning float-end edit"
                                                                    data-id="{{ $pengumuman->id }}"
                                                                    data-judulPengumuman="{{ $pengumuman->judulPengumuman }}"
                                                                    data-isiPengumuman="{{ $pengumuman->isiPengumuman }}"
                                                                    data-tanggal="{{ $pengumuman->tanggal }}"><i
                                                                        class="bi bi-gear"></i></button>
                                                            @endif
                                                            <br>
                                                            {{ \Carbon\Carbon::parse($pengumuman->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
                                                        </h1>
                                                    </div>
                                                </div>
                                                <p class="card-text text-muted mb-0 pb-0">Judul Pengumuman</p>
                                                <p class="card-text">{{ $pengumuman->judulPengumuman }}</p>
                                                <p class="card-text text-muted mb-0 pb-0">Isi Pengumuman</p>
                                                <p class="card-text">{{ $pengumuman->isiPengumuman }}</p>

                                                @if ($pengumuman->aktif == true)
                                                    <form action="/pengambil/dashboard/pengumuman/selesai" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $pengumuman->id }}">
                                                        <button type="submit" class="btn btn-success float-end">
                                                            Pengumuman Selesai</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Card Selesai -->

                        </div>

                        <!-- Pagination -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mt-3">
                                <li class="page-item" id="prev-page">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <!-- Page indicators will be dynamically added here -->
                                <li class="page-item" id="next-page">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            <div id="authData" data-csrf="{{ csrf_token() }}"></div>
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
    <script src="/javascript/pengumuman-bank.js"></script>

    @if (session('successSelesai'))
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
                    title: 'Pengumuman Berhasil Dinon-Aktifkan'
                });
            });
        </script>
    @endif

    @if (session('successEdit'))
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
                    title: 'Pengumuman Berhasil Diedit'
                });
            });
        </script>
    @endif

    @if (session('successBuat'))
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
                    title: 'Pengumuman Berhasil Dibuat'
                });
            });
        </script>
    @endif
@endsection
