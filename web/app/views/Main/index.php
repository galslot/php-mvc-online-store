<?php
    /** @var $slides array */
    /** @var $products array */
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

<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1"><?= i18n('main_index_featured_products') ?></h1>
                <p> </p>
            </div>
        </div>
        <div class="row">
            <?php foreach($products as $product) : ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="product/<?=$product['slug'] ?>">
                            <img src="<?=$product['img'] ?>" class="card-img-top" alt="">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right">
                                    $<?=$product['price'] ?>
                                </li>
                            </ul>
                            <a href="product/<?=$product['slug'] ?>" class="h3 text-decoration-none text-dark">
                                <?=$product['title'] ?>
                            </a>
                            <p class="card-text">
                                <?=$product['exerpt'] ?>
                            </p>
                            <p class="text-muted">
                                Reviews (<?=$product['reviews'] ?>)
                            </p>
                            <div class="product-price px-2">
                                $<?= $product['price'] ?>
                            </div>
                            <div class="product-links">
                                <a href="#" class="px-2"><i class="fas fa-shopping-cart"></i></a>
                                <a href="#"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<!-- End Featured Product -->

<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1"><?= i18n('main_index_categ_month') ?></h1>
            <p>
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="<?= HOME_PAGE ?>/assets/img/category_img_01.jpg" class="rounded-circle img-fluid border"></a>
            <p class="text-center mt-2">
                <a class="btn btn-success"><?= i18n('tp_computers') ?></a>
            </p>
        </div>
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="<?= HOME_PAGE ?>/assets/img/category_img_02.jpg" class="rounded-circle img-fluid border"></a>
            <p class="text-center mt-2">
                <a class="btn btn-success"><?= i18n('tp_tablets') ?></a>
            </p>
        </div>
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="<?= HOME_PAGE ?>/assets/img/category_img_03.jpg" class="rounded-circle img-fluid border"></a>
            <p class="text-center mt-2">
                <a class="btn btn-success"><?= i18n('tp_phones') ?></a>
            </p>
        </div>
    </div>
</section>
<!-- End Categories of The Month -->
