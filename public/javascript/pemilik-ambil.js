$(document).ready(function () {

    const authData = document.getElementById('authData');
    const nama = authData.getAttribute('data-name');
    const nomor = authData.getAttribute('data-nomor');
    const alamat = authData.getAttribute('data-alamat');
    const kecamatan = authData.getAttribute('data-kecamatan');
    const kota = authData.getAttribute('data-kota');
    const provinsi = authData.getAttribute('data-provinsi');
    const kodePos = authData.getAttribute('data-kodepos');
    const catatan = authData.getAttribute('data-catatan');
    const csrf = authData.getAttribute('data-csrf');

    // Start Organik
    $('.organik').click(function (e) {
        e.preventDefault();

        // Inisialisasi variabel alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue
        let alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue, catatanValue;

        Swal.fire({
            title: "Buat Pesanan Pengambilan Sampah Organik",
            html: `
                    <form action="" method="POST" id="orderForm">
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
                            <label for="catatan" class="form-label">Catatan Alamat Tambahan</label>
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
                $(useAuthDataCheckbox).on("change", function () {
                    if (useAuthDataCheckbox.checked) {
                        Swal.getPopup().querySelector("input[name='nama']")
                            .value = nama;
                        Swal.getPopup().querySelector("input[name='nama']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .value = nomor;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .disabled = true;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .value = alamat;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .value = kecamatan;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .value = kota;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .value = provinsi;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .value = kodePos;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .disabled = true;
                        Swal.getPopup().querySelector(
                            "textarea[name='catatan']")
                            .value = catatan;
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
                catatanValue = Swal.getPopup().querySelector("textarea[name='catatan']")
                    .value;
                const berat = Swal.getPopup().querySelector("select[name='berat']")
                    .value;

                if (!nama || !nomor || !alamatValue || !kecamatanValue || !kotaValue ||
                    !provinsiValue || !kodePosValue || !berat) {
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
                formData.append('catatan', catatanValue);
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
                        let fullAddress = "";
                        if (catatanValue) {
                            fullAddress =
                                `${alamatValue} (${catatanValue}), ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;
                        } else {
                            fullAddress =
                                `${alamatValue}, ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;
                        }

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
                                        function () {
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
                                                csrf
                                            );
                                            $.ajax({
                                                url: '/pemilik/dashboard/ambil/simpan/organik',
                                                type: 'POST',
                                                data: result
                                                    .value,
                                                processData: false,
                                                contentType: false,
                                                success: function (
                                                    response
                                                ) {
                                                    console
                                                        .log(
                                                            response
                                                        );
                                                },
                                                error: function (
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
    // End organik

    // Start Kertas
    $('.kertas').click(function (e) {
        e.preventDefault();

        // Inisialisasi variabel alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue
        let alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue, catatanValue;

        Swal.fire({
            title: "Buat Pesanan Pengambilan Sampah Kertas",
            html: `
                    <form action="" method="POST" id="orderForm">
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
                            <label for="catatan" class="form-label">Catatan Alamat Tambahan</label>
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
                $(useAuthDataCheckbox).on("change", function () {
                    if (useAuthDataCheckbox.checked) {
                        Swal.getPopup().querySelector("input[name='nama']")
                            .value = nama;
                        Swal.getPopup().querySelector("input[name='nama']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .value = nomor;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .disabled = true;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .value = alamat;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .value = kecamatan;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .value = kota;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .value = provinsi;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .value = kodePos;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .disabled = true;
                        Swal.getPopup().querySelector(
                            "textarea[name='catatan']")
                            .value = catatan;
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
                catatanValue = Swal.getPopup().querySelector("textarea[name='catatan']")
                    .value;
                const berat = Swal.getPopup().querySelector("select[name='berat']")
                    .value;

                if (!nama || !nomor || !alamatValue || !kecamatanValue || !kotaValue ||
                    !provinsiValue || !kodePosValue || !berat) {
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
                formData.append('catatan', catatanValue);
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
                        let fullAddress = "";
                        if (catatanValue) {
                            fullAddress =
                                `${alamatValue} (${catatanValue}), ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;
                        } else {
                            fullAddress =
                                `${alamatValue}, ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;
                        }

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
                                        function () {
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
                                                csrf
                                            );
                                            $.ajax({
                                                url: '/pemilik/dashboard/ambil/simpan/kertas',
                                                type: 'POST',
                                                data: result
                                                    .value,
                                                processData: false,
                                                contentType: false,
                                                success: function (
                                                    response
                                                ) {
                                                    console
                                                        .log(
                                                            response
                                                        );
                                                },
                                                error: function (
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
    // End Kertas

    // Start Plastik
    $('.plastik').click(function (e) {
        e.preventDefault();

        // Inisialisasi variabel alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue
        let alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue, catatanValue;

        Swal.fire({
            title: "Buat Pesanan Pengambilan Sampah Plastik",
            html: `
                    <form action="" method="POST" id="orderForm">
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
                            <label for="catatan" class="form-label">Catatan Alamat Tambahan</label>
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
                $(useAuthDataCheckbox).on("change", function () {
                    if (useAuthDataCheckbox.checked) {
                        Swal.getPopup().querySelector("input[name='nama']")
                            .value = nama;
                        Swal.getPopup().querySelector("input[name='nama']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .value = nomor;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .disabled = true;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .value = alamat;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .value = kecamatan;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .value = kota;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .value = provinsi;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .value = kodePos;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .disabled = true;
                        Swal.getPopup().querySelector(
                            "textarea[name='catatan']")
                            .value = catatan;
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
                catatanValue = Swal.getPopup().querySelector("textarea[name='catatan']")
                    .value;
                const berat = Swal.getPopup().querySelector("select[name='berat']")
                    .value;

                if (!nama || !nomor || !alamatValue || !kecamatanValue || !kotaValue ||
                    !provinsiValue || !kodePosValue || !berat) {
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
                formData.append('catatan', catatanValue);
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
                        let fullAddress = "";
                        if (catatanValue) {
                            fullAddress =
                                `${alamatValue} (${catatanValue}), ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;
                        } else {
                            fullAddress =
                                `${alamatValue}, ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;
                        }

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
                                        function () {
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
                                                csrf
                                            );
                                            $.ajax({
                                                url: '/pemilik/dashboard/ambil/simpan/plastik',
                                                type: 'POST',
                                                data: result
                                                    .value,
                                                processData: false,
                                                contentType: false,
                                                success: function (
                                                    response
                                                ) {
                                                    console
                                                        .log(
                                                            response
                                                        );
                                                },
                                                error: function (
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
    // End Plastik

    // Start Kaca
    $('.kaca').click(function (e) {
        e.preventDefault();

        // Inisialisasi variabel alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue
        let alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue, catatanValue;

        Swal.fire({
            title: "Buat Pesanan Pengambilan Sampah Kaca",
            html: `
                    <form action="" method="POST" id="orderForm">
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
                            <label for="catatan" class="form-label">Catatan Alamat Tambahan</label>
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
                $(useAuthDataCheckbox).on("change", function () {
                    if (useAuthDataCheckbox.checked) {
                        Swal.getPopup().querySelector("input[name='nama']")
                            .value = nama;
                        Swal.getPopup().querySelector("input[name='nama']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .value = nomor;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .disabled = true;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .value = alamat;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .value = kecamatan;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .value = kota;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .value = provinsi;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .value = kodePos;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .disabled = true;
                        Swal.getPopup().querySelector(
                            "textarea[name='catatan']")
                            .value = catatan;
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
                catatanValue = Swal.getPopup().querySelector("textarea[name='catatan']")
                    .value;
                const berat = Swal.getPopup().querySelector("select[name='berat']")
                    .value;

                if (!nama || !nomor || !alamatValue || !kecamatanValue || !kotaValue ||
                    !provinsiValue || !kodePosValue || !berat) {
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
                formData.append('catatan', catatanValue);
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
                        let fullAddress = "";
                        if (catatanValue) {
                            fullAddress =
                                `${alamatValue} (${catatanValue}), ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;
                        } else {
                            fullAddress =
                                `${alamatValue}, ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;
                        }

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
                                        function () {
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
                                                csrf
                                            );
                                            $.ajax({
                                                url: '/pemilik/dashboard/ambil/simpan/kaca',
                                                type: 'POST',
                                                data: result
                                                    .value,
                                                processData: false,
                                                contentType: false,
                                                success: function (
                                                    response
                                                ) {
                                                    console
                                                        .log(
                                                            response
                                                        );
                                                },
                                                error: function (
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
    // End Kaca

    // Start Logam
    $('.logam').click(function (e) {
        e.preventDefault();

        // Inisialisasi variabel alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue
        let alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue, catatanValue;

        Swal.fire({
            title: "Buat Pesanan Pengambilan Sampah Logam",
            html: `
                    <form action="" method="POST" id="orderForm">
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
                            <label for="catatan" class="form-label">Catatan Alamat Tambahan</label>
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
                $(useAuthDataCheckbox).on("change", function () {
                    if (useAuthDataCheckbox.checked) {
                        Swal.getPopup().querySelector("input[name='nama']")
                            .value = nama;
                        Swal.getPopup().querySelector("input[name='nama']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .value = nomor;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .disabled = true;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .value = alamat;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .value = kecamatan;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .value = kota;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .value = provinsi;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .value = kodePos;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .disabled = true;
                        Swal.getPopup().querySelector(
                            "textarea[name='catatan']")
                            .value = catatan;
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
                catatanValue = Swal.getPopup().querySelector("textarea[name='catatan']")
                    .value;
                const berat = Swal.getPopup().querySelector("select[name='berat']")
                    .value;

                if (!nama || !nomor || !alamatValue || !kecamatanValue || !kotaValue ||
                    !provinsiValue || !kodePosValue || !berat) {
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
                formData.append('catatan', catatanValue);
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
                        let fullAddress = "";
                        if (catatanValue) {
                            fullAddress =
                                `${alamatValue} (${catatanValue}), ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;
                        } else {
                            fullAddress =
                                `${alamatValue}, ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;
                        }

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
                                        function () {
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
                                                csrf
                                            );
                                            $.ajax({
                                                url: '/pemilik/dashboard/ambil/simpan/logam',
                                                type: 'POST',
                                                data: result
                                                    .value,
                                                processData: false,
                                                contentType: false,
                                                success: function (
                                                    response
                                                ) {
                                                    console
                                                        .log(
                                                            response
                                                        );
                                                },
                                                error: function (
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
    // End Logam

    // Start Lainnya
    $('.lainnya').click(function (e) {
        e.preventDefault();

        // Inisialisasi variabel alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue
        let alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue, catatanValue;

        Swal.fire({
            title: "Buat Pesanan Pengambilan Sampah Lainnya",
            html: `
                    <form action="" method="POST" id="orderForm">
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
                            <label for="catatan" class="form-label">Catatan Alamat Tambahan</label>
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
                $(useAuthDataCheckbox).on("change", function () {
                    if (useAuthDataCheckbox.checked) {
                        Swal.getPopup().querySelector("input[name='nama']")
                            .value = nama;
                        Swal.getPopup().querySelector("input[name='nama']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .value = nomor;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .disabled = true;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .value = alamat;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .value = kecamatan;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .value = kota;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .value = provinsi;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .value = kodePos;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .disabled = true;
                        Swal.getPopup().querySelector(
                            "textarea[name='catatan']")
                            .value = catatan;
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
                catatanValue = Swal.getPopup().querySelector("textarea[name='catatan']")
                    .value;
                const berat = Swal.getPopup().querySelector("select[name='berat']")
                    .value;

                if (!nama || !nomor || !alamatValue || !kecamatanValue || !kotaValue ||
                    !provinsiValue || !kodePosValue || !berat) {
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
                formData.append('catatan', catatanValue);
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
                        let fullAddress = "";
                        if (catatanValue) {
                            fullAddress =
                                `${alamatValue} (${catatanValue}), ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;
                        } else {
                            fullAddress =
                                `${alamatValue}, ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;
                        }

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
                                        function () {
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
                                                csrf
                                            );
                                            $.ajax({
                                                url: '/pemilik/dashboard/ambil/simpan/lainnya',
                                                type: 'POST',
                                                data: result
                                                    .value,
                                                processData: false,
                                                contentType: false,
                                                success: function (
                                                    response
                                                ) {
                                                    console
                                                        .log(
                                                            response
                                                        );
                                                },
                                                error: function (
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
    // End Logam
});