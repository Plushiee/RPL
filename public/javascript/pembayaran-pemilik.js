$(document).ready(function () {
    $('.bukti').on('change', function () {
        // Menjalankan formulir ketika ada perubahan pada input file
        $('#uploadForm').submit();
    });

    $('.lihat').click(function (e) {
        e.preventDefault();

        const button = $(this);
        const id = button.data('id');
        const bukti = button.data('bukti');
    
        Swal.fire({
            title: "Bukti Pembayaran",
            html: `
                <img src="${getBuktiPembayaranRoute(id, bukti)}" alt="Bukti Bayar" style="max-width: 100%; height: auto; margin-bottom: 10px;">
                <a id="downloadLink" class="btn btn-primary">Download</a>
            `,
            showCancelButton: true,
            showConfirmButton: false,
            cancelButtonText: "Tutup",
            focusConfirm: false,
        });
    
        $('#downloadLink').click(function () {
            e.preventDefault();
            const downloadLink = document.createElement('a');
            downloadLink.href = getBuktiPembayaranRoute(id, bukti);
            downloadLink.download = `bukti_pembayaran_${id}.png`;
            
            downloadLink.click();
        });
    });
    
    function getBuktiPembayaranRoute(id, gambar) {
        return `/pemilik/bukti/pembayaran/${id}/${gambar}`;
    }
    

});
