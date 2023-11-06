<script>
    //=> Quando tiver uma mudanção no elemento "[name="zipcode"]-CEP do anúncio" execute o conteúdo 
    $(document).on('change', '[name="zipcode"]', function() {

        /** @var any zipcode Recebe o valor digitado no campo CEP */
        let zipcode = $(this).val();

        // verifica a quantidade de caracteres
        if (zipcode.length === 9) {
            zipcode = zipcode.replace('-', ''); //==> Remover o sinal ( - )

            //=> Fazer o Request <=//
            //=> Par onde será enviado?
            var url = `https://viacep.com.br/ws/${zipcode}/json/`;

            $.get(url, function(response) {
                console.log(response);
                $('[name="street"]').val(response.logradouro);
                $('[name="neighborhood"]').val(response.bairro);
                $('[name="city"]').val(response.localidade);
                $('[name="state"]').val(response.uf);
                //=> Limpar os erros
                $('#adverts-form').find('span.error-text').text('');

            }, 'json').fail(function() {
                toastr.error('Não foi possível consultar o CEP.');
            });

        }
    });
</script>