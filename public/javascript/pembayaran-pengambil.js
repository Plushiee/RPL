$(document).ready(function () {
    $('.bukti').on('change', function () {
        // Menjalankan formulir ketika ada perubahan pada input file
        $('#uploadForm').submit();
    });

    $('.lihat').click(function (e) {
        e.preventDefault();

        // Mendapatkan data dari button yang diklik
        const button = $(this);
        const id = button.data('id');
        const bukti = button.data('bukti');

        Swal.fire({
            title: "Bukti Pembayaran",
            html: `<img src="${getBuktiPembayaranRoute(id, bukti)}" alt="Bukti Sampah" style="max-width: 100%; height: auto;">`,
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: "Tutup",
            focusConfirm: false,
        });
    });

    function getBuktiPembayaranRoute(id, gambar) {
        return `/pengambil/bukti/pembayaran/${id}/${gambar}`;
    }

});
