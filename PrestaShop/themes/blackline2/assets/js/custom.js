$(".form-control").on("focus", arrangeLabels);
$(".form-control").on("change", arrangeLabels);
$(".form-control").on("focusout", arrangeLabels);
arrangeLabels();

$(".delivery-options-list .custom-radio input").on("change", function() {
    $(".delivery-options-list .custom-radio input").next().hide();
    if($(this).prop("checked")) {
        $(this).next().show();
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