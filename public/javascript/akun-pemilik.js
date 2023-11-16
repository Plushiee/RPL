$(document).ready(function () {
    // const authData = document.getElementById('authData');
    // const csrf = authData.getAttribute('data-csrf');

    var csrf = $('#authData').val();
    var nameUser = document.getElementById('nameUser').value;
    var nomor = document.getElementById('nomor').value;
    var namaPengambil = document.getElementById('nameData').value;
    var nomorPengambil = document.getElementById('nomorData').value;
    var alamatPengambil = document.getElementById('alamatData').value;
    var kecamatanPengambil = document.getElementById('kecamatanData').value;
    var kotaPengambil = document.getElementById('kotaData').value;
    var provinsiPengambil = document.getElementById('provinsiData').value;
    var kodeposPengambil = document.getElementById('kodeposData').value;
    var catatanPengambil = document.getElementById('catatanData').value;

    // edit akun
    $('#editAkun').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Edit Data Akun',
            html: `
                <form action="" method="POST" id="">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nama" placeholder="Nama Akun" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nomor" placeholder="Nomor Handphone (+62xxx)" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" name="oldPass" placeholder="Masukan Password Lama" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" name="passBaru" placeholder="Password Baru" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" name="passBaruUlang" placeholder="Ulangi Password Baru" required>
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Cancel',
            focusConfirm: false,
            didOpen: () => {
                Swal.getPopup().querySelector("input[name='nama']")
                            .value = nameUser;
                Swal.getPopup().querySelector("input[name='nomor']")
                            .value = nomor;
            },
            preConfirm: () => {
                const namaAkun = Swal.getPopup().querySelector("input[name='nama']").value;
                const nomor = Swal.getPopup().querySelector("input[name='nomor']").value;
                const oldPassword = Swal.getPopup().querySelector("input[name='oldPass']").value;
                const password = Swal.getPopup().querySelector("input[name='passBaru']").value;
                const ulangiPassword = Swal.getPopup().querySelector("input[name='passBaruUlang']").value;
                const formData = new FormData();
                formData.append('_token', csrf);
                formData.append('nama', namaAkun);
                formData.append('nomor', nomor);
                formData.append('passwordCheck', oldPassword);
                formData.append('password', password);

                if (!namaAkun || !nomor || !oldPassword || !password ||
                    !ulangiPassword) {
                    Swal.showValidationMessage("Semua Kolom Harus Terisi!");
                } else {
                    if (ulangiPassword !== password) {
                        Swal.showValidationMessage("Password dan Ulangi Password Harus Sama!");
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "/pemilik/akun/passwordCheck",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                $.ajax({
                                    type: "POST",
                                    url: "/pemilik/akun/gantiDataAkun",
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function (response) {
                                        console.log("Berhasil")
                                    }
                                });
                            },
                            error: function (error) {
                                console.log(error)
                            },
                        })
                    }
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Perubahan Data Akun Berhasil!', '', 'success');
                setTimeout(window.location.href = '/logout', 4000);
            }
        });
    });

    // edit data pengguna
    $('#editPengguna').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Edit Data Pengguna',
            html: `
                <form action="" method="POST" id="">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nama" placeholder="Nama Lengkap Pengguna" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
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
                        <label for="catatan" class="form-label">Catatan Alamat Tambahan (Cth: Blok / Unit, No., Patokan)</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Cancel',
            focusConfirm: false,
            didOpen: () => {
                Swal.getPopup().querySelector("input[name='nama']")
                            .value = namaPengambil;
                Swal.getPopup().querySelector("textarea[name='alamat']")
                            .value = alamatPengambil;
                Swal.getPopup().querySelector("input[name='kecamatan']")
                            .value = kecamatanPengambil;
                Swal.getPopup().querySelector("input[name='kota']")
                            .value = kotaPengambil;
                Swal.getPopup().querySelector("input[name='provinsi']")
                            .value = provinsiPengambil;
                Swal.getPopup().querySelector("input[name='kodePos']")
                            .value = kodeposPengambil;
                Swal.getPopup().querySelector("textarea[name='catatan']")
                            .value = catatanPengambil;
            },
            preConfirm: () => {
                const nama = Swal.getPopup().querySelector("input[name='nama']").value;
                const alamatValue = Swal.getPopup().querySelector("textarea[name='alamat']").value;
                const kecamatanValue = Swal.getPopup().querySelector("input[name='kecamatan']").value;
                const kotaValue = Swal.getPopup().querySelector("input[name='kota']").value;
                const provinsiValue = Swal.getPopup().querySelector("input[name='provinsi']").value;
                const kodePosValue = Swal.getPopup().querySelector("input[name='kodePos']").value;
                const catatanValue = Swal.getPopup().querySelector("textarea[name='catatan']").value;
                const formData = new FormData();
                formData.append('_token', csrf);
                formData.append('nama', nama);
                formData.append('alamat', alamatValue);
                formData.append('kecamatan', kecamatanValue);
                formData.append('kota', kotaValue);
                formData.append('provinsi', provinsiValue);
                formData.append('kodePos', kodePosValue);
                formData.append('catatan', catatanValue);

                if (!nama || !alamatValue || !alamatValue || !kecamatanValue ||
                    !kotaValue || !provinsiValue || !kodePosValue || !catatanValue) {
                    Swal.showValidationMessage("Semua Kolom Harus Terisi!");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/pemilik/akun/gantiDataPemilik",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            console.log("Berhasil")
                        },
                        error: function (error) {
                            console.error(error)
                        }
                    });
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Perubahan Data Akun Berhasil!', '', 'success');
                setTimeout(window.location.href = '/logout', 4000);
            }
        });
    });

    $('#pengambil').click(function (e) {
        Swal.fire({
            title: "Daftar Menjadi Member Pengambil Sampah",
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
                            <p class="form-label" style="font-size:12;"> <input class="form-check-input" type="checkbox" id="useAuthData" name="useAuthData"> Isi data dengan informasi akun saya</p>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="berat" required>
                                <option value="" disabled selected>Pilih Berat Maksimum Pengangkutan</option>
                                <option value="small">Small (Maks. 5 kg)</option>
                                <option value="medium">Medium (Maks. 20 kg)</option>
                                <option value="large">Large (Maks. 100 kg)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <p class="form-label" style="font-size:12;"> <input class="form-check-input" type="checkbox" id="setuju" name="setuju"> Dengan ini, saya setuju atas seluruh <a href="">Terms & Condition</a> MoneyTrash!</p>
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
                            .value = namaPengambil;
                        Swal.getPopup().querySelector("input[name='nama']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .value = nomorPengambil;
                        Swal.getPopup().querySelector("input[name='nomor']")
                            .disabled = true;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .value = alamatPengambil;
                        Swal.getPopup().querySelector("textarea[name='alamat']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .value = kecamatanPengambil;
                        Swal.getPopup().querySelector("input[name='kecamatan']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .value = kotaPengambil;
                        Swal.getPopup().querySelector("input[name='kota']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .value = provinsiPengambil;
                        Swal.getPopup().querySelector("input[name='provinsi']")
                            .disabled = true;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .value = kodeposPengambil;
                        Swal.getPopup().querySelector("input[name='kodePos']")
                            .disabled = true;
                        Swal.getPopup().querySelector(
                            "textarea[name='catatan']")
                            .value = catatanPengambil;
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
                kapasitas = Swal.getPopup().querySelector("select[name='berat']")
                    .value;
                setujuCheckbox = Swal.getPopup().querySelector("input[name='setuju']");

                if (!nama || !nomor || !alamatValue || !kecamatanValue || !kotaValue ||
                    !provinsiValue || !kodePosValue || !kapasitas) {
                    Swal.showValidationMessage("Semua Kolom Harus Terisi!");
                } else {
                    if (!setujuCheckbox.checked) {
                        Swal.showValidationMessage("Anda Harus Menetujui Terms And Condition");
                    }
                }

                const formData = new FormData(orderForm);
                formData.append('_token', csrf);
                formData.append('nama', nama);
                formData.append('nomor', nomor);
                formData.append('alamat', alamatValue);
                formData.append('kecamatan', kecamatanValue);
                formData.append('kota', kotaValue);
                formData.append('provinsi', provinsiValue);
                formData.append('kodePos', kodePosValue);
                formData.append('catatan', catatanValue);
                formData.append('kapasitas', kapasitas);

                $.ajax({
                    url: '/pemilik/akun/daftarPengambil',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (
                        response
                    ) {
                        console.log(response)
                    },
                    error: function (
                        error) {
                        gagal();
                        console
                            .error(
                                error
                            );
                    }
                });

            },
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Mendaftar Menjadi Agen Pengambil Berhasil!', '', 'success');
                setTimeout(window.location.href = '/logout', 4000);
            }
        });
    });
});
