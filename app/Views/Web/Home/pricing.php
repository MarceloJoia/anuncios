<?php echo $this->extend('Web/Layout/main'); ?>

<?= $this->section('title') ?>
<?php echo $title ?? ''; ?>
<?= $this->endSection() ?>


<?= $this->section('styles') ?>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<section class="popular-deals section bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2><?php echo $title ?? ''; ?></h2>
                    <p>O projeto Vem Pro Bairro é uma iniciativa de fortalecimento do comércio dos bairros e descentralização do comércio.</p>
                </div>
            </div>
        </div>
        <div class="row">

            <?php if (empty($plans)) : ?>
                <div class="col-lg-12">
                    <div class="alert alert-info text-center">No momento não há Planos disponíveis</div>
                </div>
            <?php else : ?>

                <?php foreach ($plans as $plan) : ?>

                    <!-- offer 01 -->
                    <div class="col-sm-12 col-lg-3">
                        <!-- product card -->
                        <div class="product-item bg-light">
                            <div class="card text-center">

                                <div class="card-body">
                                    <h3 class="card-title"><a href="<?php echo route_to('choice', $plan->id); ?>"><?php echo $plan->name; ?></a></h3>

                                    <ul class="list-inline product-meta">
                                        <li class="list-inline-item">
                                            <?php if ($plan->is_highlighted) : ?>
                                                <p class="text-primary">Uma das melhores opções</p>
                                            <?php endif; ?>
                                        </li>
                                        <hr>
                                        <li class="list-inline-item">
                                            <i class="fa fa-money text-success fa-lg"></i> <?php echo $plan->details(); ?>
                                        </li>
                                    </ul>

                                    <p class="card-text"><?php echo $plan->description; ?></p>
                                    <div class="product-ratings">
                                        <ul class="list-inline">
                                            <li class="list-inline-item selected">Anúncios permitidos: <?php echo $plan->adverts(); ?></li>
                                        </ul>
                                    </div>

                                    <hr>

                                    <a href="<?php echo route_to('choice', $plan->id); ?>" class="btn  btn-success btn-sm mt-2"><?php echo lang('Plans.btn_choice'); ?></a>

                                </div>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>
    </div>
</section>


<?= $this->endSection() ?>



<?= $this->section('scripts') ?>
<?= $this->endSection(); ?>