<script>
    $(document).on('click', '#updatePlanBtn', function() {

        var id = $(this).data('id');

        var url = '<?php echo route_to('plans.get.info'); ?>';

        $.get(url, {

            id: id

        }, function(response) {

            $('#modalPlan').modal('show');

            $('.modal-title').text('<?php echo lang('Plans.title_edit'); ?>'); // mudaremos depois com o lang
            $('#plans-form').attr('action', '<?php echo route_to('plans.update'); ?>');
            $('#plans-form').find('input[name="id"]').val(response.plan.id);
            $('#plans-form').find('input[name="name"]').val(response.plan.name);
            $('#plans-form').find('input[name="value"]').val(response.plan.value);
            $('#plans-form').find('input[name="adverts"]').val(response.plan.adverts);
            $('#plans-form').find('textarea[name="description"]').val(response.plan.description);

            $('#plans-form').find('input[name="is_highlighted"]').prop('checked', response.plan.is_highlighted);

            $('#plans-form').append("<input type='hidden' name='_method' value='PUT'>");
            $('#boxRecorrences').html(response.recorrences);
            $('#plans-form').find('span.error-text').text('');

        }, 'json').fail(function() {

            toastr.error('Error backend');

        });

    });
</script>