$(document).ready(function () {
    const button = document.getElementById('bukti');
    const id = button.getAttribute('data-id');
    const bukti = button.getAttribute('data-bukti');
    const jenis = button.getAttribute('data-jenis').toLowerCase();

    $('#bukti').click(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Bukti Barang",
            html: `
                <div id="gambarBukti" style="height: 400px;"></div>
            `,
            showCancelButton: true,
            confirmButtonText: "Selanjutnya",
            cancelButtonText: "Tutup",
            focusConfirm: false,
            showLoaderOnConfirm: true,
            didOpen: () => {
                $.ajax({
                    type: "GET",
                    url: `/pemilik/bukti/ambildirumah/${jenis}/${id}/${bukti}`,
                    success: function (response) {
                        console.log (response)
                    }
                });
            }
        })
    });
});
