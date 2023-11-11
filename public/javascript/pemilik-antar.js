$(document).ready(function () {
    const authData = document.getElementById('authData');
    const nama = authData.getAttribute('data-name');
    const nomor = authData.getAttribute('data-nomor');
    const csrf = authData.getAttribute('data-csrf');
    let namaMap = "";
    let alamatMap = "";
    let longitudeMap = "";
    let latitudeMap = "";

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
                            <label for="mapSwoll" class="form-label">Peta Bank Sampah (Pilih Salah Satu)</label>
                            <div id="mapSwoll" style="height: 400px;"></div>
                        </div>
                        <div class="mb-3">
                            <p class="form-label" style="font-size:12;"> <input class="form-check-input" type="checkbox" id="useAuthData" name="useAuthData"> Isi data dengan informasi saya</p>
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

                if (!nama || !nomor) {
                    Swal.showValidationMessage("Semua Kolom Harus Terisi!");
                } else {
                    if (!namaMap || !alamatMap || !latitudeMap || !longitudeMap) {
                        Swal.showValidationMessage("Mohon Pilih Bank Sampah Yang Dituju!");
                    }
                }

                const formData = new FormData(orderForm);
                formData.append('_token', csrf);
                formData.append('nama', namaValue);
                formData.append('nomor', nomorValue);
                formData.append('catatan', catatanValue);
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

                    const searchLocation = "Bank Sampah Yogyakarta";
                    const request = {
                        query: searchLocation,
                        fields: ['name', 'geometry', 'formatted_address', 'business_status']
                    };
                    const service = new google.maps.places.PlacesService(map);

                    function performTextSearch(request, map) {
                        service.textSearch(request, (results, status, pagination) => {
                            if (status === google.maps.places.PlacesServiceStatus.OK) {
                                results.forEach((result) => {
                                    const location = result.geometry.location;
                                    const name = result.name;
                                    const address = result.formatted_address;
                                    const latitude = location.lat();
                                    const longitude = location.lng();
                                    const isOpen = result.business_status === 'OPERATIONAL';

                                    const marker = new google.maps.Marker({
                                        position: location,
                                        map: map,
                                        title: name
                                    });

                                    const infoWindow = new google.maps.InfoWindow({
                                        content: `
                                            <h3 style="font-size:12pt; font-weight:bold;">${name}</h3>
                                            <p style="font-size:8pt;">${address}</p>
                                            <button class="btn btn-primary btn-sm data" ${isOpen ? '' : 'disabled'} data-name="${name}" data-address="${address}" data-latitude="${latitude}" data-longitude="${longitude}">Select</button>
                                        `,
                                        maxWidth: 300
                                    });

                                    marker.addListener('click', function () {
                                        infoWindow.open(map, marker);
                                    });


                                    google.maps.event.addListener(infoWindow, 'domready', function () {
                                        const selectButton = document.querySelector('.btn.data');
                                        selectButton.addEventListener('click', function (event) {
                                            event.preventDefault();

                                            namaMap = selectButton.getAttribute('data-name');
                                            alamatMap = selectButton.getAttribute('data-address');
                                            longitudeMap = selectButton.getAttribute('data-longitude');
                                            latitudeMap = selectButton.getAttribute('data-latitude');
                                            console.log(longitudeMap)

                                            selectButton.setAttribute('disabled', 'true');
                                        });
                                    });
                                });
                            }
                        });
                    }

                    performTextSearch(request, map);
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
                result.value.append('namaBank', namaMap);
                result.value.append('alamatBank', alamatMap);
                result.value.append('longitudeBank', longitudeMap);
                result.value.append('latitudeBank', latitudeMap);

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
