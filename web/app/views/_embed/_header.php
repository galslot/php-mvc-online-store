<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?=baseUrl() ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?= HOME_PAGE ?>/assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= HOME_PAGE ?>/assets/img/favicon.ico">

    <link rel="stylesheet" href="<?= HOME_PAGE ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= HOME_PAGE ?>/assets/css/templatemo.css">
    <link rel="stylesheet" href="<?= HOME_PAGE ?>/assets/css/custom.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">

    <!-- our project just needs Font Awesome Solid + Brands -->
    <link href="<?= HOME_PAGE ?>/assets/fontawesome/css/all.min.css" rel="stylesheet" />
    <link href="<?= HOME_PAGE ?>/assets/fontawesome/css/brands.css" rel="stylesheet" />
    <link href="<?= HOME_PAGE ?>/assets/fontawesome/css/solid.css" rel="stylesheet" />

    <?=$this->getMeta() ?>
</head>
<body>

<!-- Start Top Nav -->
<nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
    <div class="container text-light">
        <div class="w-100 d-flex justify-content-between">
            <div>
                <i class="fa fa-envelope mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                <i class="fa fa-phone mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
            </div>
            <div>
                <a class="text-light" href="https://fb.com/" target="_blank" rel="sponsored"><i class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                <a class="text-light" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
            </div>
        </div>
    </div>
</nav>
<!-- Close Top Nav -->

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-left">

        <a class="navbar-brand text-success logo h2 align-self-left" href="<?=baseUrl() ?>">
            <?=$this->getParam('site_name') ?>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-left collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
            <div class="flex-fill">

                <?php new \app\widgets\menu\MenuWidget([
                    'class' => 'nav navbar-nav d-flex justify-content-between mx-lg-auto',
                    'cache_expire' => 0,
                    'attrs' => ['id' => 'widget_menu_tpl'],
                ]) ?>

            </div>
            <div class="navbar align-self-left d-flex">
                <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                        <div class="input-group-text">
                            <i class="fa fa-fw fa-search"></i>
                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block px-2">
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                </div>
                <div class="dropdown d-inline-block px-2">
                    <a class="nav-icon position-relative text-decoration-none" href="#" id="get-cart-header">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"
                              id="cart-modal-header-cart-quantity"
                        >
                            <?= $_SESSION['cart.quantity'] ?? 0 ?>
                        </span>
                    </a>
                </div>

                <div class="dropdown d-inline-block px-2">
                    <a href="favorites/list">
                        <i class="far fa-heart"></i>
                    </a>
                </div>

                <div class="dropdown d-inline-block px-2">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="far fa-user"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><?= i18n('tp_login') ?></a></li>
                        <li><a class="dropdown-item" href="#"><?= i18n('tp_register') ?></a></li>
                    </ul>
                </div>

                <?php new \app\widgets\language\LangWidget() ?>
            </div>
        </div>

    </div>
</nav>
<!-- Close Header -->
