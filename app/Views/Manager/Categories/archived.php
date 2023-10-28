<?php echo $this->extend('Manager/Layout/main'); ?>


<?= $this->section('title') ?>
<?php echo $title ?? ''; ?>
<?= $this->endSection() ?>



<?= $this->section('styles') ?>
<link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="container-fluid">
    <h3 class="mt-4"><i class="bi bi-tags-fill"></i>&nbsp;<?php echo $title ?? ''; ?></h3>
</div>

<div class="container-fluid pt-3">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h5>
                        <?php echo lang('Categories.title_index'); ?>
                        
                    </h5>

                </div>

                <div class="card-body">
                    <a class="btn btn-primary btn-sm mt-2 mb-4" href="<?php echo route_to('categories'); ?>"><i class="bi bi-arrow-left-square"></i>&nbsp;<?php echo lang('App.btn_back'); ?></a>

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

<?= $this->endSection() ?>



<?= $this->section('scripts') ?>

<!-- Data Table -->
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/r-2.5.0/datatables.min.js"></script>
<!-- Fim Data Table -->

<!-- Sweet Alert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Fim Sweet Alert2 -->

<?php echo $this->include('Manager/Categories/Scripts/_datatable_all_archived'); ?>
<?php echo $this->include('Manager/Categories/Scripts/_recover_category');  ?>
<?php echo $this->include('Manager/Categories/Scripts/_delete_category'); ?>


<script>
    function refreshCSRFToken(token) {
        $('[name="<?php echo csrf_token(); ?>"]').val(token);
        $('meta[name="<?php echo csrf_token(); ?>"]').attr('content', token);
    }
</script>



<?= $this->endSection(); ?>