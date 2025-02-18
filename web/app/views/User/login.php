<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?=baseUrl() ?>">
                    <i class="fas fa-home"></i></a>
            </li>
            <li class="breadcrumb-item active"><?= i18n('tp_login') ?></li>
        </ol>
    </nav>
</div>

<div class="container py-5">
    <div class="row">

        <div class="col-lg-12 category-content mt-5 mb-5">
            <h1 class="section-title"><?= i18n('tp_login') ?></h1>

            <form class="row g-3" method="post">

                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="email"
                               name="email"
                               class="form-control"
                               id="email"
                               placeholder="info@example.net"
                               required
                        >
                        <label for="email" class="form-label"><?= i18n('form_signup_email_input') ?></label>
                    </div>
                </div>

                <div class="col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="password"
                               name="password"
                               class="form-control"
                               id="password"
                               placeholder="password"
                               required
                        >
                        <label class="required" for="password"><?= i18n('form_signup_password_input') ?></label>
                    </div>
                </div>

                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-danger">
                        <?= i18n('user_login_button'); ?>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
