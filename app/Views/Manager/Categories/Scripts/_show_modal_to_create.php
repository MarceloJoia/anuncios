<script>
    $(document).on('click', '#createCategoryBtn', function() {

        $('.modal-title').text('Criar categoria'); // mudaremos depois com o lang
        $('#categoryModal').modal('show'); //=> Mostrar a Modal
        
        $('input[name="id"]').val(''); // limpamos o id

        $('input[name="_method"]').remove(); // removemos o spoofing

        $('#categories-form')[0].reset(); //=> Limpa o formulário
        $('#categories-form').attr('action', '<?php echo route_to('categories.create'); ?>'); //=> Mudar a Action do Form
        $('#categories-form').find('span.error-text').text(''); //=> Limpo todos os erros anteriores

        /** Fazer um Request Re cupera todas as categorias Pai */
        var url = '<?php echo route_to('categories.parents'); ?>';

        $.get(url, function(response) {
            $('#boxParents').html(response.parents);
        }, 'json');
    });
</script>