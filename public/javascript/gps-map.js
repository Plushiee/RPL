$(document).ready(function () {
    var count = 0;

    function initMap(latitude, longitude) {
        const initialLocation = { lat: latitude, lng: longitude };

        const map = new google.maps.Map(document.getElementById('map'), {
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
                url: '../assets/images/dot-map.png',
                scaledSize: new google.maps.Size(iconSize.width, iconSize.height),
            },
            title: 'You are here!'
        });

        const searchLocation = "Bank Sampah Yogyakarta";
        const request = {
            query: searchLocation,
            fields: ['name', 'geometry', 'formatted_address']
        };
        const service = new google.maps.places.PlacesService(map);

        function performTextSearch(request, map) {
            service.textSearch(request, (results, status, pagination) => {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    results.forEach((result) => {
                        const location = result.geometry.location;
                        const name = result.name;
                        const address = result.formatted_address;
                        
                        const marker = new google.maps.Marker({
                            position: location,
                            map: map,
                            title: name
                        });

                        const infoWindow = new google.maps.InfoWindow({
                            content: `<h3 style="font-size:12pt; font-weight:bold;">${name}</h3><p style="font-size:8pt;">${address}</p>`,
                            maxWidth: 300 
                        });

                        // Tambahkan event listener untuk menampilkan info window ketika marker diklik
                        marker.addListener('click', function () {
                            infoWindow.open(map, marker);
                        });
                    });
                    
                    count = results.length;

                    // Periksa apakah ada halaman berikutnya hasil pencarian
                    if (pagination.hasNextPage) {
                        // Ambil halaman berikutnya
                        pagination.nextPage();
                    }
                }
                new numberRush('jumlahMitra', {
                    maxNumber: count,
                    steps: 1,
                    speed: 0.5,
                })
            });
        }
        performTextSearch(request, map);
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