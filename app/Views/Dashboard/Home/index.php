<?= $this->extend('Dashboard/Layout/main'); ?>


<?= $this->section('title') ?>
<?php echo $title ?? ''; ?>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<section class="dashboard section">
	<!-- Container Start -->
	<div class="container">
		<!-- Row Start -->
		<div class="row">

			<!-- Sidebar -->
			<?php echo $this->include('Dashboard/Layout/_sidebar'); ?>

			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Recently Favorited -->
				<div class="widget dashboard-container my-adslist">
					<!-- Título -->
					<h3 class="widget-header"><?php echo lang('App.sidebar.dashboard.dashboard'); ?></h3>
				</div>
			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</section>

<?= $this->endSection() ?>



<?= $this->section('scripts') ?>
<?= $this->endSection(); ?>