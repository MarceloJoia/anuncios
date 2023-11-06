<script>
    $('#form-pay').submit(function(e) {

        e.preventDefault();

        var form = this;

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            beforeSend: function() {

                $(form).find('span.error-text').text('');

                // Desabilito o botão de submit
                $("#btn-payment").prop('disabled', true);

                $.LoadingOverlay("show", {
                    image: "",
                    text: 'Estamos criando a sua assinatura...',
                });

                setTimeout(function() {
                    $.LoadingOverlay("text", "Definindo a forma de pagamento...");

                    setTimeout(function() {
                        $.LoadingOverlay("text", "Agora estamos finalizando...");
                    }, 5000); // 5 segundos...

                }, 5000); // 5 segundos...

            },
            success: function(response) {

                $("#btn-payment").prop('disabled', false);

                // Escondemos o LoadingOverlay
                $.LoadingOverlay("hide", true);

                window.refreshCSRFToken(response.token);

                // There is validation error?
                if (response.success == false) {

                    // Display an error toast, with a title
                    toastr.error('<?php echo lang('App.danger_validations') ?>');

                    //There is validation errors
                    $.each(response.errors, function(field, value) {

                        console.log(field);

                        // We show each erro on span
                        $(form).find('span.' + field).text(value);

                    });

                    return;

                }

                // Chegou até aqui, então podemos redirecionar para a dashboard tranquilamente
                window.location.href = '<?php echo route_to('dashboard') ?>';

            },
            error: function() {

                // Display a warning toast, with no title
                toastr.warning('Não foi possível realizar a tentativa de pagamento!')

            }
        });

    });
</script>