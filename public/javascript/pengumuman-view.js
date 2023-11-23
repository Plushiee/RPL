$(document).ready(function () {
    const cardsPerPage = 3;
    const totalCards = $('.pengumuman-card').length;
    let currentPage = 1;

    function showPage(page) {
        const startIndex = (page - 1) * cardsPerPage;
        const endIndex = startIndex + cardsPerPage;

        $('.pengumuman-card').each(function (index) {
            $(this).toggle(index >= startIndex && index < endIndex);
        });
    }

    function updatePagination() {
        const totalPages = Math.ceil(totalCards / cardsPerPage);
        const prevPageBtn = $('#prev-page');
        const nextPageBtn = $('#next-page');
        const pageIndicatorsContainer = $('#page-indicators');

        prevPageBtn.prop('disabled', currentPage === 1);
        nextPageBtn.prop('disabled', currentPage === totalPages);

        pageIndicatorsContainer.empty();
    }

    $(document).ready(function () {
        showPage(currentPage);
        updatePagination();

        $('#prev-page').on('click', function () {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
                updatePagination();
            }
        });

        $('#next-page').on('click', function () {
            const totalPages = Math.ceil(totalCards / cardsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
                updatePagination();
            }
        });
    });
});