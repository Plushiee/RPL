$(document).ready(function () {

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
                    <div class="mb-3 mt-0 pt-0">
                        Jenis Sampah : <br>
                        ${selectedValues}
                    </div>
                    <form action="" method="POST" id="orderForm">
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
                    </form>`,
            showCancelButton: true,
            confirmButtonText: "Selanjutnya",
            cancelButtonText: "Tutup",
            focusConfirm: false,
            showLoaderOnConfirm: true,
            didOpen: () => {
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
                                            <button class="btn btn-primary btn-sm data" ${isOpen ? '' : 'disabled'}>Select</button>
                                        `,
                                        maxWidth: 300
                                    });

                                    $(".data").click(function (e) {
                                        e.preventDefault();
                                        const selectedResult = result;
                                        ambilLokasi(selectedResult);
                                    });

                                    // Tambahkan event listener untuk menampilkan info window ketika marker diklik
                                    marker.addListener('click', function () {
                                        infoWindow.open(map, marker);
                                    });
                                });

                                // Periksa apakah ada halaman berikutnya hasil pencarian
                                if (pagination.hasNextPage) {
                                    // Ambil halaman berikutnya
                                    pagination.nextPage();
                                }
                            }
                        });
                    }

                    performTextSearch(request, map);
                }

                // Function to handle the button click in the info window
                function ambilLokasi (place) {
                    const name = place.name;
                    const address = place.formatted_address;
                    console.log(place)

                    // Do something with the retrieved information
                    console.log('Name:', name);
                    console.log('Address:', address);
                    console.log('Latitude:', latitude);
                    console.log('Longitude:', longitude);

                    // You can use this information to update your form or perform other actions
                };

                // Fungsi untuk mendapatkan geolokasi pengguna
                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            (position) => {
                                const latitude = position.coords.latitude;
                                const longitude = position.coords.longitude;

                                // Inisialisasi peta dengan koordinat geolokasi
                                initMap(latitude, longitude);
                            },
                            (error) => {
                                console.error('Error getting geolocation:', error);
                                // Jika terjadi kesalahan, inisialisasi peta dengan koordinat default
                                initMap(0, 0);
                            }
                        );
                    } else {
                        // Geolokasi tidak didukung oleh browser
                        console.error('Geolocation is not supported by your browser.');
                    }
                }

                // Panggil fungsi untuk mendapatkan geolokasi dan inisialisasi peta
                getLocation();
            }
        })
    });
});
