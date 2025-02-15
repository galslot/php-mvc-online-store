<!-- Modal cart-modal -->
<?php

/** @var $is_cart_not_empty bool */
/** @var $cart_products array */
/** @var $cart_quantity */
/** @var $cart_sum */

?>
<div class="modal-body">

    <?php if ($is_cart_not_empty): ?>
      <div class="table-responsive cart-table">
      <table class="table text-start align-middle">
        <thead>
        <tr>
            <th scope="col"><?= i18n('tp_photo') ?></th>
            <th scope="col"><?= i18n('tp_products') ?></th>
            <th scope="col"><?= i18n('tp_quantity') ?></th>
            <th scope="col"><?= i18n('tp_price') ?></th>
            <th scope="col"> <i class="far fa-solid fa-trash-can"></i> </th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($cart_products as $product_id => $item): ?>
          <tr>
            <td>
                <a href="<?= HOME_PAGE ?>/product/<?= $item['slug'] ?>">
                    <img src="<?= HOME_PAGE ?><?= $item['img'] ?>" alt="" style="max-width:180px; width:100%" >
                </a>
            </td>
            <td>
                <a href="<?= HOME_PAGE ?>/product/<?= $item['slug'] ?>">
                    <?= $item['title'] ?>
                </a>
            </td>
            <td><?= $item['quantity'] ?></td>
            <td><?= $item['price'] ?></td>
            <td>
              <td>
                  <a href="cart/delete?id=<?= $product_id ?>" data-id="<?= $product_id ?>" class="del-item">
                      <i class="far fa-trash-alt"></i>
                  </a>
              </td>
          </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="4" class="text-end"><?= i18n('tp_cart_total_quantity') ?></td>
            <td class="cart-qty"><?= $cart_quantity ?></td>
        </tr>
        <tr>
            <td colspan="4" class="text-end"><?= i18n('tp_cart_sum') ?></td>
            <td class="cart-sum">$<?= $cart_sum ?></td>
        </tr>
        </tbody>
      </table>
    </div>
    <?php else: ?>
        <h4 class="text-start"><?= i18n('tp_cart_empty') ?></h4>
    <?php endif; ?>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-success ripple" data-bs-dismiss="modal"><?= i18n('tp_continue_shop') ?></button>
    <?php if ($is_cart_not_empty): ?>
        <button type="button" class="btn btn-primary"><?= i18n('tp_order') ?></button>
        <button type="button" class="btn btn-danger ripple" data-bs-dismiss="modal" id="cart_clear"><?= i18n('tp_cart_clear') ?></button>
    <?php endif; ?>
</div>
