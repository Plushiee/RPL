$(document).ready(function () {
    $('.btn-info').click(function (e) {
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

});
