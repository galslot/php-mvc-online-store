<!-- Start Footer -->
<footer class="bg-dark" id="tempaltemo_footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-success border-bottom pb-3 border-light logo">
                    <?=$this->getParam('site_name') ?>
                </h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        123 Consectetur at ligula 10660
                    </li>
                    <li>
                        <i class="fa fa-phone fa-fw"></i>
                        <a class="text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope fa-fw"></i>
                        <a class="text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light"><?= i18n('tp_further') ?></h2>
                <?php new \app\widgets\content\ContentWidget([
                    'cache' => 0,
                    'class' => 'list-unstyled text-light footer-link-list',
                    'prepend' => '<li><a href="' . baseUrl() . '">' . i18n('tp_home') . '</a></li>',
                 ])
                ?>
            </div>

        </div>

        <div class="row text-light mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-light"></div>
            </div>
            <div class="col-auto me-auto">
                <ul class="list-inline text-left footer-icons">
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-auto">
                <label class="sr-only" for="subscribeEmail">Email</label>
                <div class="input-group mb-2">
                    <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Email address">
                    <div class="input-group-text btn-success text-light"><?= i18n('tp_subscribe') ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-light">
                        Copyright &copy; 2025 <?=$this->getParam('site_name') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- End Footer -->

<?php if($this->isDebug()): ?>
    <p>Debug:</p>
    <hr />
    <?php $this->getRouteLog() ?>
    <hr />
    <?php $this->getDbLogs() ?>
    <hr />
<?php endif; ?>

<script>

    const HOME_PAGE = "<?= HOME_PAGE ?>";
    const base_url  = "<?= baseUrl() ?>";
    console.log(HOME_PAGE, base_url);

</script>
<script src="<?= HOME_PAGE ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= HOME_PAGE ?>/assets/js/jquery-3.7.1.js"></script>
<script src="<?= HOME_PAGE ?>/assets/js/templa.js"></script>
<script src="<?= HOME_PAGE ?>/assets/js/sweetalert2.js"></script>
<script src="<?= HOME_PAGE ?>/assets/js/main.js"></script>

</body>
</html>