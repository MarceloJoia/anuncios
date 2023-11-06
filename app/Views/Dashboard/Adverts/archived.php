<?php echo $this->extend('Dashboard/Layout/main'); ?>

<?= $this->section('title') ?>
<?php echo lang('Adverts.title_index'); ?>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<!-- Data Table -->
<link href="https://cdn.datatables.net/v/bs4/dt-1.13.6/r-2.5.0/datatables.min.css" rel="stylesheet">

<style>
	/** Para acompanhar o estilo dos inputs */
	select {
		height: 50px !important;
	}

	#dataTable_filter .form-control {
		height: 30px !important;
	}

	/** Criamos a classe .modal-xl que não tem nessa versão do bootstrap do template */
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
							<a href="<?php echo route_to('my.adverts'); ?>" class="btn btn-sm btn-success float-right mb-4"><i class="bi bi-arrow-left-square"></i>&nbsp;<?php echo lang('App.btn_back'); ?></a>
						</div>

						<div class="col-12">
							<table class="table table-borderless table-striped" id="dataTable">
								<thead>
									<tr>
										<th scope="col" class="all"><?php echo lang('Adverts.label_title'); ?></th>
										<th scope="col" class="none"><?php echo lang('Adverts.label_code'); ?></th>
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

<?= $this->endSection() ?>



<?= $this->section('scripts') ?>
<!-- Data Table -->
<script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/r-2.5.0/datatables.min.js"></script>

<!-- Sweet Alert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Fim Sweet Alert2 -->

<?php echo $this->include('Dashboard/Adverts/Scripts/_datatable_all_archived'); ?>


<script>
	function refreshCSRFToken(token) {
		$('[name="<?php echo csrf_token(); ?>"]').val(token);
		$('meta[name="<?php echo csrf_token(); ?>"]').attr('content', token);
	}
</script>


<?= $this->endSection(); ?>