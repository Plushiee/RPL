$(document).ready(function () {
    function initializeDataTable(table, startDateId, endDateId, applyFilterBtnId, resetFilterBtnId, dateColumnTarget) {
        if (!$.fn.DataTable.isDataTable(table)) {
            $(table).DataTable({
                columnDefs: [
                    {
                        targets: [dateColumnTarget],
                        type: 'date',
                        render: function (data, type, full, meta) {
                            return moment(data).format('YYYY-MM-DD');
                        }
                    }
                ]
            });
        }

        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var startDate = $('#' + startDateId).val();
                var endDate = $('#' + endDateId).val();
                var columnDate = data[dateColumnTarget];

                if (!startDate && !endDate) {
                    return true;
                }

                var currentDate = moment(columnDate, 'YYYY-MM-DD');
                var startFilter = startDate ? moment(startDate, 'YYYY-MM-DD') : null;
                var endFilter = endDate ? moment(endDate, 'YYYY-MM-DD') : null;

                if (startFilter && endFilter) {
                    return currentDate.isBetween(startFilter, endFilter, null, '[]');
                } else if (startFilter) {
                    return currentDate.isSameOrAfter(startFilter);
                } else if (endFilter) {
                    return currentDate.isSameOrBefore(endFilter);
                }

                return true;
            }
        );

        $('#' + applyFilterBtnId).on('click', function (e) {
            e.preventDefault();
            table.DataTable().draw();
        });

        $('#' + resetFilterBtnId).on('click', function (e) {
            e.preventDefault();
            $('#' + startDateId).val('');
            $('#' + endDateId).val('');
            table.DataTable().draw();
        });

        $('#' + startDateId + ', #' + endDateId).on('change', function () {
            table.DataTable().draw();
        });
    }

    var table = $('#transaksiTable1');
    initializeDataTable(table, 'startDate1', 'endDate1', 'applyFilter1', 'resetFilter1', 5);
    var table2 = $('#transaksiTable2');
    initializeDataTable(table2, 'startDate2', 'endDate2', 'applyFilter2', 'resetFilter1', 6);
});
