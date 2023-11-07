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
                <li class="breadcrumb-item"><a href="/pemilik/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ambil di Rumah</li>
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
                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box widget-inline pt-1" style="border: none !important">
                            <h5 class="mt-0 font-14">Jenis Sampah dan Kuantitas</h5>
                            <div class="row g-md-4 g-sm-4 g-1">
                                <div class="col-xl-2 col-sm-6 d-grid widget-inline-box text-center">
                                    <button class="btn btn-outline-dark btn-block mt-3 mt-sm-0 p-3 organik" type="button"
                                        style="font-size: 18px; font-weight: bold"><img src="\assets\sampah\stink.png"
                                            alt="organik.png" width="96"><br>Organik</button>
                                </div>

                                <div class="col-xl-2 col-sm-6 d-grid widget-inline-box text-center kertas">
                                    <button class="btn btn-outline-dark btn-block mt-3 mt-sm-0 p-3" type="button"
                                        style="font-size: 18px; font-weight: bold"><img src="\assets\sampah\paper.png"
                                            alt="kertas.png" width="96"><br>Kertas</button>
                                </div>
                                <div class="col-xl-2 col-sm-6 d-grid widget-inline-box text-center plastik">
                                    <a href="dashboard/ambil">
                                        <button class="btn btn-outline-dark btn-block mt-3 mt-sm-0 p-3" type="button"
                                            style="font-size: 18px; font-weight: bold"><img
                                                src="\assets\sampah\recycling-box.png" alt="plastik.png"
                                                width="96"><br>Plastik</button>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-sm-6 d-grid widget-inline-box text-center kaca">
                                    <button class="btn btn-outline-dark btn-block mt-3 mt-sm-0 p-3" type="button"
                                        style="font-size: 18px; font-weight: bold"><img src="\assets\sampah\glass.png"
                                            alt="kaca.png" width="96"><br>Kaca</button>
                                </div>
                                <div class="col-xl-2 col-sm-6 d-grid widget-inline-box text-center logam">
                                    <a href="dashboard/ambil">
                                        <button class="btn btn-outline-dark btn-block mt-3 mt-sm-0 p-3" type="button"
                                            style="font-size: 18px; font-weight: bold"><img src="\assets\sampah\metal.png"
                                                alt="logam.png" width="96"><br>Logam</button>
                                    </a>
                                </div>

                                <div class="col-xl-2 col-sm-6 d-grid widget-inline-box text-center lainnya"
                                    style="border: none !important;">
                                    <button class="btn btn-outline-dark btn-block mt-3 mt-sm-0 p-3" type="button"
                                        style="font-size: 18px; font-weight: bold"><img src="\assets\sampah\trash-can.png"
                                            alt="lainnya.png" width="96"><br>Lainnya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card-box">
                            <h5 class="mt-0 font-14">Peta</h5>
                            <div class="row m-0 p-0 border">
                                <div id="map" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-3">
                        <div class="card-box">
                            <h5 class="mt-0 font-14">Pengumuman</h5>
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne" aria-expanded="false"
                                            aria-controls="flush-collapseOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to demonstrate the <code>.accordion-flush</code> class. This is the
                                            first item's accordion body.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                            aria-controls="flush-collapseTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to demonstrate the <code>.accordion-flush</code> class. This is the
                                            second item's accordion body. Let's imagine this being filled with some actual
                                            content.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                            aria-expanded="false" aria-controls="flush-collapseThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is
                                            intended to demonstrate the <code>.accordion-flush</code> class. This is the
                                            third item's accordion body. Nothing more exciting happening here in terms of
                                            content, but just filling up the space to make it look, at least at first
                                            glance, a bit more representative of how this would look in a real-world
                                            application.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

    {{-- </div> --}}
    <!-- END content-page -->
@endsection

