$(document).ready(function () {
    const cardsPerPage = 3;

    function createPagination(containerId) {
        const container = $(`#${containerId}`);
        const cardContainer = $(`.${containerId}`);
        const totalCards = cardContainer.children().length;
        const paginationContainer = $(`#pagination-${containerId.split('-')[2]}`);
        let currentPage = 1;

        function showPage(page) {
            const startIndex = (page - 1) * cardsPerPage;
            const endIndex = startIndex + cardsPerPage;

            container.children().each(function (index) {
                $(this).toggle(index >= startIndex && index < endIndex);
            });
        }

        function updatePagination() {
            const totalPages = Math.ceil(totalCards / cardsPerPage);
            const prevPageBtn = paginationContainer.find('#prev-page');
            const nextPageBtn = paginationContainer.find('#next-page');

            prevPageBtn.toggleClass('disabled', currentPage === 1);
            nextPageBtn.toggleClass('disabled', currentPage === totalPages);

            // Remove existing page indicators
            paginationContainer.find('.page-indicator').remove();

            // Add page indicators dynamically
            for (let i = 1; i <= totalPages; i++) {
                console.log(i)
                const pageIndicator = $('<li class="page-item"><a class="page-link page-indicator" href="#">' + i + '</a></li>');
                pageIndicator.on('click', function () {
                    currentPage = i;
                    showPage(currentPage);
                    updatePagination();
                });
                paginationContainer.children('#next-page').before(pageIndicator);
            }
        }

        paginationContainer.find('#prev-page').on('click', function (e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
                updatePagination();
            }
        });

        paginationContainer.find('#next-page').on('click', function (e) {
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
    }
    createPagination('card-container-1');
    createPagination('card-container-2');
});
