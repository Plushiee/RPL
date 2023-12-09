@extends('templates.laporan-pemilik-pdf')

@section('title', 'MoneyTrash! - Laporan')
@section('css')
    <link rel="stylesheet" href="/assets/styles/akun-pengguna.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

@endsection

@section('contents')
    <!-- Your Content Here -->
    <h2>Laporan Transaksi Pemilik Sampah Tahun {{ \Carbon\Carbon::now()->year }}</h2>
    @if ($tanggalMulai != null && $tanggalAkhir != null)
        <h5>Periode {{ $tanggalMulai }} sampai {{ $tanggalAkhir }}</h5>
    @elseif ($tanggalMulai != null && $tanggalAkhir == null)
        <h5>Periode {{ $tanggalMulai }} sampai {{ \Carbon\Carbon::now() }}</h5>
    @elseif ($tanggalMulai == null && $tanggalAkhir != null)
        <h5>Periode Awal Transaksi sampai {{ $tanggalAkhir }}</h5>
    @endif
    <div class="row">
        <div class="col-12 col-md-12">
            <table id="transaksiTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Bank</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat</th>
                        <th>Jenis Sampah</th>
                        <th>Berat</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kumpulanTransaksi as $index => $transaksi)
                        <tr>
                            <td>{{ $transaksi->idTransaksi }}</td>
                            <td>{{ $transaksi->name }}</td>
                            <td>{{ $transaksi->nomor }}</td>
                            <td>
                                {{ $transaksi->alamat }}({{ $transaksi->catatan }}),
                                {{ $transaksi->kecamatan }}, {{ $transaksi->kota }},
                                {{ $transaksi->provinsi }}, {{ $transaksi->kodePos }}</td>
                            <td>{{ $transaksi->jenisSampah }}</td>
                            <td>{{ $transaksi->berat }} Kg</td>
                            </td>
                            <td>{{ $transaksi->tanggalTransaksi }}</td>
                        </tr>
                        @if (($index + 1) % 8 == 0 && ($index + 1) !== count($kumpulanTransaksi))
                            <tr>
                                <td colspan="6">
                                    {{($index + 1) === count($kumpulanTransaksi)}}
                                    <div style="page-break-before: always;"></div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
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
            function download() {
                var element = document.getElementById('wrapper');
                html2pdf(element, {
                    margin: 0,
                    filename: 'MoneyTrash_Laporan-Pemilik-Antar-Sendiri.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 1
                    },
                    html2canvas: {
                        scale: 2,
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'landscape'
                    }
                });
            };
            setTimeout(() => {
                download();
            }, 1500);
        });
    </script>

@endsection
