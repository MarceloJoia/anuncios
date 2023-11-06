<?php echo $this->extend('Web/Layout/main'); ?>


<?php echo $this->section('title'); ?> <?php echo $title ?? ''; ?> <?php $this->endSection(); ?>


<?php echo $this->section('styles'); ?>
<!-- Para acompanhar o estilo dos inputs-->
<style>
    select {
        height: 50px !important;
    }
</style>
<?php echo $this->endSection(); ?>



<?php echo $this->section('content'); ?>


<section class="section pt-4">

    <div class="container mb-5">

        <div id="div-checkout" class="container shadow-lg p-5">

            <div class="row">

                <div class="col-md-3 order-md-2 mb-4">

                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $plan->name; ?></h6>
                            </div>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo number_to_currency($plan->value, 'BRL', 'pt-BR', 2); ?></h6>
                                <small class="text-muted"><?php echo $plan->details(); ?></small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total</span>
                            <strong><?php echo number_to_currency($plan->value, 'BRL', 'pt-BR', 2); ?></strong>
                        </li>
                    </ul>
                </div>



                <div class="col-md-9 order-md-1 border-end">

                    <?php echo form_open(route_to('pay', $plan->id), ['id' => 'form-pay']); ?>

                    <h4 class="mb-3">Escolha a Forma de pagamento</h4>

                    <div id="error_gn"></div>

                    <div class="my-3 ml-3">
                        <div class="form-check">
                            <input id="credit" name="payment_method" value="credit" type="radio" class="form-check-input" <?php echo session()->has('billet') ? '' : 'checked'; ?>>
                            <label class="form-check-label" for="credit">Cartão de crédito</label>
                            <span class="text-danger error-text payment_method"></span>
                        </div>
                        <div class="form-check">
                            <input id="billet" name="payment_method" value="billet" type="radio" class="form-check-input" <?php echo session()->has('billet') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="billet">Boleto bancário</label>
                            <span class="text-danger error-text payment_method"></span>
                        </div>
                    </div>

                    <div class="row credit">
                        <div class="col-md-6 mb-3">
                            <label for="card_number">Número do cartão</label>
                            <input type="text" name="card_number" class="card_number form-control" id="card_number" placeholder="">
                            <span class="text-danger error-text card_number"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="card_expiration_date">Data de expiração</label>
                            <input type="date" name="card_expiration_date" class="form-control" id="card_expiration_date" placeholder="">
                            <span class="text-danger error-text card_expiration_date"></span>
                        </div>
                    </div>
                    <div class="row credit">
                        <div class="col-md-6 mb-3">
                            <label for="card_cvv">CVV do cartão</label>
                            <input type="text" name="card_cvv" class="card_ccv form-control" id="card_cvv" placeholder="">
                            <span class="text-danger error-text card_cvv"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="card_brand">Bandeira do cartão</label>

                            <select id="card_brand" name="card_brand" class="form-control">

                                <option value="">Escolha</option>
                                <option value="visa">Visa</option>
                                <option value="elo">Elo</option>
                                <option value="mastercard">Master Card</option>
                                <option value="amex">Américan Express</option>
                                <option value="hipercard">Hiper Card</option>

                            </select>
                            <span class="text-danger error-text card_brand"></span>

                        </div>
                    </div>

                    <div class="row credit">

                        <div class="col-md-3 mb-3">
                            <label for="cep">CEP</label>
                            <input type="text" name="zipcode" class="form-control cep" placeholder="">
                            <span class="text-danger error-text zipcode"></span>
                        </div>

                        <div class="col-md-9 mb-3">
                            <label for="street">Endereço</label>
                            <input type="text" name="street" class="form-control">
                            <span class="text-danger error-text street"></span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="city">Cidade</label>
                            <input type="text" name="city" class="form-control">
                            <span class="text-danger error-text city"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="neighborhood">Bairro</label>
                            <input type="text" name="neighborhood" class="form-control" placeholder="">
                            <span class="text-danger error-text neighborhood"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="number">Nº</label>
                            <input type="text" name="number" class="form-control" placeholder="">
                            <span class="text-danger error-text number"></span>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label for="state">Estado</label>
                            <input type="text" name="state" class="form-control uf">
                            <span class="text-danger error-text state"></span>
                        </div>

                    </div>

                    <!-- Data de vencimento quando for boleto -->
                    <div class="row billet d-none">
                        <div class="col-md-6 mb-3">
                            <label for="expire_at">Data de vencimento do boleto</label>
                            <input type="date" name="expire_at" class="expire_at form-control">
                            <span class="text-danger error-text expire_at"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <input type="text" name="payment_token" value="<?php echo old('payment_token'); ?>">
                    </div>


                    <hr class="mb-4">

                    <input type="submit" id="btn-payment" style="cursor: pointer;" class="btn btn-primary btn-lg btn-block btn-gn-payment" value="Finalizar com Cartão">

                    <?php echo form_close(); ?>
                </div>

            </div>
        </div>
    </div>
