$(document).ready(function () {
    // edit pengguna
    $('#editAkun').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Edit Data Akun',
            html: `
                <form action="" method="POST" id="orderForm">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nama" placeholder="Nama Akun" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="nomor" placeholder="Nomor Handphone (+62xxx)" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" name="oldPass" placeholder="Masukan Password Lama" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" name="passBaru" placeholder="Password Baru" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" name="passBaruUlang" placeholder="Ulangi Password Baru" required>
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Save Changes',
            cancelButtonText: 'Cancel',
            focusConfirm: false,
            preConfirm: () => {
                const namaAkun = Swal.getPopup().querySelector("input[name='nama']").value;
                const email = Swal.getPopup().querySelector("input[name='email']").value;
                const nomor = Swal.getPopup().querySelector("input[name='nomor']").value;
                const oldPassword = Swal.getPopup().querySelector("input[name='oldPass']").value;
                const password = Swal.getPopup().querySelector("input[name='passBaru']").value;
                const ulangiPassword = Swal.getPopup().querySelector("input[name='passBaruUlang']").value;

                if (!namaAkun || !email || !nomor || !oldPassword || !password ||
                    !ulangiPassword || !kodePosValue || !berat) {
                        Swal.showValidationMessage("Semua Kolom Harus Terisi!");
                } else {
                    // if (a!) {

                    // } 
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Handle the confirmation (e.g., display success message)
                Swal.fire('Changes Saved!', '', 'success');
            }
        });
    });
});