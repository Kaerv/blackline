let deliverySelector = ".delivery-options-list";
let paymentSelector = ".payment-rado";

$(".form-control").on("focus", arrangeLabels);
$(".form-control").on("change", arrangeLabels);
$(".form-control").on("focusout", arrangeLabels);
arrangeLabels();

[deliverySelector, paymentSelector].forEach((el) => { $(`${el} .custom-radio input`).each(setCustomRadio) });

$(".delivery-options-list .custom-radio input").on("change", function() {
    $(".delivery-options-list .custom-radio input").next().hide();
    if($(this).prop("checked")) {
        $(this).next().show();
    }
});

let rightPanelWidth = parseInt($(".cart-grid-right").css("width"));
$("#payment-confirmation button").css({
    "width": rightPanelWidth * 0.8,
    "right": rightPanelWidth * 0.1
});
$(window).on("resize", function() {
    let rightPanelWidth = parseInt($(".cart-grid-right").css("width"));
    $("#payment-confirmation button").css({
        "width": rightPanelWidth * 0.8,
        "right": rightPanelWidth * 0.1
    });
})

$(".payment-radio .custom-radio input").on("change", function() {
    $(".payment-radio .custom-radio input").next().hide();
    if($(this).prop("checked")) {
        $(this).next().show();
        let number = $(this).parents(".payment-option").attr("id")[15];
        let additionalInformation = $(`#payment-option-${number}-additional-information`).html();
        $(".summary-additional-information").html(additionalInformation);
        $(".summary-additional-information .close").remove();
        $(".summary-additional-information dd").remove();
    }
});


jQuery("#checkout input").on("invalid", function(event) {
    event.preventDefault();
    $(this).next().html(this.validationMessage);
    $(this).addClass("invalid");
});

$("#checkout .form-group .col-md-6").append("<div class='error-message'></div>")


function arrangeLabels() {
    $(".form-control-label").removeClass("filled");
    $(".form-control").each(function() {
        if($(this).val() != "") {
            $(this).parents(".form-group.row").find(".form-control-label").addClass("filled");
        }
        if($(this).is(":focus")) {
            $(this).parents(".form-group.row").find(".form-control-label").addClass("filled");
        }
    });
}

function setCustomRadio(element) {
    if($(this).prop("checked")) $(this).next().show();
    else $(this).next().hide();
}