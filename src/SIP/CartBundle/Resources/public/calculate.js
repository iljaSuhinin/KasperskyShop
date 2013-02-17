$(document).ready(function()
{
    var setPrice = function () {
        $.ajax({
            type: "POST",
            url: calculateUrl,
            data: $(".clearfix").serialize(), // serializes the form's elements.
            success: function(jsonResponse)
            {
                $("#variant_price").html(jsonResponse.data.UnitPrice);
                $(".pull-right").show();
            },
            error: function(jsonResponse) {
                $(".pull-right").hide();
            }
        });
    };

    setPrice();
    $("select.sylius_option_value_choice").change(setPrice);
});