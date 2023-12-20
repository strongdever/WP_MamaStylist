!(function ($) {
    "use strict";
    $(document).ready(function () {
        setTimeout(function () {
            if (document.querySelector("#mceu_14-open > span")) {
                document.querySelector("#mceu_14-open > span").textContent = "DNP ShueiMGoStd";
            }
        }, 5000); // Adjust the delay if needed
        $('#product-type > optgroup > option:nth-child(1)').hide();
        $('#product-type > optgroup > option:nth-child(2)').hide();
        $('#product-type > optgroup > option:nth-child(3)').hide();
        $('#product-type').val('variable');


        $('#publish').click(function (e) {  //更新(publish) button
            PriceAndDescriptionValidation(e);
        })

        function PriceAndDescriptionValidation(e) {
            if ($('#menu-posts-product').hasClass('wp-menu-open')) {
                var error_element = '<div class="error-msg">この項目は必須項目です。</div>';    //error message for required items for 通常価格 (¥) and 商品ページURL
                var price_els = $('.woocommerce_variation .woocommerce_variable_attributes .data .variable_pricing .form-field:first-child() input'); //通常価格 (¥) inputs
                var url_els = $('.woocommerce_variation .woocommerce_variable_attributes .data div:nth-child(8) .form-field textarea'); //商品ページURL inputs

                //initialize part
                $('.error-msg').remove(); //remove all the error messages
                price_els.removeClass('value-empty'); //remove all the 'value-empty' class name from the all 通常価格 (¥) input field
                url_els.removeClass('value-empty'); //remove all the 'value-empty' class name from the all 通常価格 (¥) input field

                //check if the all 通常価格 (¥) values is empty
                var pricesEmpty = false;
                price_els.each(function () {
                    if ($(this).val() === '') {
                        if (!$(this).hasClass('value-empty')) {
                            $(this).addClass('value-empty');
                        }
                        pricesEmpty = true;
                    }
                })
                //check if the all 商品ページURL values is empty
                var urlsEmpty = false;
                url_els.each(function () {
                    if ($(this).val() === '') {
                        if (!$(this).hasClass('value-empty')) {
                            $(this).addClass('value-empty');
                        }
                        urlsEmpty = true;
                    }
                })

                if ( pricesEmpty || urlsEmpty ) {  //adding error message to empty 通常価格 (¥) and 商品ページURL parts
                    e.preventDefault(); // Prevent the default publish event
                    $('.value-empty').parent().append(error_element);

                    $('.value-empty').parent().parent().parent().parent().show();
                    if( $('.value-empty').parent().parent().parent().parent().parent().attr('closed') ) {
                        $('.value-empty').parent().parent().parent().parent().parent().removeAttr('closed').attr('open', '');
                    }

                    $('.value-empty').focus();
                }
            }
        }
    });

})(jQuery);