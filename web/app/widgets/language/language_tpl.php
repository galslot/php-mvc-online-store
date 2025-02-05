<div class="dropdown d-inline-block px-2">
    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
        <img src="<?=HOME_PAGE ?>/assets/img/lang/<?=\core\App::$container->getProp('language')['code'] ?>.png"
             alt="<?=\core\App::$container->getProp('language')['title'] ?>"
        >
    </a>
    <ul class="dropdown-menu" id="languages">

        <?php foreach ($this->languages as $code => $lang): ?>

            <?php if (\core\App::$container->getProp('language')['code'] == $code) continue; ?>

            <li>
                <button class="dropdown-item" data-langcode="<?=$code ?>">
                    <img src="<?=HOME_PAGE ?>/assets/img/lang/<?=$code ?>.png" alt="">
                    <?= $lang['title'] ?>
                </button>
            </li>

        <?php endforeach; ?>

    </ul>
</div>
