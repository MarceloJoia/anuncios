<?php echo $this->extend('Manager/Layout/main'); ?>


<?= $this->section('title') ?>
<?php echo $title ?? ''; ?>
<?= $this->endSection() ?>



<?= $this->section('styles') ?>

<?= $this->endSection() ?>



<?= $this->section('content') ?>

<div class="container-fluid">
    <h3 class="mt-4"><i class="bi bi-house-fill"></i>&nbsp;<?php echo $title ?? ''; ?></h3>
</div>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>

<?= $this->endSection(); ?>