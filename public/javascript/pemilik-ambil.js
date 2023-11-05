$(document).ready(function () {

    $('.organik').click(function (e) {
        e.preventDefault();

        // Inisialisasi variabel alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue
        let alamatValue, kecamatanValue, kotaValue, provinsiValue, kodePosValue;

        Swal.fire({
            title: "Buat Pesanan Pengambilan Sampah Organik",
            html: `
                <form action="php/proses-tambah_Nikolaus-Pastika-Bara-Satyaradi.php" method="POST">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nama" placeholder="Nama Pemilik Sampah" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nomor" placeholder="Nomor Handphone (+62xxx)" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="alamat" class="form-label">Alamat Pengambilan</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="kecamatan" placeholder="Kecamatan" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="kota" placeholder="Kota atau Kabupaten" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="provinsi" placeholder="Provinsi" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="number" name="kodePos" placeholder="Kode Pos" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="catatan" class="form-label">Catatan Tambahan</label>
                        <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="number" name="berat" placeholder="Berat" min="0" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="bukti" class="form-label">Bukti Barang</label>
                        <input class="form-control" type="file" name="bukti" accept="image/*" required>
                    </div>
                </form>`,
            showCancelButton: true,
            confirmButtonText: "Selanjutnya",
            cancelButtonText: "Tutup",
            focusConfirm: false,
            showLoaderOnConfirm: true,
            preConfirm: () => {
                alamatValue = Swal.getPopup().querySelector("textarea[name='alamat']").value;
                kecamatanValue = Swal.getPopup().querySelector("input[name='kecamatan']").value;;
                kotaValue = Swal.getPopup().querySelector("input[name='kota']").value;
                provinsiValue = Swal.getPopup().querySelector("input[name='provinsi']").value;
                kodePosValue = Swal.getPopup().querySelector("input[name='kodePos']").value;
            },
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Peta Lokasi",
                    html: `
                        <div id="mapSwoll" style="height: 300px;"></div>`,
                    showCancelButton: true,
                    confirmButtonText: "Simpan",
                    cancelButtonText: "Tutup",
                    didOpen: () => {
                        const map = new google.maps.Map(document.getElementById("mapSwoll"), {
                            center: { lat:  -7.7956 , lng: 110.3695 }, // Koordinat awal peta
                            zoom: 8,
                        });

                        const geocoder = new google.maps.Geocoder();
                        const fullAddress = `${alamatValue}, ${kecamatanValue}, ${kotaValue}, ${provinsiValue}, ${kodePosValue}`;

                        geocoder.geocode({ address: fullAddress }, (results, status) => {
                            if (status === "OK" && results.length > 0) {
                                const location = results[0].geometry.location;
                                map.setCenter(location); // Mengatur pusat peta ke lokasi yang ditemukan
                                new google.maps.Marker({ map, position: location }); // Menambahkan marker pada lokasi tersebut
                            }
                        });
                    },
                });
            }
        });
    });
});
