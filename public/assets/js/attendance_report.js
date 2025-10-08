$(document).ready(function() {
    let selectedUser = null;
    let selectedStart = null;
    let selectedEnd = null;

    // User select event
    $('#userSelect').on('change', function() {
        selectedUser = $(this).val();
        tryFetchReport();
    });

    // Flatpickr change event
    $('#dateRange').on('change', function() {
        const range = $(this).val().split(' to ');
        if (range.length === 2) {
            selectedStart = range[0];
            selectedEnd = range[1];
            tryFetchReport();
        }
    });

    function tryFetchReport() {
        if (!selectedUser || !selectedStart || !selectedEnd) return;

        $.ajax({
            url: '/attendance/report',
            method: 'GET',
            data: {
                user_id: selectedUser,
                range: 'custom',
                start_date: selectedStart,
                end_date: selectedEnd
            },
            beforeSend: function() {
                $('#reportBody').html('<tr><td colspan="4" class="text-center py-3">Loading...</td></tr>');
                $('#reportTable').removeClass('hidden');
            },
            success: function(response) {
                let rows = '';
                response.records.forEach((record, index) => {
                    rows += `
                        <tr>
                            <td class="px-3 py-3 border">${index + 1}</td>
                            <td class="px-3 py-3 border">${record.clock_in}</td>
                            <td class="px-3 py-3 border">${record.clock_out}</td>
                            <td class="px-3 py-3 border">${record.worked}</td>
                        </tr>
                    `;
                });
                $('#reportBody').html(rows || '<tr><td colspan="4" class="text-center py-3">No records found</td></tr>');
            },
            error: function() {
                $('#reportBody').html('<tr><td colspan="4" class="text-center py-3 text-red-600">Error fetching data</td></tr>');
            }
        });
    }
});
