<script>
    $(document).on('click', '#createAdvertBtn', function() {

        $('.modal-title').text('<?php echo lang('Adverts.title_new'); ?>');
        $('#modalAdvert').modal('show');

        // $('input[name="id"]').val(''); // limpamos o id
        // $('input[name="_method"]').remove(); // removemos o spoofing
        // $('#adverts-form')[0].reset();
        // $('#adverts-form').attr('action', '<?php echo route_to('adverts.create.my'); ?>');
        // $('#adverts-form').find('span.error-text').text('');



        // var url = '<?php echo route_to('get.categories.situations'); ?>';

        // $.get(url, function(response) {

        //     $('#boxSituations').html(response.situations);
        //     $('#boxCategories').html(response.categories);

        // }, 'json').fail(function() {

        //     toastr.error("We couldn't find the ad");

        // });

    });
</script>