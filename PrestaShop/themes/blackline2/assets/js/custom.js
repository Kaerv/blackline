$("#account-forms-container .form-control").on("focus", arrangeLabels);
arrangeLabels();
$(".form-control[type='date']").parents(".form-group").find("label").css({"top": -30});


function arrangeLabels() {
    $(".form-control").each(function() {
        let label = $(this).parents(".form-group").find("label");
        let hasFocus = $(this).is(":focus");
        let isFilled = $(this).val() != "";

        if(hasFocus || isFilled) 
            $(label).addClass("filled");
        else 
            $(label).removeClass("filled")
    });
}

$("#first-step-register").on("click", function() {
    $(".register-form-container").show();
    $(".register-form-first-step").hide();
});