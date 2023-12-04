@extends('templates.laporan-pdf')

@section('title', 'MoneyTrash! - Laporan')
@section('css')
    <link rel="stylesheet" href="/assets/styles/akun-pengguna.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

@endsection

@section('contents')
    <!-- Your Content Here -->
    <h2>Laporan Pengambil Sampah Tahun {{ \Carbon\Carbon::now()->year }}</h2>
    <button id="downloadPdfBtn" class="btn btn-primary d-block d-lg-none mb-3">Download PDF</button>

    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Transaksi Pengambilan Sampah</h5>
                    <canvas id="myChart" width="100%" height="400px"
                        style="min-height: 200px; max-height: 500px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Transaksi Pengambilan Sampah</h5>
                    <canvas id="monthlyTransactionsChart" width="100%" height="400px"
                        style="min-height: 200px; max-height: 500px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Peta Penyebaran Pengambilan Sampah</h5>
                    <div id="map" style="width: 100%; height: 600px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg-aZ-Iammau9oEl569JVpJu5olD_2rbQ&callback=initMap&libraries=places">
    </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var jenisSampah = {!! $jenisSampah !!};
        var banyakTransaksi = {!! $totalTransactions !!};

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: jenisSampah,
                datasets: [{
                    label: 'Banyak Pengambilan Sampah ',
                    data: banyakTransaksi,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                }
            }
        });

        var labels = {!! $labels !!};
        var transactionsPerMonth = {!! $transactionsPerMonth !!};

        var ctx2 = document.getElementById('monthlyTransactionsChart').getContext('2d');
        var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Banyak Transaksi Per Bulan',
                    data: transactionsPerMonth,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                }
            }
        });

        function initMap(latitude, longitude) {
            var locations = {!! json_encode($userLocations) !!};

            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                zoom: 13
            });

            locations.forEach(function(location) {
                const langs = parseFloat(location.lang);
                const longs = parseFloat(location.long);
                var latLng = new google.maps.LatLng(langs, longs);

                var outlineCircle = new google.maps.Circle({
                    center: latLng,
                    radius: 60,
                    strokeColor: 'red',
                    strokeOpacity: 0.8,
                    strokeWeight: 3,
                    fillOpacity: 0,
                    map: map
                });

                var filledCircle = new google.maps.Circle({
                    center: latLng,
                    radius: 60,
                    strokeWeight: 0,
                    fillColor: 'red',
                    fillOpacity: 0.2,
                    map: map
                });
            });
        }
l
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
    </script>
@endsection
