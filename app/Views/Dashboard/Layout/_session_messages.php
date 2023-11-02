<div class=" container mt-2">

    <?php if (session()->has('success')) : ?>
        <div class="alert alert-success"><?php echo session('success'); ?></div>
    <?php endif; ?>

    <?php if (session()->has('info')) : ?>
        <div class="alert alert-info"><?php echo session('info'); ?></div>
    <?php endif; ?>

    <?php if (session()->has('danger')) : ?>
        <div class="alert alert-danger"><?php echo session('danger'); ?></div>
    <?php endif; ?>


    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger"><?php echo session('error'); ?></div>
    <?php endif; ?>


    <?php if (session()->has('errors_model')) : ?>
        <ul>
            <?php foreach (session('errors_model') as $error) : ?>
                <li class="text-danger"><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</div>