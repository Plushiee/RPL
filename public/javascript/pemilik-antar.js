$(document).ready(function () {
    const authData = document.getElementById('authData');
    const nama = authData.getAttribute('data-name');
    const nomor = authData.getAttribute('data-nomor');
    const csrf = authData.getAttribute('data-csrf');
    let id;
    var beratValue;

    function berhasil() {
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
            title: 'Pesanan Berhasil Ditambahkan'
        });
    }

    function gagal() {
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
            title: 'Pesanan Gagal Ditambahkan, Cek Kembali Data!'
        });
    }

    function getSelectedValues() {
        var selectedCheckboxes = $('.btn-check:checked');
        var selectedValues = [];

        selectedCheckboxes.each(function () {
            var labelText = $(this).next('label').text().trim();
            selectedValues.push(labelText);
        });

        return selectedValues.join(', ');
    }

    $('#antar').click(function (e) {
        e.preventDefault();

        // Get selected values
        var selectedValues = getSelectedValues();

        Swal.fire({
            title: "Buat Pesanan Antar Sendiri",
            html: `
                    <form id="orderForm">
                        <div class="mb-3 mt-0 pt-0">
                            Jenis Sampah : <br>
                            ${selectedValues}
                        </div>
                        <div class="mb-3">
                            <p class="form-label" style="font-size:12;"> <input class="form-check-input" type="checkbox" id="useAuthData" name="useAuthData"> Isi data dengan informasi saya</p>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" name="nama" placeholder="Nama Pemilik Sampah" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" name="nomor" placeholder="Nomor Handphone (+62xxx)" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="bukti" class="form-label">Bukti Barang</label>
                            <input class="form-control" type="file" name="bukti" accept="image/*" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="catatan" class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                        </div>
                        <div class="mb-3 text-start">
                            <input class="form-control" type="number" id="berat" name="berat" placeholder="Berat Sampah (Kg)"></input>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="mapSwoll" class="form-label">Peta Bank Sampah (Pilih Salah Satu)</label>
                            <div id="mapSwoll" style="height: 400px;"></div>
                        </div>
                    </form>`
            ,
            showCancelButton: true,
            confirmButtonText: "Kirim",
            cancelButtonText: "Tutup",
            focusConfirm: false,
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            preConfirm: () => {
                const orderForm = Swal.getPopup().querySelector("#orderForm");
                const namaValue = Swal.getPopup().querySelector("input[name='nama']")
                    .value;
                const nomorValue = Swal.getPopup().querySelector("input[name='nomor']")
                    .value;
                const catatanValue = Swal.getPopup().querySelector("textarea[name='catatan']")
                    .value;
                const beratValue = Swal.getPopup().querySelector("input[name='berat']")
                    .value;

                if (!nama || !nomor || !beratValue) {
                    Swal.showValidationMessage("Semua Kolom Harus Terisi!");
                } else {
                    if (!id) {
                        Swal.showValidationMessage("Mohon Pilih Bank Sampah Yang Dituju!");
                    }
                }

                const formData = new FormData(orderForm);
                formData.append('_token', csrf);
                formData.append('nama', namaValue);
                formData.append('nomor', nomorValue);
                formData.append('catatan', catatanValue);
                formData.append('berat', beratValue);
                formData.append('jenisSampah', getSelectedValues())
                return formData;
            },
            didOpen: () => {
                const useAuthDataCheckbox = Swal.getPopup().querySelector(
                    "#useAuthData");
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
                    }
                });

                function initMap(latitude, longitude) {
                    const initialLocation = { lat: latitude, lng: longitude };
                    let maxCapacity = 0;

                    const map = new google.maps.Map(document.getElementById('mapSwoll'), {
                        center: initialLocation,
                        zoom: 15
                    });

                    const iconSize = {
                        width: 32,
                        height: 32
                    };

                    //dot biru
                    const userMarker = new google.maps.Marker({
                        position: initialLocation,
                        map: map,
                        icon: {
                            url: '/assets/images/dot-map.png',
                            scaledSize: new google.maps.Size(iconSize.width, iconSize.height),
                        },
                        title: 'You are here!'
                    });


                    function fetchLocationData() {
                        $.ajax({
                            url: '/pemilik/dashboard/antar/lokasiBank',
                            type: 'GET',
                            dataType: 'json',
                            success: function (response) {
                                maxCapacity = response[0].kapasitas;
                                performTextSearch(response);
                                console.log(response)
                                console.log(maxCapacity)
                            },
                            error: function (error) {
                                console.error('Error fetching location data:', error);
                            }
                        });
                    }

                    function performTextSearch(locations) {
                        locations.forEach((locationData) => {
                            const address = `${locationData.alamat}, ${locationData.kecamatan}, ${locationData.kota}, ${locationData.provinsi}, ${locationData.kodePos}, ${locationData.catatan}`;
                            const position = { lat: parseFloat(locationData.lang), lng: parseFloat(locationData.long) };
                            const name = locationData.name;
                            var infoWindow;
                            let selectedButton = null;

                            const marker = new google.maps.Marker({
                                position: position,
                                map: map,
                                title: name
                            });

                            const beratInput = Swal.getPopup().querySelector("input[name='berat']");
                            const kapasitas = locationData.kapasitas;

                            infoWindow = new google.maps.InfoWindow({
                                content: `
                                    <h3 style="font-size:12pt; font-weight:bold;">${name}</h3>
                                    <p style="font-size:8pt;">${address}</p>
                                    <p class="text-center error-message" style="font-size:8pt; color: red;">Masukan Berat Terlebih Dahulu</p>
                                    <button class="btn btn-info btn-sm petunjuk float-end">Petunjuk Arah</button>
                                `,
                                maxWidth: 300
                            });

                            beratInput.addEventListener('input', function () {
                                beratValue = parseFloat(beratInput.value) || 0;

                                // Check apakah berat melebihi kapasitas
                                if (beratValue > kapasitas) {
                                    const errorMessage = `<h3 style="font-size:12pt; font-weight:bold;">${name}</h3>
                                        <p style="font-size:8pt;">${address}</p>
                                        <p class="text-center error-message" style="font-size:8pt; color: red;">Sampah Anda Melampaui Kapasitas Maksimum ${locationData.kapasitas} Kg</p>
                                        <button class="btn btn-info btn-sm petunjuk float-end">Petunjuk Arah</button>
                                        `;

                                    infoWindow.setContent(errorMessage);
                                } else {
                                    const message = `<h3 style="font-size:12pt; font-weight:bold;">${name}</h3>
                                        <p style="font-size:8pt;">${address}</p>
                                        <button class="btn btn-primary btn-sm data" data-id="${locationData.id}">Select</button>
                                        <button class="btn btn-info btn-sm petunjuk float-end">Petunjuk Arah</button>
                                        `;

                                    infoWindow.setContent(message);
                                }
                            });

                            marker.addListener('click', function () {
                                infoWindow.open(map, marker);
                            });

                            google.maps.event.addListener(infoWindow, 'domready', function () {
                                const selectButton = document.querySelector('.data');
                                selectButton.addEventListener('click', function (e) {
                                    e.preventDefault();
                                    id = selectButton.getAttribute('data-id');
                                    console.log(id)

                                    selectButton.setAttribute('disabled', 'true');

                                    if (selectedButton && selectedButton !== selectButton) {
                                        selectedButton.removeAttribute('disabled');
                                    }
                                    selectedButton = selectButton;
                                });

                                const petunjukButton = document.querySelector('.petunjuk');
                                petunjukButton.addEventListener('click', function (e) {
                                    e.preventDefault();
                                    const url = `https://www.google.com/maps/dir/?api=1&destination=${locationData.lang},${locationData.long}`;
                                    window.open(url, '_blank');
                                })
                            });
                        });
                    }

                    fetchLocationData();
                }

                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            (position) => {
                                const latitude = position.coords.latitude;
                                const longitude = position.coords.longitude;

                                initMap(latitude, longitude);
                            },
                            (error) => {
                                console.error('Error getting geolocation:', error);
                                initMap(0, 0);
                            }
                        );
                    } else {
                        console.error('Geolocation is not supported by your browser.');
                    }
                }
                getLocation();
            }
        }).then((result) => {
            if (result.isConfirmed) {
                result.value.append('id', id);

                $.ajax({
                    url: '/pemilik/dashboard/antar/simpan',
                    type: 'POST',
                    data: result
                        .value,
                    processData: false,
                    contentType: false,
                    success: function (
                        response
                    ) {
                        berhasil();
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
            }
        })
    });
});
