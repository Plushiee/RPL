@extends('templates.laporan-pdf')

@section('title', 'MoneyTrash! - Laporan')
@section('css')
    <link rel="stylesheet" href="/assets/styles/akun-pengguna.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

@endsection

@section('contents')
    <!-- Your Content Here -->
    <h2>Laporan Pengambil Sampah Tahun {{ \Carbon\Carbon::now()->year }}</h2>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Pengambilan Jenis Sampah</h5>
                    <canvas id="myChart" height="250px" style="height: 250px; max-height: 250px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Transaksi Pengambilan Sampah Per Bulan</h5>
                    <canvas id="monthlyTransactionsChart" height="250px" style="height: 250px; max-height: 250px;"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg-aZ-Iammau9oEl569JVpJu5olD_2rbQ&callback=initMap&libraries=places"
        async defer></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"
        integrity="sha512-pdCVFUWsxl1A4g0uV6fyJ3nrnTGeWnZN2Tl/56j45UvZ1OMdm9CIbctuIHj+yBIRTUUyv6I9+OivXj4i0LPEYA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Automatically provides/replaces `Promise` if missing or broken. -->
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>

    <!-- Minified version of `es6-promise-auto` below. -->
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>

    <script>
        $(document).ready(function() {
            function graph() {
                // Jenis sampah
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

                // Transaksi per tahun
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
            };

            // Map peta penyebaran
            function initMap(latitude, longitude) {
                // Data lokasi pengambilan dari PHP
                var locations = {!! json_encode($userLocations) !!};

                // Inisialisasi peta dengan nilai zoom dan pusat
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: latitude,
                        lng: longitude
                    },
                    zoom: 14
                });

                // Menambahkan lingkaran untuk setiap lokasi
                locations.forEach(function(location) {
                    const langs = parseFloat(location.lang);
                    const longs = parseFloat(location.long);
                    var latLng = new google.maps.LatLng(langs, longs);

                    // Garis Lingkaran Luar
                    var outlineCircle = new google.maps.Circle({
                        center: latLng,
                        radius: 60,
                        strokeColor: 'red',
                        strokeOpacity: 0.8,
                        strokeWeight: 3,
                        fillOpacity: 0,
                        map: map
                    });

                    // Lingkaran dalam
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

            // Mendapatkan lokasi pengambil
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

            function download() {
                var element = document.getElementById('wrapper');
                html2pdf(element, {
                    margin: 0,
                    filename: 'MoneyTrash_Laporan-Pengambil.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 1
                    },
                    html2canvas: {
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'landscape'
                    }
                });
            };

            getLocation();
            graph();
            setTimeout(() => {
                download();
            }, 1500);

        });
    </script>
@endsection
