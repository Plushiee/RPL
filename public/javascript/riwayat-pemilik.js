$(document).ready(function () {
    $('.bukti').click(function (e) {
        e.preventDefault();

        // Mendapatkan data dari button yang diklik
        const button = $(this);
        const id = button.data('id');
        const bukti = button.data('bukti');
        const jenis = button.data('jenis').toLowerCase();

        Swal.fire({
            title: "Bukti Barang",
            html: `<img src="${getBuktiSampahRoute(jenis, id, bukti)}" alt="Bukti Sampah" style="max-width: 100%; height: auto;">`,
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: "Tutup",
            focusConfirm: false,
        });
    });

    function getBuktiSampahRoute(jenis, id, gambar) {
        return `/pemilik/bukti/ambildirumah/${jenis}/${id}/${gambar}`;
    }

    $('.informasi').click(function (e) {
        e.preventDefault();

        // Mendapatkan data dari button yang diklik
        const button = $(this);
        const id = button.data('id');
        const bankSampah = button.data('bankSampah');
        const alamat = button.data('alamat');
        const lang = button.data('lang');
        const long = button.data('long');

        Swal.fire({
            title: "Informasi Lainnya",
            html: `
            <h4>Bukti Barang</h4>
            <img src="${getBuktiSampahRoute(id, bukti)}" alt="Bukti Sampah" style="max-width: 100%; height: auto;">
            <h4>Alamat Bank Sampah</h4>
            <div id="mapSwoll" style="height: 400px;"></div>
            `,
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: "Tutup",
            focusConfirm: false,
            didOpen: () => {
                function initMap(latitude, longitude) {
                    const initialLocation = { lat: latitude, lng: longitude };

                    const map = new google.maps.Map(document.getElementById('mapSwoll'), {
                        center: initialLocation,
                        zoom: 15
                    });

                    const searchLocation = `${bankSampah}, ${alamat}`;
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
                                    const name = bankSampah;
                                    const address = result.formatted_address;

                                    const marker = new google.maps.Marker({
                                        position: location,
                                        map: map,
                                        title: name
                                    });

                                    const infoWindow = new google.maps.InfoWindow({
                                        content: `
                                            <h3 style="font-size:12pt; font-weight:bold;">${name}</h3>
                                            <p style="font-size:8pt;">${address}</p>
                                        `,
                                        maxWidth: 300
                                    });

                                    marker.addListener('click', function () {
                                        infoWindow.open(map, marker);
                                    });
                                })
                            }
                        })
                    }

                    performTextSearch(request, map);
                }

                function getLocation() {

                    const latitude = lang;
                    const longitude = long;

                    initMap(latitude, longitude);
                }
                getLocation();
            }
        });
    });

    function getBuktiSampahRoute(id, gambar) {
        return `/pemilik/bukti/${id}/${gambar}`;
    }

});
