<script>
    $('#categories-form').submit(function(e) {

        e.preventDefault();

        var form = this; // Pego esse formulério

        $.ajax({

            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,

            beforeSend: function() {

                // Limpa os erros da requisição anterior
                $(form).find('span.error-text').text('');
            },

            success: function(response) {

                window.refreshCSRFToken(response.token);

                if (response.success == false) {

                    // Erro
                    toastr.error('Verifique os erros e tente novamente');

                    $.each(response.errors, function(field, value) {
                        console.log(field);
                        $(form).find('span.' + field).text(value);
                    });

                    return;
                }

                // Mensagem de sucesso
                toastr.success(response.message);

                //* Mostrar mensage de sucesso com toaster
                $('#categoryModal').modal('hide'); // Esconder a modal
                $(form)[0].reset(); // Ressetar os campos do formulário
                $("#dataTable").DataTable().ajax.reload(null, false); // Atualizar a tabela do Ajax Request
                $('.modal-title').text('Criar categoria'); // mudaremos o titulo para Criar
                $(form).attr('action', '<?php echo route_to('categories.create'); ?>'); // Retornar a rota para Criate
                $(form).find('input[name="id"]').val(''); // Limpara o ID do Input
                $('input[name="_method"]').remove(); // Removo o metodo Spoof
            },

            error: function() {
                alert('Error backend');
            }

        });
    });
</script>