<script>
    $(document).on('change', '[name="zipcode"]', function() {

        let zipcode = $(this).val();


        if (zipcode.length === 9) {

            zipcode = zipcode.replace('-', '');

            var url = `https://viacep.com.br/ws/${zipcode}/json/`;

            $.get(url, function(response) {

                $('#adverts-form').find('input[name="street"]').val(response.logradouro);
                $('#adverts-form').find('input[name="neighborhood"]').val(response.bairro);
                $('#adverts-form').find('input[name="city"]').val(response.localidade);
                $('#adverts-form').find('input[name="state"]').val(response.uf);

                $('#adverts-form').find('span.error-text').text('');

            }, 'json').fail(function() {

                toastr.error("Não foi possível consultar o CEP.");

            });

        }

    });
</script>