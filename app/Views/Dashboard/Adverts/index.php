<?php echo $this->extend('Dashboard/Layout/main'); ?>

<?= $this->section('title') ?>
<?php echo lang('Adverts.title_index'); ?>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<!-- Data Table -->
<link href="https://cdn.datatables.net/v/bs4/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">

<style>
	/**
     * Para acompanhar o estilo dos inputs
     */
	select {
		height: 50px !important;
	}

	#dataTable_filter .form-control {
		height: 30px !important;
	}


	/**
     * Criamos a classe .modal-xl que não tem nessa versão do bootstrap do template
     */
	@media (min-width: 1200px) {

		.modal-xl {

			max-width: 1140px;
		}
	}
</style>

<?= $this->endSection() ?>


<?= $this->section('content') ?>

<section class="dashboard section">
	<!-- Container Start -->
	<div class="container">
		<!-- Row Start -->
		<div class="row">

			<!-- Sidebar -->
			<?php echo $this->include('Dashboard/Layout/_sidebar'); ?>

			<!-- Título da lista de anúncios -->
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<div class="widget dashboard-container my-adslist">
					<!-- Título -->
					<h3 class="widget-header"><?php echo lang('Adverts.title_index'); ?></h3>

					<!-- Título da lista de anúncios -->
					<div class="row">

						<!-- Botões de ação -->
						<div class="col-md-12">
							<a class="btn btn-primary btn-sm mt-2 mb-4" href="<?php echo route_to('categories.archived'); ?>"><i class="bi bi-archive"></i>&nbsp;<?php echo lang('App.btn_all_archived'); ?></a>

							<button type="button" id="createAdvertBtn" class="btn btn-main-sm add-button float-right mt-2 mb-4"><i class="bi bi-plus-square"></i>&nbsp;<?php echo lang('App.btn_new'); ?></button>
						</div>

						<div class="col-12">
							<table class="table table-borderless table-striped" id="dataTable">
								<thead>
									<tr>
										<th scope="col"><?php echo lang('Adverts.label_image'); ?></th>
										<th scope="col" class="all"><?php echo lang('Adverts.label_title'); ?></th>
										<th scope="col" class="none"><?php echo lang('Adverts.label_code'); ?></th>
										<th scope="col" class="none text-center"><?php echo lang('Adverts.label_category'); ?></th>
										<th scope="col"><?php echo lang('Adverts.label_status'); ?></th>
										<th scope="col" class="none"><?php echo lang('Adverts.label_address'); ?></th>
										<th scope="col" class="all text-center"><?php echo lang('App.btn_actions'); ?></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</section>

<!-- Model Adverts -->
<?php echo $this->include('Dashboard/Adverts/_modal_advert'); ?>

<?= $this->endSection() ?>



<?= $this->section('scripts') ?>
<!-- Data Table -->
<script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/r-2.5.0/datatables.min.js"></script>

<!-- Mascaras -->
<script src="<?php echo site_url('manager_assets/mask/app.js'); ?>"></script>
<script src="<?php echo site_url('manager_assets/mask/jquery.mask.min.js'); ?>"></script>

<?php echo $this->include('Dashboard/Adverts/Scripts/_datatable_all'); ?>
<?php echo $this->include('Dashboard/Adverts/Scripts/_get_my_advert'); ?>
<?php echo $this->include('Dashboard/Adverts/Scripts/_show_modal_to_create'); ?>


<script>
	function refreshCSRFToken(token) {
		$('[name="<?php echo csrf_token(); ?>"]').val(token);
		$('meta[name="<?php echo csrf_token(); ?>"]').attr('content', token);
	}
</script>


<?= $this->endSection(); ?>