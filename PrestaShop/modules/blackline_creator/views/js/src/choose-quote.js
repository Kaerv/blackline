export const chooseQuoteEvents = () => {
    $("body").on("click", "#choose-quote" , function() {
        $.ajax({
            url:`${prestashop.urls.base_url}index.php?fc=module&module=blackline_creator&controller=choosequote&ajax=true`,
            data: {
                product_id: productId,
                product_name: productName,
                variant: productVariant
            },
            method: "POST",
            success: function(response) {
                $(window).off("beforeunload");
                window.location.href = `${prestashop.urls.base_url}index.php?fc=module&module=blackline_pages&controller=quotes`;
            }
        });
    });

    $(window).on("beforeunload", function(e) {
    (e || window.event).returnValue = null;
    return null;
});
}




