
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

    // languages
    $('#languages button').on('click', function () {
        const lang_code = $(this).data("langcode");
        window.location = base_url + 'language/change?lang=' + lang_code;
    });

    // Favorites
    $('.product-links').on('click', '.add-to-favorites', function (event) {
        event.preventDefault();

        const product_id = $(this).data('id');
        const $this = $(this);

        console.log('add-to-favorites. id=' + product_id);

        $.ajax({
            url: 'favorites/add',
            type: 'GET',
            data: {
                'id': product_id,
            },
            success: function (response){
                response = JSON.parse(response);

                Swal.fire(
                    response.text,
                    '',
                    response.result
                );

                $this.removeClass('add-to-favorites').addClass('delete-from-favorites');
                $this.find("i").removeClass('fa-regular fa-heart').addClass('fa-solid fa-heart');
            },
            error: function (){
                alert("Error ajax (6) !");
            }
        });
    });

    $('.product-links').on('click', '.delete-from-favorites', function (event) {
        event.preventDefault();
        const product_id = $(this).data('id');
        const $this = $(this);

        console.log('delete-from-favorites. id=' + product_id);

        $.ajax({
            url: 'favorites/delete',
            type: 'GET',
            data: {
                id: product_id
            },
            success: function (response) {
                const url = window.location.toString();
                if (url.indexOf('favorites') !== -1) {
                    Swal.fire({
                        title: 'Success',
                        icon: 'success',
                        html: 'Success',
                        showConfirmButton: true,
                        timer: 1500
                    }).then((result) => {
                        setTimeout(function(){
                            window.location = url;
                        },500);
                    });
                } else {
                    response = JSON.parse(response);
                    Swal.fire(
                        response.text,
                        '',
                        response.result
                    );
                    if (response.result === 'success') {
                        $this.removeClass('delete-from-favorites').addClass('add-to-favorites');
                        $this.find('i').removeClass('fa-solid fa-heart').addClass('fa-regular fa-heart');
                    }
                }
            },
            error: function () {
                alert('Error ajax(7) !');
            }
        });
    });

});