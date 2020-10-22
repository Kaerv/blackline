$("#product-sides > div").on("click", function() {
    let newUrl = $(this).data().imageUrl;
    $("#product-view img").attr("src", newUrl);
    $("#product-sides .current").removeClass("current");
    $(this).addClass("current");
}) 