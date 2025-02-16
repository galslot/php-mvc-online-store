<?php
/** @var $content array */

?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item">
                <a href="<?= baseUrl() ?>">
                    <i class="fas fa-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item"><?= $content['title'] ?></li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h1 class="section-title"><?= $content['title'] ?></h1>
            <p>
                <?= $content['text'] ?>
            </p>
        </div>

    </div>
</div>
