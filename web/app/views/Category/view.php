<?php
/** @var $this View */
/** @var $category array */
/** @var $products array */
/** @var $total int */
/** @var $pagination object */
/** @var $breadCrumbs string */

use core\View;

?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <?= $breadCrumbs ?>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h3 class="section-title m-3">
                <?= $category['title'] ?>
            </h3>

            <?php if (!empty($category['content'])): ?>
                <div class="category">
                    <?= $category['content'] ?>
                </div>
            <?php endif; ?>

            <?php  $flagIsProducts = !empty($products); ?>
            <?php if( $pagination->getCountPages() > 1 || $flagIsProducts && (count($products) > 1) ): ?>
            <div class="row">
                <div class="col-sm-6 mt-3">
                    <div class="input-group">
                        <label class="input-group-text" for="input-sort"><?= i18n('category_view_sort'); ?>:</label>
                        <select class="form-select" id="input-sort">
                            <option value="sort=by_default" selected="">
                                <?= i18n('category_view_sort_by_default'); ?>
                            </option>
                            <option value="sort=title_asc"
                                    <?php if(isset($_GET['sort']) && $_GET['sort'] == 'title_asc') echo 'selected' ?>
                            >
                                <?= i18n('category_view_sort_title_asc'); ?>
                            </option>
                            <option value="sort=title_desc"
                                <?php if(isset($_GET['sort']) && $_GET['sort'] == 'title_desc') echo 'selected' ?>
                            >
                                <?= i18n('category_view_sort_title_desc'); ?>
                            </option>
                            <option value="sort=price_asc"
                                <?php if(isset($_GET['sort']) && $_GET['sort'] == 'price_asc') echo 'selected' ?>
                            >
                                <?= i18n('category_view_sort_price_asc'); ?>
                            </option>
                            <option value="sort=price_desc"
                                <?php if(isset($_GET['sort']) && $_GET['sort'] == 'price_desc') echo 'selected' ?>
                            >
                                <?= i18n('category_view_sort_price_desc'); ?>
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12 mt-3">
                    <?php if ($flagIsProducts): ?>
                        <?php $this->getEmbed('_list_products', ['products' => $products]) ?>
                    <?php else: ?>
                        <p><?= i18n('category_view_no_products'); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-3">
                    <?php if ($flagIsProducts): ?>
                        <?= $pagination ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
</div>
