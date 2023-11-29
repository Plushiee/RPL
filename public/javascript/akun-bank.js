$(document).ready(function () {
    var csrf = $('#authData').val();
    var namaBank = document.getElementById('namaBank').value;
    var nomor = document.getElementById('nomor').value;
    var alanatBank = document.getElementById('alamatData').value;
    var kecamatanBank = document.getElementById('kecamatanData').value;
    var kotaBank = document.getElementById('kotaData').value;
    var provinsiBank = document.getElementById('provinsiData').value;
    var kodePosBank = document.getElementById('kodeposData').value;
    var catatanBank = document.getElementById('catatanData').value;

    var kapasitas = document.getElementById('kapasitas').value;

    // edit akun
    $('#editAkun').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Edit Data Akun',
            html: `
                <form action="" method="POST" id="">
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
                Swal.getPopup().querySelector("input[name='nomor']")
                    .value = nomor;
            },
            preConfirm: () => {
                const oldPassword = Swal.getPopup().querySelector("input[name='oldPass']").value;
                const password = Swal.getPopup().querySelector("input[name='passBaru']").value;
                const ulangiPassword = Swal.getPopup().querySelector("input[name='passBaruUlang']").value;
                const formData = new FormData();
                formData.append('_token', csrf);
                formData.append('passwordCheck', oldPassword);
                formData.append('password', password);

                if (!oldPassword || !password ||
                    !ulangiPassword) {
                    Swal.showValidationMessage("Semua Kolom Harus Terisi!");
                } else {
                    if (ulangiPassword !== password) {
                        Swal.showValidationMessage("Password dan Ulangi Password Harus Sama!");
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "/bank/akun/passwordCheck",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                $.ajax({
                                    type: "POST",
                                    url: "/bank/akun/gantiDataAkun",
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
                console.log(result)
                setTimeout(window.location.href = '/logout', 4000);
            }
        });
    });


    // Edit Bank
    $('#editBank').click(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Edit Data Bank Sampah",
            html: `
                    <form action="" method="POST" id="orderForm">
                        <div class="mb-3">
                            <input class="form-control" type="text" name="name" placeholder="Nama Bank Sampah" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" name="nomor" placeholder="Nomor Bank Sampah (+62xxx)" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="alamat" class="form-label">Alamat Tempat Tinggal</label>
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
                            <input class="form-control" type="number" name="kapasitas" id="kapasitas" placeholder="Kapasitas Bank Sampah (Kg)">
                        </div>
                    </form>`,
            showCancelButton: true,
            confirmButtonText: "Ubah",
            focusConfirm: false,
            showLoaderOnConfirm: true,
            didOpen: () => {
                const orderForm = Swal.getPopup().querySelector("#orderForm");
                Swal.getPopup().querySelector("input[name='name']")
                    .value = namaBank;
                Swal.getPopup().querySelector("input[name='nomor']")
                    .value = nomor;
                Swal.getPopup().querySelector("textarea[name='alamat']")
                    .value = alanatBank;
                Swal.getPopup().querySelector("input[name='kecamatan']")
                    .value = kecamatanBank;
                Swal.getPopup().querySelector("input[name='kota']")
                    .value = kotaBank;
                Swal.getPopup().querySelector("input[name='provinsi']")
                    .value = provinsiBank;
                Swal.getPopup().querySelector("input[name='kodePos']")
                    .value = kodePosBank;
                Swal.getPopup().querySelector(
                    "textarea[name='catatan']")
                    .value = catatanBank;
                    Swal.getPopup().querySelector("input[name='kapasitas']")
                    .value = kapasitas;

            },
            preConfirm: () => {
                const name = Swal.getPopup().querySelector(
                    "input[name='name']").value;
                const nomor = Swal.getPopup().querySelector(
                    "input[name='nomor']").value;
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
                kapasitas = Swal.getPopup().querySelector("input[name='kapasitas']")
                    .value;

                if (!name || !nomor || !alamatValue || !kecamatanValue || !kotaValue ||
                    !provinsiValue || !kodePosValue || !kapasitas) {
                    Swal.showValidationMessage("Semua Kolom Harus Terisi!");
                }

                const formData = new FormData(orderForm);
                formData.append('_token', csrf);
                formData.append('nama', name);
                formData.append('nomor', nomor);
                formData.append('alamat', alamatValue);
                formData.append('kecamatan', kecamatanValue);
                formData.append('kota', kotaValue);
                formData.append('provinsi', provinsiValue);
                formData.append('kodePos', kodePosValue);
                formData.append('catatan', catatanValue);
                formData.append('kapasitas', kapasitas);
                return formData;
            },
        }).then((result) => {
            console.log('hasil', result)
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Lokasi Bank Sampah",
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

                                long = marker
                                    .getPosition().lng();
                                lang = marker
                                    .getPosition().lat();

                                google.maps.event.addListener(marker, 'dragend', function () {
                                    long = marker
                                        .getPosition().lng();
                                    lang = marker
                                        .getPosition().lat();
                                });
                            }
                        });
                    }, preConfirm: () => {
                        result.value.append(
                            'long',
                            long);
                        result.value.append(
                            'lang', lang
                        );
                        $.ajax({
                            url: '/bank/akun/simpanDataBank',
                            type: 'POST',
                            data: result.value,
                            processData: false,
                            contentType: false,
                            success: function (
                                response
                            ) {
                                console.log(response)
                            },
                            error: function (
                                error) {
                                console
                                    .error(
                                        error
                                    );
                            }
                        });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Berhasil Mengubah Data Bank!',
                            icon: 'success',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            allowOutsideClick: false
                        }).then(() => {
                            // window.location.href = '/logout';
                        });
                    }
                })
            }
        });
    });
});
