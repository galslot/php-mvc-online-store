
'use strict';

$(function() {

    // Cart
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
                console.log(response);
            },
            error: function (){
                alert("Error ajax !");
            }
        });
    });

    $('#languages button').on('click', function () {

        const lang_code = $(this).data("langcode");
        console.log("languages = ", lang_code);
        window.location = base_url + 'language/change?lang=' + lang_code;

    });

});