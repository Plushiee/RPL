$(document).ready(function () {
    // Map
    function initMap(latitude, longitude) {
        // Coordinat awal (default jika geolokasi tidak diizinkan)
        const initialLocation = { lat: latitude, lng: longitude };

        // Buat peta dengan koordinat awal
        const map = new google.maps.Map(document.getElementById('map'), {
            center: initialLocation,
            zoom: 15
        });

        const iconSize = {
            width: 32,  // Set the width you want
            height: 32  // Set the height you want
        };

        // Tambahkan marker di lokasi awal dengan simbol dot biru
        const userMarker = new google.maps.Marker({
            position: initialLocation,
            map: map,
            icon: {
                url: '../assets/images/dot-map.png',
                scaledSize: new google.maps.Size(iconSize.width, iconSize.height),
            },
            title: 'You are here!'
        });
    }

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
});
