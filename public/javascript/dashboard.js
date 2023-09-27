$(document).ready(function () {
    const $button = document.querySelector('#sidebar-toggle');
    const $sidebarWraper = document.querySelector('#sidebar-wraper');
    const $wrapper = document.querySelector('#wrapper');
    const $icon = document.getElementById('icon')
    var $window = $(window)

    if ($window.width() < 768) {
        $wrapper.classList.add('toggled');
        toogleNavbar();
    }

    function toogleNavbar() {
        if($wrapper.className === 'toggled') {
            document.getElementById('icon-home').style.display = 'none';
            document.getElementById('icon-pembayaran').style.display = 'none';
            document.getElementById('icon-riwayat').style.display = 'none';
            document.getElementById('icon-pengaturan').style.display = 'none';
            document.getElementById('close-sidebar').style.display = 'none';
        } else {
            document.getElementById('icon-home').style.display = 'inline';
            document.getElementById('icon-pembayaran').style.display = 'inline';
            document.getElementById('icon-riwayat').style.display = 'inline';
            document.getElementById('icon-pengaturan').style.display = 'inline';
            document.getElementById('close-sidebar').style.display = 'inline';
        }
    }

    $button.addEventListener('click', (e) => {
        e.preventDefault();
        $wrapper.classList.toggle('toggled');
        toogleNavbar();
    });

    $('#close-sidebar').click(function (e) {
        e.preventDefault();
        $wrapper.classList.toggle('toggled');
        toogleNavbar();

    });

    // Map
    function initMap(latitude, longitude) {
        // Coordinat awal (default jika geolokasi tidak diizinkan)
        const initialLocation = { lat: latitude, lng: longitude };

        // Buat peta dengan koordinat awal
        const map = new google.maps.Map(document.getElementById('map'), {
            center: initialLocation,
            zoom: 15
        });

        // Tambahkan marker di lokasi awal
        const marker = new google.maps.Marker({
            position: initialLocation,
            map: map,
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
