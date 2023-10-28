<script>
    new DataTable('#dataTable', {
        "order": [],
        "deferRender": true,
        "processing": true,
        "responsive": true,
        "language": {
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
        },
        ajax: '<?php echo route_to('categories.get.all'); ?>',
        columns: [
            {
                data: 'id'
            },
            {
                data: 'name'
            },
            {
                data: 'slug'
            },
            {
                data: 'actions'
            }
        ]
    });
</script>