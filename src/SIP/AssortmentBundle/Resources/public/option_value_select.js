$(document).ready(function()
{
    $("select.option_value_product").each(function () {
        setSelectOptions(this);
    });

    $("select.option_value_product").change(function()
    {
        setSelectOptions(this);
    });

    function setSelectOptions(object)
    {
        var idFieldArray = $(object).attr('id').split('_');
        $.ajax
            ({
                async: false,
                url: select_options_url,
                data: {
                    productId: $(object).val(),
                    uniqId: idFieldArray[0],
                    id: getEditId()
                },
                success: function(jsonResponse)
                {
                    var formHtml = '';
                    if (jsonResponse.data) {
                        formHtml = jsonResponse.data.content;
                    }
                    $("div.option_value_target").html(formHtml);
                }
            });
    }

    function getEditId()
    {
        url = document.location.href.split('/')
        if (url[url.length-1] == 'edit') {
            return url[url.length-2];
        }

        return null;
    }
});