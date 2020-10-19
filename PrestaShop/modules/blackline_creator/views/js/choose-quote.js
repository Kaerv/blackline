$(function() {
    $("#choose-quote").on("click", function() {
        $.ajax({
            url:`${prestashop.urls.base_url}index.php?fc=module&module=blackline_creator&controller=choosequote&ajax=true`,
            data: {
                product_id: productId
            },
            method: "POST",
            success: function(response) {
                window.location.replace(`${prestashop.urls.base_url}index.php?fc=module&module=blackline_pages&controller=quotes`)
            }
        });
    });
});