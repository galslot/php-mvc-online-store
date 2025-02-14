
'use strict';

$(function() {

    // Cart
    function showCartModal(cart_view)
    {
        $('#cart-modal .modal-cart-content').html(cart_view);
        const myModalEl = document.querySelector('#cart-modal');
        const modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
        modal.show();

        getCartQuantityUpdate();
    }

    $('.add-to-cart').on('click', function (event) {
        event.preventDefault();

        const product_id = $(this).data("id");
        const product_quanity = $('#product-quanity').val();
        const quantity = product_quanity ? product_quanity : 1;

        console.log(product_id, quantity);

        $.ajax({
            url: 'cart/add',
            type: 'GET',
            data: {
              'id': product_id,
              'quantity': quantity
            },
            success: function (response){
                showCartModal(response);
            },
            error: function (){
                alert("Error ajax (1) !");
            }
        });
    });


    function showCart(cart_view)
    {
        $('#cart-modal .modal-cart-content').html(cart_view);
        const myModalEl = document.querySelector('#cart-modal');
        const modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
        modal.show();

        getCartQuantityUpdate();
    }

    $('#get-cart-header').on('click', function (event) {
        event.preventDefault();

        $.ajax({
            url: 'cart/show',
            type: 'GET',
            success: function (response){
                showCart(response);
            },
            error: function (){
                alert("Error ajax (2) !");
            }
        });
    });


    function showCartQuantityToHeader(cart_quantity)
    {
        console.log(cart_quantity);
        $('#cart-modal-header-cart-quantity').html(cart_quantity);
    }

    function getCartQuantityUpdate()
    {
        $.ajax({
            url: 'cart/cart-quantity-post',
            type: 'POST',
            success: function (response){
                showCartQuantityToHeader(response);
            },
            error: function (){
                alert("Error ajax (4) !");
            }
        });
    }

    $(window).on("load", function() {

        getCartQuantityUpdate();

    });

    function icon_cart_del_item_click(event)
    {
        event.preventDefault();
        const product_id = $(this).data('id');

        console.log('icon_cart_del_item_click() delete = ', product_id);

        $.ajax({
            url: 'cart/delete-post',
            type: 'POST',
            data: {
                'id': product_id,
            },
            success: function (response) {
                showCart(response);
            },
            error: function () {
                alert('Error ajax (3) !');
            }
        });
    }

    $('#cart-modal .modal-cart-content').on('click', '.del-item', icon_cart_del_item_click);


    function button_cart_del_all_click(event)
    {
        console.log('button_cart_del_all_click');

        $.ajax({
            url: 'cart/delete-all',
            type: 'GET',
            data: {
                'all': 'all',
            },
            success: function (response) {
                showCart(response);
            },
            error: function () {
                alert('Error ajax (5) !');
            }
        });
    }
    $('#cart-modal .modal-cart-content').on('click', '#cart_clear', button_cart_del_all_click);
    // Cart End

    // Select sorting
    $('#input-sort').on('change', function () {
        let pathname = HOME_PAGE + window.location.pathname + '?' + $(this).val();
        window.location = pathname;
    });


    $('#languages button').on('click', function () {

        const lang_code = $(this).data("langcode");
        console.log("languages = ", lang_code);
        window.location = base_url + 'language/change?lang=' + lang_code;

    });

});