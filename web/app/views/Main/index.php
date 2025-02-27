<?php
    /** @var $slides array */
    /** @var $products array */
    /** @var $this \core\View */
?>
<?php if(!empty($slides)): ?>
<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <?php for ($i = 0; $i < count($slides); $i++): ?>
            <li data-bs-target="#template-mo-zay-hero-carousel"
                data-bs-slide-to="<?=$i ?>"
                <?php if($i == 0): ?>
                 class="active"
                <?php endif; ?>
            ></li>
        <?php endfor; ?>
    </ol>

    <div class="carousel-inner">
        <?php $j = 0; foreach($slides as $slide) : ?>
        <div
            <?php if($j == 0): ?>
                class="carousel-item active"
            <?php else: ?>
                class="carousel-item"
            <?php endif; ?>
        >
            <div class="container">
                <div class="row">
                    <div class="mx-auto col-lg-9 order-lg-last">
                        <img class="img-fluid" src="<?=$slide->img ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
        <?php $j++; endforeach; ?>
    </div>

    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->
<?php endif; ?>

<div class="container">
    <div class="row text-center py-3">
        <div class="col-lg-6 m-auto">
            <h1 class="section-title"><?= i18n('main_index_featured_products') ?></h1>
        </div>
    </div>
</div>
<?php $this->getEmbed('_list_products', ['products' => $products]) ?>

<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="section-title"><?= i18n('main_index_categ_month') ?></h1>
            <p> <?= i18n('main_index_categ_month_text') ?> </p>
            <p> <?= i18n('main_index_categ_month_text2') ?> </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="<?= baseUrl() ?>category/kompyutery">
                <img src="<?= HOME_PAGE ?>/assets/img/kompyutery_category_img_01.jpg" class="rounded-circle img-fluid border">
            </a>
            <p class="text-center mt-2">
                <a href="<?= baseUrl() ?>category/kompyutery" class="btn btn-success"><?= i18n('tp_computers') ?></a>
            </p>
        </div>
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="<?= baseUrl() ?>category/planshety">
                <img src="<?= HOME_PAGE ?>/assets/img/category_planshet.jpg" class="rounded-circle img-fluid border">
            </a>
            <p class="text-center mt-2">
                <a href="<?= baseUrl() ?>category/planshety" class="btn btn-success"><?= i18n('tp_tablets') ?></a>
            </p>
        </div>
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="<?= baseUrl() ?>category/smartphon_iphone">
                <img src="<?= HOME_PAGE ?>/assets/img/smartphon_iphone.jpg" class="rounded-circle img-fluid border">
            </a>
            <p class="text-center mt-2">
                <a href="<?= baseUrl() ?>category/smartphon_iphone" class="btn btn-success"><?= i18n('tp_smartphones') ?></a>
            </p>
        </div>
    </div>
</section>
<!-- End Categories of The Month -->
