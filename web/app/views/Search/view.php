<?php
/** @var $this View */
/** @var $search string */
/** @var $products array */
/** @var $total int */
/** @var $pagination object */

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
            <li class="breadcrumb-item"><a href="<?= baseUrl() ?>search/view"> <?= i18n('tp_search_title') ?></a></li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h1 class="section-title">
                <?= i18n('tp_search_title') ?>
            </h1>
            <h4 class="">
                <?= i18n('tp_search_query') . hsc($search)  ?>
            </h4>

            <?php $flagIsSearch = !empty($products) && ($search !== ''); ?>

            <div class="row">
                <div class="col-12 mt-3">
                    <?php if ($flagIsSearch): ?>
                        <?php $this->getEmbed('_list_products', ['products' => $products]) ?>
                    <?php else: ?>
                        <p><?= i18n('tp_search_not_found'); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-3">
                    <?php if ($flagIsSearch): ?>
                        <?= $pagination ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
</div>
