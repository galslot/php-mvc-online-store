<?php

/** @var $gallery ?array */
/** @var $product array */
/** @var $breadCrumbs array */

?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <?= $breadCrumbs ?>
        </ol>
    </nav>
</div>

<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="<?= HOME_PAGE. $product['img'] ?>" alt="<?= $product['title'] ?>" id="product-detail">
                </div>
                <div class="row">
                    <!--Start Controls-->
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="text-dark fas fa-chevron-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </div>
                    <!--End Controls-->
                    <!--Start Carousel Wrapper-->
                    <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                        <!--Start Slides-->
                        <div class="carousel-inner product-links-wap" role="listbox">

                            <!--First slide-->
                            <div class="carousel-item active">
                                <div class="row">
                                    <?php if(!empty($gallery)): ?>
                                        <?php foreach ($gallery as $itemImg): ?>
                                        <div class="col-4">
                                            <a href="#">
                                                <img class="card-img img-fluid" src="<?= HOME_PAGE. $itemImg['img'] ?>" alt="<?= $product['title'] ?>">
                                            </a>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!--/.First slide-->

                            <!--Second slide-->
                            <div class="carousel-item">
                                <div class="row">

                                    <?php if(!empty($gallery)): ?>
                                        <?php foreach ($gallery as $itemImg): ?>
                                            <div class="col-4">
                                                <a href="#">
                                                    <img class="card-img img-fluid" src="<?= HOME_PAGE. $itemImg['img'] ?>" alt="<?= $product['title'] ?>">
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <!--/.Second slide-->

                        </div>
                        <!--End Slides-->
                    </div>
                    <!--End Carousel Wrapper-->
                    <!--Start Controls-->
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="text-dark fas fa-chevron-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <!--End Controls-->
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2"><?= $product['title'] ?></h1>
                        <p class="h3 py-2">$ <?= $product['price'] ?></p>
                        <p class="py-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <span class="list-inline-item text-dark">
                                <?= i18n('tp_product_rating') ?> 4.8 | 36 <?= i18n('tp_product_comments') ?>
                            </span>
                        </p>
                        <p class="py-2 text-muted">
                            <?= i18n('tp_product_reviews') ?> (<?=$product['reviews'] ?>)
                        </p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6><?= i18n('tp_product_brand') ?>:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted">
                                    <strong><?= i18n('tp_product_brand') ?> <?= $product['id'] ?></strong>
                                </p>
                            </li>
                        </ul>

                        <h6><?= i18n('tp_product_description') ?>:</h6>
                        <p>
                            <?=$product['content'] ?>
                        </p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6><?= i18n('tp_product_color') ?>:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong>White / Black</strong></p>
                            </li>
                        </ul>

                        <h6><?= i18n('tp_product_specification') ?>:</h6>
                        <ul class="list-unstyled pb-3">
                            <li><?=$product['exerpt'] ?></li>
                        </ul>

                        <form action="" method="GET">
                            <input type="hidden" name="product-title" value="Activewear">
                            <div class="row">

                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            <?= i18n('tp_quantity') ?>
                                            <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                        <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                    </ul>
                                </div>

                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button
                                            type="submit"
                                            class="btn btn-success btn-lg add-to-cart"
                                            name="submit"
                                            value="buy"
                                            data-id="<?= $product['id'] ?>"
                                    >
                                        <?= i18n('tpl_buy') ?>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->
