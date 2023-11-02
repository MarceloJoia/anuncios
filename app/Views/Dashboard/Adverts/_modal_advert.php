<!-- Modal -->
<div class="modal fade" id="modalAdvert" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo lang('Adverts.title_new'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open(route_to('adverts.create.my'), ['id' => 'adverts-form'], ['id' => '']) ?>
            <div class="modal-body">

                <!-- <div class="form-row">

                    <div class="mb-3 form-group col-md-12">
                        <label for="title" class="form-label"><?php echo lang('Adverts.label_title'); ?></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="<?php echo lang('Adverts.label_title'); ?>">
                        <span class="text-danger error-text title"></span>
                    </div>

                    <div class="mb-3 form-group col-md-3">
                        <label for="situation" class="form-label"><?php echo lang('Adverts.label_situation'); ?></label>
                        <div id="boxSituations"></div>
                        <span class="text-danger error-text situation"></span>
                    </div>

                    <div class="mb-3 form-group col-md-6">
                        <label for="category_id" class="form-label"><?php echo lang('Adverts.label_category'); ?></label>
                        <div id="boxCategories"></div>
                        <span class="text-danger error-text category_id"></span>
                    </div>


                    <div class="mb-3 form-group col-md-3">

                        <label for="price" class="form-label"><?php echo lang('Adverts.label_price'); ?></label>
                        <input type="text" class="money form-control" id="price" name="price" placeholder="<?php echo lang('Adverts.label_price'); ?>">
                        <span class="text-danger error-text price"></span>

                    </div>

                    <div class="mb-3 form-group col-md-3">
                        <label for="zipcode" class="form-label"><?php echo lang('Adverts.label_zipcode'); ?></label>
                        <input type="text" class="cep form-control" id="zipcode" name="zipcode" placeholder="<?php echo lang('Adverts.label_zipcode'); ?>">
                        <span class="text-danger error-text zipcode"></span>
                    </div>


                    <div class="mb-3 form-group col-md-6">
                        <label for="street" class="form-label"><?php echo lang('Adverts.label_street'); ?></label>
                        <input type="text" class="form-control" id="street" name="street" placeholder="<?php echo lang('Adverts.label_street'); ?>">
                        <span class="text-danger error-text street"></span>

                    </div>

                    <div class="mb-3 form-group col-md-3">

                        <label for="number" class="form-label"><?php echo lang('Adverts.label_number'); ?></label>
                        <input type="text" class="form-control" id="number" name="number" placeholder="<?php echo lang('Adverts.label_number'); ?>">
                        <span class="text-danger error-text number"></span>

                    </div>

                    <div class="mb-3 form-group col-md-3">

                        <label for="neighborhood" class="form-label"><?php echo lang('Adverts.label_neighborhood'); ?></label>
                        <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="<?php echo lang('Adverts.label_neighborhood'); ?>">
                        <span class="text-danger error-text neighborhood"></span>

                    </div>

                    <div class="mb-3 form-group col-md-3">

                        <label for="city" class="form-label"><?php echo lang('Adverts.label_city'); ?></label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="<?php echo lang('Adverts.label_city'); ?>">
                        <span class="text-danger error-text city"></span>

                    </div>

                    <div class="mb-3 form-group col-md-3">

                        <label for="state" class="form-label"><?php echo lang('Adverts.label_state'); ?></label>
                        <input type="text" class="uf form-control" id="state" name="state" placeholder="<?php echo lang('Adverts.label_state'); ?>">
                        <span class="text-danger error-text state"></span>

                    </div>

                    <div class="mb-3 form-group col-md-12">
                        <label for="description" class="form-label"><?php echo lang('Adverts.label_description'); ?></label>
                        <textarea name="description" style="min-height: 100px;" class="form-control" placeholder="<?php echo lang('Adverts.label_description'); ?>"></textarea>
                        <span class="text-danger error-text description"></span>

                    </div>

                </div> -->

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm btn-main"><?php echo lang('Adverts.btn_send_for_approval'); ?></button>
                <button type="button" class="btn btn-secondary btn-sm btn-main" data-dismiss="modal"><?php echo lang('App.btn_cancel'); ?></button>
            </div>
            
            <?php echo form_close(); ?>
        </div>
    </div>
</div>