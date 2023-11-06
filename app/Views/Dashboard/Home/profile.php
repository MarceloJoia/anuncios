<?php echo $this->extend('Dashboard/Layout/main'); ?>

<?php echo $this->section('title') ?>
<?php echo $title ?? ''; ?>
<?= $this->endSection() ?>


<?php echo $this->section('styles') ?>
<?= $this->endSection() ?>


<?php echo $this->section('content') ?>

<section class="dashboard section">
	<!-- Container Start -->
	<div class="container">
		<!-- Row Start -->
		<div class="row">

			<?php echo $this->include('Dashboard/Layout/_sidebar'); ?>

			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Edit Personal Info -->
				<div class="widget personal-info">
					<h3 class="widget-header user">Meus dados</h3>

					<div class="mb-4">
						<a href="<?php echo route_to('access'); ?>" class="btn btn-primary btn btn-main-sm bg-info border-info mb-2"><i class="lni lni-lock"></i>&nbsp;Minha senha</a>
					</div>

					<?php echo form_open(route_to('profile.update'), hidden: $hiddens); ?>

					<div class="row">

						<div class="col-md-6 mb-3">
							<label>Seu nome</label>
							<input type="text" name="name" class="form-control" value="<?php echo old('name', auth()->user()->name); ?>">
						</div>

						<div class="col-md-6 mb-3">
							<label>Seu sobrenome</label>
							<input type="text" name="last_name" class="form-control" value="<?php echo old('last_name', auth()->user()->last_name); ?>">
						</div>

						<div class="col-md-6 mb-3">
							<label>Seu e-mail de acesso </label>
							<input type="email" name="email" class="form-control" value="<?php echo old('email', auth()->user()->email); ?>">
						</div>

						<div class="col-md-6 mb-3">
							<label>Seu CPF </label>

							<input type="text" name="cpf" class="form-control cpf" value="<?php echo old('cpf', auth()->user()->cpf); ?>">
						</div>

						<div class="col-md-6 mb-3">
							<label>Seu telefone celular</label>
							<input type="tel" name="phone" class="form-control sp_celphones" value="<?php echo old('phone', auth()->user()->phone); ?>">
						</div>

						<div class="col-md-6 mb-3">
							<label>Data de nascimento</label>
							<input type="date" name="birth" class="form-control" value="<?php echo old('birth', auth()->user()->birth); ?>">
						</div>



					</div>

					<div class="form-check">
						<label class="form-check-label" for="display_phone">

							<?php echo form_hidden('display_phone', '0') ?>

							<input type="checkbox" name="display_phone" value="1" <?php echo set_checkbox('display_phone', '1', auth()->user()->display_phone); ?> class="form-check-input" id="display_phone">
							Exibir meu telefone nos meus anúncios
						</label>
					</div>



					<button type="submit" class="btn btn-success"><?php echo lang('App.btn_save'); ?></button>

					<?php echo form_close(); ?>
				</div>

			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</section>

<?= $this->endSection() ?>


<?php echo $this->section('scripts') ?>

<script type="text/javascript" src="<?php echo site_url('manager_assets/mask/jquery.mask.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('manager_assets/mask/app.js') ?>"></script>

<?= $this->endSection() ?>