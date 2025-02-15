<?php
/** @var $this View */
/** @var $products array */

use core\View;

?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item">
                <a href="<?= baseUrl() ?>">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="<?= baseUrl() ?>favorites/list"> <?= i18n('favorites_index_title') ?></a></li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h1 class="section-title">
                <?= i18n('favorites_index_title') ?>
            </h1>

            <?php $flagIsSearch = !empty($products); ?>

            <div class="row">
                <div class="col-12 mt-3">
                    <?php if ($flagIsSearch): ?>
                        <?php $this->getEmbed('_list_products', ['products' => $products]) ?>
                    <?php else: ?>
                        <p><?= i18n('favorites_index_not_found'); ?></p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
</div>


