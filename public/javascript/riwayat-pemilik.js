$(document).ready(function () {
    $('.bukti').click(function (e) {
        e.preventDefault();

        // Mendapatkan data dari button yang diklik
        const button = $(this);
        const id = button.data('id');
        const bukti = button.data('bukti');
        const jenis = button.data('jenis');
        const namaLegkap = button.data('namaLegkap');
        const nomor = button.data('nomor');

        Swal.fire({
            title: "Informasi Lainnya",
            html: `
            <div class="container-fluid">
                <h4>Bukti Barang</h4>
                <img src="${getBuktiSampahAmbilRoute(jenis, id, bukti)}" alt="Bukti Sampah" style="max-width: 100%; height: auto;">
                <div class="row mt-1">
                    <div class="col-6">
                        <b>Nama Pengambil</b>
                    </div>
                    <div class="col-6">
                        <b>Nomor Telepon</b>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        ${namaLegkap}
                    </div>
                    <div class="col-6">
                        ${nomor}                  
                    </div>
                </div>
            </div>
            `,
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: "Tutup",
            focusConfirm: false,
        });
    });

    function getBuktiSampahAmbilRoute(jenis, id, gambar) {
        return `/pemilik/bukti/ambildirumah/${jenis}/${id}/${gambar}`;
    }

    $('.informasi').click(function (e) {
        e.preventDefault();

        // Mendapatkan data dari button yang diklik
        const button = $(this);
        const id = button.data('id');
        const bankSampah = button.data('banksampah');
        const alamat = button.data('alamat');
        const bukti = button.data('bukti');
        const lang = parseFloat(button.data('lang'));
        const long = parseFloat(button.data('long'));

        Swal.fire({
            title: "Informasi Lainnya",
            html: `
            <h4>Bukti Barang</h4>
            <img src="${getBuktiSampahAntarRoute(id, bukti)}" alt="Bukti Sampah" style="max-width: 100%; height: auto;">
            <br><h4>Alamat Bank Sampah</h4>
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

                    const marker = new google.maps.Marker({
                        position: initialLocation,
                        map: map,
                        title: 'Your Marker Title'  // You can set a title for the marker
                    });

                    const infoWindow = new google.maps.InfoWindow({
                        content:
                        `
                            <h3 style="font-size:12pt; font-weight:bold;">${bankSampah}</h3>
                            <p style="font-size:8pt;">${alamat}</p>
                            <button class="btn btn-info petunjuk">Petunjuk Arah</button>
                        `,
                        maxWidth: 300
                    });

                    google.maps.event.addListener(infoWindow, 'domready', function () {
                        const selectButton = document.querySelector('.petunjuk');
                        selectButton.addEventListener('click', function (event) {
                            event.preventDefault();
                            const url = `https://www.google.com/maps/dir/?api=1&destination=${lang},${long}`;
                            window.open(url, '_blank');
                        })
                    })

                    marker.addListener('click', function () {
                        infoWindow.open(map, marker);
                    });
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

    function getBuktiSampahAntarRoute(id, gambar) {
        return `/pemilik/bukti/antarsendiri/${id}/${gambar}`;
    }
});