@section('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRPlQuuQmmWWhwkDiUijv6F6deBOflQhk&callback=initMap&libraries=places">
    </script>
    <script src="/javascript/gps-map.js"></script>
    <script>
        $(document).ready(function() {
            $('.organik').click(function(e) {
                e.preventDefault();

                // Inisialisasi variabel alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue
                let alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue;

                Swal.fire({
                    title: "Buat Pesanan Pengambilan Sampah Organik",
                    html: `
                    <form action="php/proses-tambah_Nikolaus-Pastika-Bara-Satyaradi.php" method="POST" id="orderForm">
                        <div class="mb-3">
                            <input class="form-control" type="text" name="nama" placeholder="Nama Pemilik Sampah" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" name="nomor" placeholder="Nomor Handphone (+62xxx)" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="alamat" class="form-label">Alamat Pengambilan</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" name="kecamatan" placeholder="Kecamatan" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" name="kota" placeholder="Kota atau Kabupaten" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" name="provinsi" placeholder="Provinsi" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="number" name="kodePos" placeholder="Kode Pos" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="catatan" class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="berat" required>
                                <option value="" disabled selected>Pilih Berat</option>
                                <option value="small">Small (Maks. 5 kg)</option>
                                <option value="medium">Medium (Maks. 20 kg)</option>
                                <option value="large">Large (Maks. 100 kg)</option>
                            </select>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="bukti" class="form-label">Bukti Barang</label>
                            <input class="form-control" type="file" name="bukti" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <p class="form-label" style="font-size:12;"> <input class="form-check-input" type="checkbox" id="useAuthData" name="useAuthData"> Isi data dengan informasi saya</p>
                        </div>
                    </form>`,
                    showCancelButton: true,
                    confirmButtonText: "Selanjutnya",
                    cancelButtonText: "Tutup",
                    focusConfirm: false,
                    showLoaderOnConfirm: true,
                    didOpen: () => {
                        const useAuthDataCheckbox = Swal.getPopup().querySelector(
                            "#useAuthData");
                        const orderForm = Swal.getPopup().querySelector("#orderForm");
                        $(useAuthDataCheckbox).on("change", function() {
                            if (useAuthDataCheckbox.checked) {
                                Swal.getPopup().querySelector("input[name='nama']")
                                    .value = '{{ Auth::user()->name }}';
                                Swal.getPopup().querySelector("input[name='nama']")
                                    .disabled = true;
                                Swal.getPopup().querySelector("input[name='nomor']")
                                    .value = '{{ Auth::user()->nomor }}';
                                Swal.getPopup().querySelector("input[name='nomor']")
                                    .disabled = true;
                                Swal.getPopup().querySelector("textarea[name='alamat']")
                                    .value = '{{ Auth::user()->alamat }}';
                                Swal.getPopup().querySelector("textarea[name='alamat']")
                                    .disabled = true;
                                Swal.getPopup().querySelector("input[name='kecamatan']")
                                    .value = '{{ Auth::user()->kecamatan }}';
                                Swal.getPopup().querySelector("input[name='kecamatan']")
                                    .disabled = true;
                                Swal.getPopup().querySelector("input[name='kota']")
                                    .value = '{{ Auth::user()->kota }}';
                                Swal.getPopup().querySelector("input[name='kota']")
                                    .disabled = true;
                                Swal.getPopup().querySelector("input[name='provinsi']")
                                    .value = '{{ Auth::user()->provinsi }}';
                                Swal.getPopup().querySelector("input[name='provinsi']")
                                    .disabled = true;
                                Swal.getPopup().querySelector("input[name='kodePos']")
                                    .value = '{{ Auth::user()->kodePos }}';
                                Swal.getPopup().querySelector("input[name='kodePos']")
                                    .disabled = true;
                                Swal.getPopup().querySelector(
                                        "textarea[name='catatan']")
                                    .value = '{{ Auth::user()->alamat }}';
                                Swal.getPopup().querySelector(
                                        "textarea[name='catatan']")
                                    .disabled = true;
                            } else {
                                // Kosongkan input jika checkbox tidak dicentang
                                Swal.getPopup().querySelector("input[name='nama']")
                                    .value = "";
                                Swal.getPopup().querySelector("input[name='nama']")
                                    .disabled = false;
                                Swal.getPopup().querySelector("input[name='nomor']")
                                    .value = "";
                                Swal.getPopup().querySelector("input[name='nomor']")
                                    .disabled = false;
                                Swal.getPopup().querySelector("textarea[name='alamat']")
                                    .value = "";
                                Swal.getPopup().querySelector("textarea[name='alamat']")
                                    .disabled = false;
                                Swal.getPopup().querySelector("input[name='kecamatan']")
                                    .value = "";
                                Swal.getPopup().querySelector("input[name='kecamatan']")
                                    .disabled = false;
                                Swal.getPopup().querySelector("input[name='kota']")
                                    .value = "";
                                Swal.getPopup().querySelector("input[name='kota']")
                                    .disabled = false;
                                Swal.getPopup().querySelector("input[name='provinsi']")
                                    .value = "";
                                Swal.getPopup().querySelector("input[name='provinsi']")
                                    .disabled = false;
                                Swal.getPopup().querySelector("input[name='kodePos']")
                                    .value = "";
                                Swal.getPopup().querySelector("input[name='kodePos']")
                                    .disabled = false;
                                Swal.getPopup().querySelector(
                                        "textarea[name='catatan']")
                                    .value = "";
                                Swal.getPopup().querySelector(
                                        "textarea[name='catatan']")
                                    .disabled = false;
                            }
                        });
                    },
                    preConfirm: () => {
                        const nama = Swal.getPopup().querySelector("input[name='nama']")
                            .value;
                        const nomor = Swal.getPopup().querySelector("input[name='nomor']")
                            .value;
                        alamatValue = Swal.getPopup().querySelector("textarea[name='alamat']")
                            .value;
                        kecamatanValue = Swal.getPopup().querySelector(
                            "input[name='kecamatan']").value;
                        kotaValue = Swal.getPopup().querySelector("input[name='kota']").value;
                        provinsiValue = Swal.getPopup().querySelector("input[name='provinsi']")
                            .value;
                        kodePosValue = Swal.getPopup().querySelector("input[name='kodePos']")
                            .value;
                        const catatan = Swal.getPopup().querySelector("textarea[name='catatan']")
                            .value;
                        const berat = Swal.getPopup().querySelector("select[name='berat']")
                            .value;

                        if (!nama || !nomor || !alamatValue || !kecamatanValue || !kotaValue ||
                            !
                            provinsiValue || !kodePosValue || !berat) {
                            Swal.showValidationMessage("Semua Kolom Harus Terisi!");
                        }

                        const formData = new FormData(orderForm);
                        formData.append('nama', nama);
                        formData.append('nomor', nomor);
                        formData.append('alamat', alamatValue);
                        formData.append('kecamatan', kecamatanValue);
                        formData.append('kota', kotaValue);
                        formData.append('provinsi', provinsiValue);
                        formData.append('kodePos', kodePosValue);
                        formData.append('catatan', catatan);
                        formData.append('berat', berat);
                        return formData;
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Peta Lokasi",
                            html: `
                                <div id="mapSwoll" style="height: 400px;"></div>`,
                            showCancelButton: true,
                            confirmButtonText: "Simpan",
                            cancelButtonText: "Tutup",
                            didOpen: () => {
                                const map = new google.maps.Map(document.getElementById(
                                    "mapSwoll"), {
                                    center: {
                                        lat: -7.7956,
                                        lng: 110.3695
                                    },
                                    zoom: 20,
                                });

                                const geocoder = new google.maps.Geocoder();
                                const fullAddress =
                                    `${alamatValue}, ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;

                                geocoder.geocode({
                                    address: fullAddress
                                }, (results, status) => {
                                    if (status === "OK" && results.length > 0) {
                                        const location = results[0].geometry
                                            .location;
                                        map.setCenter(location);

                                        const marker = new google.maps.Marker({
                                            map,
                                            position: location,
                                            draggable: true
                                        });

                                        Swal.getConfirmButton()
                                            .addEventListener('click',
                                                function() {
                                                    const longitude = marker
                                                        .getPosition().lng();
                                                    const latitude = marker
                                                        .getPosition().lat();

                                                    result.value.append(
                                                        'long',
                                                        longitude);
                                                    result.value.append(
                                                        'lang', latitude
                                                    );
                                                    result.value.append(
                                                        '_token',
                                                        '{{ csrf_token() }}'
                                                        );
                                                    $.ajax({
                                                        url: '/pemilik/dashboard/ambil/simpan/organik',
                                                        type: 'POST',
                                                        data: result
                                                            .value,
                                                        processData: false,
                                                        contentType: false,
                                                        success: function(
                                                            response
                                                        ) {
                                                            console
                                                                .log(
                                                                    response
                                                                );
                                                        },
                                                        error: function(
                                                            error) {
                                                            console
                                                                .error(
                                                                    error
                                                                );
                                                        }
                                                    });
                                                });
                                    }
                                });
                            },
                        });
                    }
                });
            });
        });
    </script>
@endsection
