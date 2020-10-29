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

$(".product-section-title").click(function() {
    $(this).parent().find(".tab-pane").toggle();
})

prestashop.on("updatedProduct", function(e) {
    id_attribute = e.id_product_attribute;
    creatorUrl = baseCreatorUrl + `&variant=${id_attribute}`;
    $(".creator").attr("href", creatorUrl);
  });
  if(prestashop.page.page_name == "product") {
    creatorUrl = baseCreatorUrl + `&variant=${id_attribute}`;
    $(".creator").attr("href", creatorUrl);
  }

  $("p:contains(I zaoszczędź czas na)").css("margin-top","70px")