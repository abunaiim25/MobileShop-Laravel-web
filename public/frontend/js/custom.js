//const { ajax } = require("jquery");
//"use strict";
//alert("hi");


    //increment-btn
    $('increment-btn').click(function(e)
     {
        e.preventDefault();

        var inc_value = $('.qty-input').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $('.qty-input').val(value);
        }
    });


    




