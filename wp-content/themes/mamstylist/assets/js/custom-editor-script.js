!(function ($) {
    "use strict";
    $(document).ready(function () {
        setTimeout(function() {
            if(document.querySelector("#mceu_14-open > span")) {
                document.querySelector("#mceu_14-open > span").textContent="DNP ShueiMGoStd";
            }
        }, 5000); // Adjust the delay if needed
        $('#product-type > optgroup > option:nth-child(1)').hide();
        $('#product-type > optgroup > option:nth-child(2)').hide();
        $('#product-type > optgroup > option:nth-child(3)').hide();
        $('#product-type').val('variable');
    });
})(jQuery);