<?php

/** @var $products array */
/** @var $this \core\View */

?>

<!-- Start Products -->
<section class="bg-light">
    <div class="container py-5">
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
                                <a href="cart/add?id=<?=$product['id'] ?>"
                                   data-id="<?=$product['id'] ?>"
                                   class="add-to-cart"
                                   id="add-to-cart-<?=$product['id'] ?>"
                                >
                                    <i class="fas fa-shopping-cart"></i>
                                </a>
                                <a href="#">
                                    <i class="far fa-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<!-- End Products -->
