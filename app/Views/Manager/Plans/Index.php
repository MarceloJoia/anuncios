<?php echo $this->extend('Manager/Layout/main'); ?>


<?= $this->section('title') ?>
<?php echo lang('Plans.title_index') ?? ''; ?>
<?= $this->endSection() ?>



<?= $this->section('styles') ?>
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="container-fluid">
    <h3 class="mt-4"><i class="bi bi-tags-fill"></i>&nbsp;<?php echo lang('Plans.title_index') ?? ''; ?></h3>
</div>

<div class="container-fluid pt-3">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h5>
                        <?php echo lang('Plans.title_index'); ?>
                        <button id="createPlanBtn" class="btn btn-success btn-sm float-end"><i class="bi bi-bookmark-plus"></i>&nbsp;<?php echo lang('App.btn_new'); ?></button>
                    </h5>
                </div>

                <div class="card-body">
                    <a class="btn btn-primary btn-sm mt-2 mb-4" href="<?php echo route_to('plans.archived'); ?>"><i class="bi bi-archive"></i>&nbsp;<?php echo lang('App.btn_all_archived'); ?></a>

                    <table class="table table-borderless table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo lang('Plans.label_code'); ?></th>
                                <th scope="col"><?php echo lang('Plans.label_name'); ?></th>
                                <th scope="col"><?php echo lang('Plans.label_is_highlighted'); ?></th>
                                <th scope="col"><?php echo lang('Plans.label_details'); ?></th>
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
<?php echo $this->include('Manager/Plans/_modal_plan'); ?>

<?= $this->endSection() ?>



<?= $this->section('scripts') ?>
<!-- Data Table -->
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>
<!-- Fim Data Table -->

<!-- Mascaras -->
<script src="<?php echo site_url('manager_assets/mask/app.js'); ?>"></script>
<script src="<?php echo site_url('manager_assets/mask/jquery.mask.min.js'); ?>"></script>

<?php echo $this->include('Manager/Plans/Scripts/_datatable_all'); ?>
<?php echo $this->include('Manager/Plans/Scripts/_show_modal_to_create'); ?>
<?php echo $this->include('Manager/Plans/Scripts/_submit_modal_create_update'); ?>
<?php echo $this->include('Manager/Plans/Scripts/_get_plan_info'); ?>
<?php echo $this->include('Manager/Plans/Scripts/_archive_plan'); ?>

<script>
    function refreshCSRFToken(token) {
        $('[name="<?php echo csrf_token(); ?>"]').val(token);
        $('meta[name="<?php echo csrf_token(); ?>"]').attr('content', token);
    }
</script>



<?= $this->endSection(); ?>