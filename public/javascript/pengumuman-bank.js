$(document).ready(function () {
    const cardsPerPage = 3;
    const cardContainer = $('.card-container');
    const totalCards = cardContainer.children().length;
    const authData = document.getElementById('authData');
    const csrf = authData.getAttribute('data-csrf');
    let currentPage = 1;

    function showPage(page) {
        const startIndex = (page - 1) * cardsPerPage;
        const endIndex = startIndex + cardsPerPage;

        cardContainer.children().each(function (index) {
            $(this).toggle(index >= startIndex && index < endIndex);
        });
    }

    function updatePagination() {
        const totalPages = Math.ceil(totalCards / cardsPerPage);
        const prevPageBtn = $('#prev-page');
        const nextPageBtn = $('#next-page');

        prevPageBtn.toggleClass('disabled', currentPage === 1);
        nextPageBtn.toggleClass('disabled', currentPage === totalPages);

        // Remove existing page indicators
        $('.page-indicator').remove();

        // Add page indicators dynamically
        for (let i = 1; i <= totalPages; i++) {
            const pageIndicator = $('<li class="page-item"><a class="page-link page-indicator" href="#">' + i + '</a></li>');
            pageIndicator.on('click', function () {
                currentPage = i;
                showPage(currentPage);
                updatePagination();
            });
            $('.pagination').children('#next-page').before(pageIndicator);
        }
    }

    function getCurrentDate() {
        const today = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        return today.toLocaleDateString('id-ID', options);
    }

    function formatDate(tanggal) {
        const today = new Date(tanggal);
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        return today.toLocaleDateString('id-ID', options);
    }

    $('#prev-page').on('click', function (e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
            updatePagination();
        }
    });

    $('#next-page').on('click', function (e) {
        e.preventDefault();
        const totalPages = Math.ceil(totalCards / cardsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            showPage(currentPage);
            updatePagination();
        }
    });

    showPage(currentPage);
    updatePagination();

    // Buat Pengumuman
    $('#buatPengumuman').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: `Buat Pengumuman<p class="text-muted m-0 p-0" style="font-size:14">${getCurrentDate()}</p>`,
            html: `
                        <form action="" method="POST" id="orderForm" enctype="multipart/form-data">
                            <div class="mb-3 text-start">
                                <label for="judulPengumuman" class="form-label">Judul Pengumuman</label>
                                <input type="text" class="form-control" id="judulPengumuman" name="judulPengumuman" placeholder="Masukan judul pengumuman..." required>
                            </div>

                            <div class="mb-3 text-start">
                                <label for="isiPengumuman" class="form-label">Isi Pengumuman</label>
                                <textarea class="form-control" id="isiPengumuman" name="isiPengumuman" placeholder="Tuliskan isi pengumuman..." rows="3" required></textarea>
                            </div>
                        </form>`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: "Buat",
            cancelButtonText: "Batal",
            preConfirm: () => {
                const judulPengumuman = Swal.getPopup().querySelector('#judulPengumuman').value;
                const isiPengumuman = Swal.getPopup().querySelector('#isiPengumuman').value;;

                const formData = new FormData();
                formData.append('_token', csrf);
                formData.append('judulPengumuman', judulPengumuman);
                formData.append('isiPengumuman', isiPengumuman);
                $.ajax({
                    type: 'POST',
                    url: '/pengambil/dashboard/pengumuman/buatPengumuman',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response)
                        window.location.href = '/pengambil/dashboard/pengumuman';
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            },
        });
    })

    // Edit Pengumuman
    $('.edit').click(function (e) {
        e.preventDefault();

        var idAwal = $(this).data('id');
        var judulPengumumanAwal = $(this).data('judulpengumuman');
        var isiPengumumanAwal = $(this).data('isipengumuman');
        var tanggalAwal = $(this).data('tanggal');

        Swal.fire({
            title: `Buat Pengumuman<p class="text-muted m-0 p-0" style="font-size:14">${formatDate(tanggalAwal)}</p>`,
            html: `
                <form action="" method="POST" id="orderForm" enctype="multipart/form-data">
                    <div class="mb-3 text-start">
                        <label for="judulPengumuman" class="form-label">Judul Pengumuman</label>
                        <input type="text" class="form-control" id="judulPengumuman" name="judulPengumuman" placeholder="Masukan judul pengumuman..." value="${judulPengumumanAwal}" required>
                    </div>

                    <div class="mb-3 text-start">
                        <label for="isiPengumuman" class="form-label">Isi Pengumuman</label>
                        <textarea class="form-control" id="isiPengumuman" name="isiPengumuman" placeholder="Tuliskan isi pengumuman..." rows="3" required>${isiPengumumanAwal}</textarea>
                    </div>
                </form>`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: "Simpan",
            cancelButtonText: "Batal",
            preConfirm: () => {
                const judulPengumuman = Swal.getPopup().querySelector('#judulPengumuman').value;
                const isiPengumuman = Swal.getPopup().querySelector('#isiPengumuman').value;

                const formData = new FormData();
                formData.append('_token', csrf);
                formData.append('id', idAwal);
                formData.append('judulPengumuman', judulPengumuman);
                formData.append('isiPengumuman', isiPengumuman);
                $.ajax({
                    type: 'POST',
                    url: '/pengambil/dashboard/pengumuman/editPengumuman',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response)
                        window.location.href = '/pengambil/dashboard/pengumuman';
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            },
        });
    });
});
