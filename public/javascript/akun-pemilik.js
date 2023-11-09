$(document).ready(function () {
    const authData = document.getElementById('authData');
    const csrf = authData.getAttribute('data-csrf');

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
            confirmButtonText: 'Save Changes',
            cancelButtonText: 'Cancel',
            focusConfirm: false,
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
                setTimeout(window.location.href = '/logout', 2000);
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
            confirmButtonText: 'Save Changes',
            cancelButtonText: 'Cancel',
            focusConfirm: false,
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
                setTimeout(window.location.href = '/logout', 2000);
            }
        });
    });
});