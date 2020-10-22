$(function() {
    $(".color-container").click(function() {
        $(".color-container").removeClass('selected');
        $(this).addClass("selected");
    });
});