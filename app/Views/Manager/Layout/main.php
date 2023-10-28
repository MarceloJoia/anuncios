<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Marcelo Joia" />
    <meta name="<?php echo csrf_token(); ?>" content="<?php echo csrf_hash(); ?>" class="csrf" />

    <title><?php echo $this->renderSection('title', true) ?> :: <?php echo env('APP_NAME'); ?></title>

    <!-- Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="<?php echo site_url('manager_assets/assets/favicon.ico'); ?>" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?php echo site_url('manager_assets/css/styles.css'); ?>" rel="stylesheet" />

    <!-- toastr CSS -->
    <link href="<?php echo site_url('manager_assets/toastr/toastr.min.css'); ?>" rel="stylesheet" />

    <style>
        /**
        * Quando clicar no menu da sidebar, ajustar o layout da tabela
        */
        .dataTables_scrollHeadInner,
        .table {
            width: 100% !important
        }

        .btn-sm {
            padding: 6px 20px;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: .2rem;
        }

        .img-custom {
            max-width: 50% !important;
        }
    </style>

    <?php echo $this->renderSection('styles'); ?>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light"><?php echo env('APP_NAME'); ?></div>
            <div class="list-group list-group-flush">

                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?php echo route_to('manager'); ?>"><i class="bi bi-house-fill"></i>&nbsp;<?php echo lang('App.sidebar.manager.home'); ?></a>

                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?php echo route_to('categories'); ?>"><i class="bi bi-tags-fill"></i>&nbsp;<?php echo lang('App.sidebar.manager.categories'); ?></a>

                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?php echo route_to('plans'); ?>"><i class="bi bi-tags-fill"></i>&nbsp;<?php echo lang('App.sidebar.manager.plans'); ?></a>

            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <!-- Menu de navegação  -->
                    <button class="btn btn-primary" id="sidebarToggle"><i class="bi bi-list"></i></button>
                    <!-- Fim Menu de navegação  -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>


                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $language; ?></a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="<?php echo $urls->url_pt_br; ?>">Português Brasil</a>
                                    <a class="dropdown-item" href="<?php echo $urls->url_en; ?>">English</a>
                                    <a class="dropdown-item" href="<?php echo $urls->url_es; ?>">Españhol</a>

                                </div>
                            </li>
                        </ul>
                    </div>


                </div>
            </nav>














            <!-- Page content-->
            <?php echo $this->renderSection('content'); ?>
            <!-- Fim Page content-->

        </div>

    </div>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Scripts-->

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?php echo site_url('manager_assets/js/scripts.js'); ?>"></script>

    

    <!-- toastr js -->
    <script src="<?php echo site_url('manager_assets/toastr/toastr.min.js'); ?>"></script>

    <?php echo $this->renderSection('scripts'); ?>
    <!-- Fim Scripts-->

</body>

</html>