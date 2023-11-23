$(document).ready(function () {
    $('.informasi').click(function (e) {
        e.preventDefault();

        // Mendapatkan data dari button yang diklik
        const button = $(this);
        const id = button.data('id');
        const bukti = button.data('bukti');
        const jenis = button.data('jenis').toLowerCase();
        const alamat = button.data('alamat');
        const lang = button.data('lang');
        const long = button.data('long');

        Swal.fire({
            title: "Informasi Lainnya",
            html: `
            <h4>Bukti Barang</h4>
            <img src="${getBuktiSampahAmbilRoute(jenis, id, bukti)}" alt="Bukti Sampah" style="max-width: 100%; height: auto;">
            <br><h4>Titik Pengambilan</h4>
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
                        zoom: 20
                    });

                    const marker = new google.maps.Marker({
                        position: initialLocation,
                        map: map,
                        title: 'Your Marker Title'  // You can set a title for the marker
                    });

                    const infoWindow = new google.maps.InfoWindow({
                        content:
                            `
                            <h3 style="font-size:12pt; font-weight:bold;">Titik Pengambilan</h3>
                            <p style="font-size:8pt;">${alamat}</p>
                            <button class="btn btn-info petunjuk">Petunjuk Arah</button>
                        `,
                        maxWidth: 300
                    });

                    marker.addListener('click', function () {
                        infoWindow.open(map, marker);
                    });

                    google.maps.event.addListener(infoWindow, 'domready', function () {
                        const selectButton = document.querySelector('.petunjuk');
                        selectButton.addEventListener('click', function (event) {
                            event.preventDefault();
                            const url = `https://www.google.com/maps/dir/?api=1&destination=${lang},${long}`;
                            window.open(url, '_blank');
                        })
                    })
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
    function getBuktiSampahAmbilRoute(jenis, id, gambar) {
        return `/pengambil/bukti/transaksi/${jenis}/${id}/${gambar}`;
    }
});
