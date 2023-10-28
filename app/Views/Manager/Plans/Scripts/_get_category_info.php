<script>
    $(document).on('click', '#updateCategoryBtn', function() {

        var id = $(this).data('id');

        var url = '<?php echo route_to('categories.get.info'); ?>';

        $.get(url, {

            id: id

        }, function(response) {

            $('#categoryModal').modal('show');

            $('.modal-title').text('Atualizar categoria'); // mudaremos depois com o lang
            $('#categories-form').attr('action', '<?php echo route_to('categories.update'); ?>');
            $('#categories-form').find('input[name="id"]').val(response.category.id);
            $('#categories-form').find('input[name="name"]').val(response.category.name);
            $('#categories-form').append("<input type='hidden' name='_method' value='PUT'>");
            $('#boxParents').html(response.parents);

            // Limpar os erros anteriores
            $('#categories-form').find('span.error-text').text('');

        }, 'json');


    });
</script>