$(document).on("click", handleClick )

function handleClick(event) {
    let target = event.target;
    let parent = $(target).parent()[0];

    $(".quantity-select-list").hide();

    $(".cart-quantity-select").each( function() {
        if(target == this || parent == this) {
            $(this).find(".quantity-select-list").show();
        }
    });

    $(".quantity-select-option").each(function() {
        if(target == this) {
            let value = $(this).text();
            $(this).parent().parent().parent().find(".cart-selected-quantity").text(value);
            $(this).parent().parent().parent().find("input").val(value);
        }
    });
}