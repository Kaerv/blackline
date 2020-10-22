$(function() {
    $(".custom-select").click(function(event) {
        event.stopImmediatePropagation();
        $(".custom-select > .select-list").hide();
        $("select-current-option img").removeClass('rotated');
        $(this).find(".select-list").show();
        $(this).find("img").addClass('rotated');
    });

    $(document).click(function(event) {
        $(".custom-select > .select-list").hide();
        $(".custom-select img").removeClass('rotated');
    });

    $(".select-option").click(function(event) {
        event.stopImmediatePropagation();
        let newValue = $(this).text();
        let container = $(this).parents(".custom-select");
        $(container).find("select").val(newValue);
        $(container).find(".select-current-option > div").text(newValue);
        $(".custom-select > .select-list").hide();
        $(".custom-select img").removeClass('rotated');
    });
});