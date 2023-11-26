$(document).ready(function () {
    $('.informasi').click(function (e) {
        e.preventDefault();

        // Mendapatkan data dari button yang diklik
        const button = $(this);
        const id = button.data('id');
        const bukti = button.data('bukti');
        const alamat = button.data('alamat');
        const lang = parseFloat(button.data('lang'));
        const long = parseFloat(button.data('long'));

        Swal.fire({
            title: "Informasi Lainnya",
            html: `
            <h4>Bukti Barang</h4>
            <img src="${getBuktiSampahAmbilRoute(id, bukti)}" alt="Bukti Sampah" style="max-width: 100%; height: auto;">
            `,
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: "Tutup",
            focusConfirm: false,
        });
    });
    function getBuktiSampahAmbilRoute(id, gambar) {
        return `/bank/bukti/antarsendiri/${id}/${gambar}`;
    }
});
