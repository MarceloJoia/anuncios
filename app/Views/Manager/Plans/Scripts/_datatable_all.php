<script>
    new DataTable('#dataTable', {
        "order": [],
        "deferRender": true,
        "processing": true,
        "responsive": true,
        "language": {
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
        },
        ajax: '<?php echo route_to('plans.get.all'); ?>',
        columns: [
            {
                data: 'code'
            },
            {
                data: 'name'
            },
            {
                data: 'is_highlighted'
            },
            {
                data: 'details'
            },
            {
                data: 'actions'
            },
        ]
    });
</script>