</section>




<?php echo $this->endSection(); ?>


<?php echo $this->section('scripts'); ?>

<!-- jquery colocamos no template principal --->
<script type="text/javascript" src="<?php echo site_url('manager_assets/mask/jquery.mask.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('manager_assets/mask/app.js') ?>"></script>

<!-- Loading overlay colocamos no template principal --->

<?php //echo $this->include('Web/Home/Scripts/_submit_form_pay'); 
?>
<?php //echo $this->include('Web/Home/Scripts/_viacep'); 
?>


<script>
    function actionBtnBillet() {

        $('.billet').removeClass('d-none');

        $('.credit').hide('slow');

        $("#btn-payment").val('Finalizar com Boleto');

        $("#btn-payment").addClass('btn-success');

    }



    function actionBtnCredit() {

        $('.billet').addClass('d-none');

        $('.credit').show('slow');

        $("#btn-payment").val('Finalizar com Cartão');

        $("#btn-payment").removeClass('btn-success');

    }

    $("[name=payment_method]").on('change', function() {

        var payment_method = $(this).val();

        if (payment_method === 'billet') {


            actionBtnBillet();


        } else {

            // Cartão de crédito

            actionBtnCredit();
        }

    });
</script>



<!-- 

Link para os scripts: https://dev.gerencianet.com.br/docs/pagamento-com-cartao#section-1-1-obten-o-do-payment_token

-->
<?php if (env('CI_ENVIRONMENT') === 'development') : ?>


    <?php //echo $this->include('Web/Home/Scripts/_development');
    ?>


<?php else : ?>


    <?php //echo $this->include('Web/Home/Scripts/_production');
    ?>


<?php endif ?>


<script>
    $gn.ready(function(checkout) {

        $('[name=card_brand]').on('change', function() {

            $('#error_gn').html('');

            $("[name=payment_token]").val('');

            var card_brand = $(this).val();

            if (card_brand) {

                var card_number = $('[name=card_number]').val();
                var card_cvv = $('[name=card_cvv]').val();

                var card_expiration_date = $('[name=card_expiration_date]').val();

                card_expiration_date = card_expiration_date.split('-');

                var expiration_year = card_expiration_date[0];
                var expiration_month = card_expiration_date[1];

                checkout.getPaymentToken({
                    brand: card_brand, // bandeira do cartão
                    number: card_number, // número do cartão
                    cvv: card_cvv, // código de segurança
                    expiration_month: expiration_month, // mês de vencimento
                    expiration_year: expiration_year // ano de vencimento
                }, callback);

                // Invocamos o LoadingOverlay até termos o token do pagamento
                $.LoadingOverlay("show", {
                    image: "",
                    text: 'Estamos validando seu cartão....',
                });

            }

        });


        /**
         * Link para o script: https://dev.gerencianet.com.br/docs/pagamento-com-cartao#section-a-obtendo-um-payment_token-getpaymenttoken-
         */
        var callback = function(error, response) {
            if (error) {
                // Trata o erro ocorrido
                console.error(error);

                // Limpo novamente o select da bandeira
                $('[name=card_brand] option:first').prop('selected', true);

                $('#error_gn').html('<div class="alert alert-warning">' + error.error_description + '</alert>');

            } else {
                // Trata a resposta
                console.log(response);

                $("[name=payment_token]").val(response.data.payment_token);

                // Escondemos o LoadingOverlay
                $.LoadingOverlay("hide", true);
            }
        };

    });
</script>


<script>
    function refreshCSRFToken(token) {

        // Refresh csrf form and meta
        $('[name="<?php echo csrf_token(); ?>"]').val(token);
        $('meta[name="<?php echo csrf_token(); ?>"]').attr('content', token);

    }
</script>

<?php echo $this->endSection(); ?>