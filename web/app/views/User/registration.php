<?php

use core\helpers\FormHelpers;

?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item">
                <a href="./"><i class="fas fa-home"></i></a>
            </li>
            <li class="breadcrumb-item active"><?= i18n('tp_register'); ?></li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="row">

        <div class="col-lg-12 category-content">
            <h1 class="section-title"><?= i18n('tp_register'); ?></h1>

            <form class="row g-3" method="post">
                <div class="col-lg-6 offset-md-3">
                    <label for="InputEmail" class="form-label"><?= i18n('form_signup_email_input'); ?></label>
                    <input
                            type="email"
                            name="email"
                            class="form-control"
                            id="InputEmail"
                            placeholder="example@example.net"
                            value="<?= FormHelpers::getFieldFromSession("email") ?>"
                            required
                    >
                </div>

                <div class="col-lg-6 offset-md-3">
                    <label for="InputPassword" class="form-label"><?= i18n('form_signup_password_input'); ?></label>
                    <input
                            type="password"
                            name="password"
                            class="form-control"
                            id="InputPassword"
                            required
                    >
                </div>

                <div class="col-lg-6 offset-md-3">
                    <label for="InputName" class="form-label"><?= i18n('form_signup_name_input'); ?></label>
                    <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="InputName"
                            value="<?= FormHelpers::getFieldFromSession("name") ?>"
                            required
                    >
                </div>

                <div class="col-lg-6 offset-md-3">
                    <label for="InputLastname" class="form-label"><?= i18n('form_signup_lastname_input'); ?></label>
                    <input
                            type="text"
                            name="lastname"
                            class="form-control"
                            id="InputLastname"
                            value="<?= FormHelpers::getFieldFromSession("lastname") ?>"
                    >
                </div>

                <div class="col-lg-6 offset-md-3">
                    <label for="InputAddress" class="form-label"><?= i18n('form_signup_address_input'); ?></label>
                    <input
                            type="text"
                            name="address"
                            class="form-control"
                            id="InputAddress"
                            value="<?= FormHelpers::getFieldFromSession("address") ?>"
                            required
                    >
                </div>

                <div class="col-lg-6 offset-md-5">
                    <button type="submit" class="btn btn-primary">
                        <?= i18n('user_signup_button'); ?>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
