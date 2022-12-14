(function () {
    $('#sortTable').DataTable( {
        "order": [[ 3, "desc" ]],
        "pageLength" : 20,
        "paging":   false,
        "ordering": true,
        "info":     false
    });

    $('#limit-records').on('change', function(e) {
        $('#form-limit').submit();
    })
})();