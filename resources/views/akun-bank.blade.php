@extends('templates.navbar-bank')

@section('title', 'MoneyTrash! - Akun')
@section('css')
    <link rel="stylesheet" href="/assets/styles/akun-pengguna.css">
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
                <li class="breadcrumb-item active" aria-current="page">Akun</li>
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
                    <div class="col-12 info">
                        <div class="row header-title">
                            <div class="col-4">
                                <img src="/assets/images/users/user-default.webp" width="128px" alt=""
                                    class="rounded-circle d-none d-sm-block">
                                <img src="/assets/images/users/user-default.webp" width="74px" alt=""
                                    class="rounded-circle d-block d-sm-none">
                            </div>
                            <div class="col-8">
                                <div class="user-info align-items-center">
                                    <a href="#" style="font-weight: bold; color: black">{{ Auth::user()->name }}</a>
                                    <p class="text-muted m-0">
                                        Bank Sampah
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <h5 class="mt-0 mb-0 font-14">Data Akun
                        <button class="btn btn-primary float-end edit-btn py-1 px-2" id="editAkun"><i
                                class="mdi mdi-settings-outline"></i> &nbsp;Edit Data Akun</button>
                    </h5>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">E-mail</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Status Verifikasi</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: <span style="color: red;"><i class="bi bi-ban"></i>&nbsp; Belum
                                    Terverivikasi! </span> <a href="">&nbsp;&nbsp; Verifikasi Sekarang!</a></p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Password</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: ***********</p>
                        </div>
                    </div>
                </div>

                {{-- <div id="authData" data-csrf="{{ csrf_token() }}"></div> --}}
                <input type="hidden" id="namaBank" name="name" value="{{ Auth::user()->name }}">
                <input type="hidden" id="nomor" name="name" value="{{ Auth::user()->nomor }}">
                <input type="hidden" id="nomorData" name="nomor" value="{{ Auth::user()->nomor }}">
                <input type="hidden" id="alamatData" name="alamat" value="{{ Auth::user()->alamat }}">
                <input type="hidden" id="kecamatanData" name="kecamatan" value="{{ Auth::user()->kecamatan }}">
                <input type="hidden" id="kotaData" name="kota" value="{{ Auth::user()->kota }}">
                <input type="hidden" id="provinsiData" name="provinsi" value="{{ Auth::user()->provinsi }}">
                <input type="hidden" id="kodeposData" name="kodepos" value="{{ Auth::user()->kodePos }}">
                <input type="hidden" id="catatanData" name="catatan" value="{{ Auth::user()->catatan }}">
                <input type="hidden" id="kapasitas" name="kapasitas" value="{{ Auth::user()->kapasitas }}">
                <input type="hidden" id="authData" name="_token" value="{{ csrf_token() }}">

                <div class="row mt-3">
                    <h5 class="mt-0 mb-0 font-14">Data Bank Sampah
                        <button class="btn btn-primary float-end edit-btn py-1 px-2" id="editBank"><i
                                class="mdi mdi-settings-outline"></i> &nbsp;Edit Bank</button>
                    </h5>
                    <div class="row ms-2 p-0 my-0 ">
                        <div class="col-3">
                            <p class="m-0 p-0">Nama Bank</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Nomor Handphone</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->nomor }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0 ">
                        <div class="col-3">
                            <p class="m-0 p-0">Kapasitas</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">:
                                {{ Auth::user()->kapasitas }} Kg
                            </p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Alamat Lengkap</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->alamat }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Kecamatan</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->kecamatan }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Kota</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->kota }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Provinsi</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->provinsi }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Kode Pos</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->kodePos }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Catatan Tambahan Alamat</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->catatan }}</p>
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
    <script src="/javascript/akun-bank.js"></script>
@endsection
