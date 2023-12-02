$(document).ready(function () {
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

    $('.setuju').click(function (e) {
        e.preventDefault();

        const button = $(this);
        const id = button.data('id');
        const bukti = button.data('bukti');

        Swal.fire({
            title: "Bukti Pembayaran",
            html: `<img src="${getBuktiPembayaranRoute(id, bukti)}" alt="Bukti Sampah" style="max-width: 100%; height: auto;">`,
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: "Tutup",
            confirmButtonText: "Approve",
            focusConfirm: false,
            preConfirm() {
                const csrf = $('#csrf').val();
                const id_transaksi = $('#id_transaksi').val();
                console.log(id_transaksi);
                const aksi = 'approved';

                $.ajax({
                    type: "POST",
                    url: "/pengambil/pembayaran/approved",
                    data: {
                        _token: csrf,
                        id_transaksi: id_transaksi,
                        aksi: aksi
                    },
                    success: function (response) {
                        console.log(response);
                        var toastMixin = Swal.mixin({
                            toast: true,
                            icon: 'success',
                            title: 'General Title',
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        toastMixin.fire({
                            animation: true,
                            title: 'Data Pembayaran Berhasil Di Approved'
                        });
                        window.location.href = '/pengambil/pembayaran';
                    },
                    error: function (error) {
                        var toastMixin = Swal.mixin({
                            toast: true,
                            icon: 'error',
                            title: 'General Title',
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        toastMixin.fire({
                            animation: true,
                            title: 'Terdapat Kesalahan, mohon coba kembali nanti'
                        });
                        window.location.href = '/pengambil/pembayaran';
                    }
                });
            },
        });
    });


    function getBuktiPembayaranRoute(id, gambar) {
        return `/pengambil/bukti/pembayaran/${id}/${gambar}`;
    }

});
