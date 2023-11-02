<?php echo $this->extend('Manager/Layout/main'); ?>


<?= $this->section('title') ?>
<?php echo lang('Categories.title_index') ?? ''; ?>
<?= $this->endSection() ?>



<?= $this->section('styles') ?>
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="container-fluid">
    <h3 class="mt-4"><i class="bi bi-tags-fill"></i>&nbsp;<?php echo lang('Categories.title_index') ?? ''; ?></h3>
</div>

<div class="container-fluid pt-3">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h5>
                        <?php echo lang('Categories.title_index'); ?>
                        <button id="createCategoryBtn" class="btn btn-success btn-sm float-end"><i class="bi bi-bookmark-plus"></i>&nbsp;<?php echo lang('App.btn_new'); ?></button>
                    </h5>
                </div>

                <div class="card-body">

                    <a class="btn btn-primary btn-sm mt-2 mb-4" href="<?php echo route_to('categories.archived'); ?>"><i class="bi bi-archive"></i>&nbsp;<?php echo lang('App.btn_all_archived'); ?></a>

                    <table class="table table-borderless table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"><?php echo lang('Categories.label_name'); ?></th>
                                <th scope="col"><?php echo lang('Categories.label_slug'); ?></th>
                                <th scope="col"><?php echo lang('App.btn_actions'); ?></th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="categoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo lang('Categories.title_new'); ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Inicio Form -->
            <?php echo form_open(route_to('categories.create'), ['id' => 'categories-form'], ['id' => '']); ?>

            <div class="modal-body">

                <div class="mb-3">
                    <label for="name" class="form-label"><?php echo lang('Categories.label_name'); ?></label>
                    <input type="text" class="form-control" id="name" name="name">
                    <span class="text-danger error-text name"></span>
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="form-label"><?php echo lang('Categories.label_parent_name'); ?></label>
                    <!-- Será populado pelo JavaScript -->
                    <span id="boxParents"></span>
                    <span class="text-danger error-text parent_id"></span>
                </div>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-square"></i>&nbsp;<?php echo lang('App.btn_close'); ?></button>
                <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-floppy"></i>&nbsp;<?php echo lang('App.btn_save'); ?></button>
            </div>

            <?php echo form_close(); ?>
            <!-- Fim Form -->

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<!-- Data Table -->
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>
<!-- Fim Data Table -->

<?php echo $this->include('Manager/Categories/Scripts/_datatable_all'); ?>
<?php echo $this->include('Manager/Categories/Scripts/_get_category_info'); ?>
<?php echo $this->include('Manager/Categories/Scripts/_submit_modal_create_update'); ?>
<?php echo $this->include('Manager/Categories/Scripts/_show_modal_to_create'); ?>
<?php echo $this->include('Manager/Categories/Scripts/_archive_category'); ?>

<script>
    function refreshCSRFToken(token) {
        $('[name="<?php echo csrf_token(); ?>"]').val(token);
        $('meta[name="<?php echo csrf_token(); ?>"]').attr('content', token);
    }
</script>



<?= $this->endSection(); ?>