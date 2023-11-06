<script>
    new DataTable('#dataTable', {
        "pagingType":"numbers",
        "order": [],
        "deferRender": true,
        "processing": true,
        "responsive": true,
        ajax: '<?php echo route_to('get.all.my.archived.adverts'); ?>',
        columns: [
            {
                data: 'title'
            },
            {
                data: 'code'
            },
            {
                data: 'actions'
            },
        ]
    });
</script>