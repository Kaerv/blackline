var previewController;
var slider;
$(function() {
    slider = new Slider("quote");
    previewController = new PreviewQuotesController();
    $(".fav-ico").click(function() {
        if(prestashop.customer.is_logged) {
            let quoteId = $(this).parents(".quote").attr("id");
            let likesCount = $(`#${quoteId}.quote`).find(".fav-count > span");
            previewController.like(quoteId, customerId).then((response) => {
                $(likesCount).text(response["likes"]);
                if(response["liked"]) {
                    $(this).addClass("liked");
                    $(`#${quoteId}.quote`).find(".fav-ico").attr("src", "/assets/icons/heart black.svg");
                }
                else {
                    $(this).removeClass("liked");
                    $(`#${quoteId}.quote`).find(".fav-ico").attr("src", "/assets/icons/heart.svg");
                }
            });
        }
        else {
            alert("Żeby móc polubić ten cytat, musisz się zalogować.");
        }
    });
})