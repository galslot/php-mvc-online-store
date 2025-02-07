<!-- Modal templatemo_search -->
<div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="w-100 pt-1 mb-5 text-right">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="get" class="modal-content modal-body border-0 p-0">
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="<?= i18n('tp_search') ?> ...">
                <button type="submit" class="input-group-text bg-success text-light">
                    <i class="fa fa-fw fa-search text-white"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal cart-modal -->
<div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= i18n('tp_cart') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table text-start">
                    <thead>
                    <tr>
                        <th scope="col"><?= i18n('tp_photo') ?></th>
                        <th scope="col"><?= i18n('tp_products') ?></th>
                        <th scope="col"><?= i18n('tp_quantity') ?></th>
                        <th scope="col"><?= i18n('tp_price') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <a href="#"><img src="<?= HOME_PAGE ?>/uploads/img/products/apple-27-inch-led-cinema.jpg" alt="" style="max-width:180px; width:100%" ></a>
                        </td>
                        <td><a href="#">Apple cinema</a></td>
                        <td>1</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#"><img src="<?= HOME_PAGE ?>/uploads/img/products/canon-eos.jpg" alt="" style="max-width:180px; width:100%"></a>
                        </td>
                        <td><a href="#">Canon EOS</a></td>
                        <td>1</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#"><img src="<?= HOME_PAGE ?>/uploads/img/products/notebook-xiaomi-mi-pro-15.jpg" alt="" style="max-width:180px; width:100%"></a>
                        </td>
                        <td><a href="#">Notebook Xiaomi</a></td>
                        <td>1</td>
                        <td>100</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger ripple" data-bs-dismiss="modal"><?= i18n('tp_continue_shop') ?></button>
                <button type="button" class="btn btn-primary"><?= i18n('tp_order') ?></button>
            </div>
        </div>
    </div>
</div>

