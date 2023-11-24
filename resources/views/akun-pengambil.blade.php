@extends('templates.navbar-pengambil')

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
                <li class="breadcrumb-item"><a href="pemilik">Pemilik Sampah</a></li>
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
                                        @if (Auth::check() && Auth::user()->status === 'pemilik')
                                            Pemilik Sampah
                                        @else
                                            Pengambil Sampah
                                        @endif
                                    </p>
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
                            <p class="m-0 p-0">Nama Akun</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->name }}</p>
                        </div>
                    </div>
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
                            <p class="m-0 p-0">Nomor Handphone</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->nomor }}</p>
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
                <input type="hidden" id="nameUser" name="name" value="{{ Auth::user()->name }}">
                <input type="hidden" id="nomor" name="name" value="{{ Auth::user()->nomor }}">
                <input type="hidden" id="nameData" name="name" value="{{ Auth::user()->namaLengkap }}">
                <input type="hidden" id="nomorData" name="nomor" value="{{ Auth::user()->nomor }}">
                <input type="hidden" id="alamatData" name="alamat" value="{{ Auth::user()->alamat }}">
                <input type="hidden" id="kecamatanData" name="kecamatan" value="{{ Auth::user()->kecamatan }}">
                <input type="hidden" id="kotaData" name="kota" value="{{ Auth::user()->kota }}">
                <input type="hidden" id="provinsiData" name="provinsi" value="{{ Auth::user()->provinsi }}">
                <input type="hidden" id="kodeposData" name="kodepos" value="{{ Auth::user()->kodePos }}">
                <input type="hidden" id="catatanData" name="catatan" value="{{ Auth::user()->catatan }}">
                <input type="hidden" id="bank" name="bank" value="{{ Auth::user()->bank }}">
                <input type="hidden" id="atasNamaBank" name="atasNamaBank" value="{{ Auth::user()->atasNamaBank }}">
                <input type="hidden" id="norek" name="norek" value="{{ Auth::user()->norek }}">
                <input type="hidden" id="ewallet" name="ewallet" value="{{ Auth::user()->ewallet }}">
                <input type="hidden" id="namaewallet" name="namaewallet" value="{{ Auth::user()->namaewallet }}">
                <input type="hidden" id="noewallet" name="noewallet" value="{{ Auth::user()->noewallet }}">
                <input type="hidden" id="kapasitas" name="kapasitas" value="{{ Auth::user()->berat }}">
                <input type="hidden" id="authData" name="_token" value="{{ csrf_token() }}">

                <div class="row mt-3">
                    <h5 class="mt-0 mb-0 font-14">Data Pengguna
                        <button class="btn btn-primary float-end edit-btn py-1 px-2" id="editPengguna"><i
                                class="mdi mdi-settings-outline"></i> &nbsp;Edit Data Pengguna</button>
                    </h5>
                    <div class="row ms-2 p-0 my-0 ">
                        <div class="col-3">
                            <p class="m-0 p-0">Nama Lengkap</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->namaLengkap }}</p>
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

                <div class="row mt-3">
                    <h5 class="mt-0 mb-0 font-14">Data Pengambil Sampah
                        <button class="btn btn-primary float-end edit-btn py-1 px-2" id="editPengambil"><i
                                class="mdi mdi-settings-outline"></i> &nbsp;Edit Data Pengambil Sampah</button>
                    </h5>
                    <div class="row ms-2 p-0 my-0 ">
                        <div class="col-3">
                            <p class="m-0 p-0">Berat Angkut</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">:
                                @if (Auth::user()->berat == 'small')
                                    Small (Maks. 4 Kg)
                                @elseif (Auth::user()->berat == 'medium')
                                    Medium (Maks. 20 Kg)
                                @else
                                    Large (Maks. 100 Kg)
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0 ">
                        <div class="col-3">
                            <p class="m-0 p-0">Bank</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->bank }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Atas Nama Rekening</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->atasNamaBank }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Nomor Rekening</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">: {{ Auth::user()->norek }}</p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">E-Wallet</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">:
                                @if (Auth::user()->ewallet == null)
                                    -
                                @else
                                    {{ Auth::user()->ewallet }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Atas Nama E-Wallet</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">:
                                @if (Auth::user()->namaewallet == null)
                                    -
                                @else
                                    {{ Auth::user()->namaewallet }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row ms-2 p-0 my-0">
                        <div class="col-3">
                            <p class="m-0 p-0">Nomor E-Wallet</p>
                        </div>
                        <div class="col-9">
                            <p class="m-0 p-0">:
                                @if (Auth::user()->noewallet == null)
                                    -
                                @else
                                    {{ Auth::user()->noewallet }}
                                @endif
                            </p>
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
    <script src="/javascript/akun-pengambil.js"></script>
@endsection
