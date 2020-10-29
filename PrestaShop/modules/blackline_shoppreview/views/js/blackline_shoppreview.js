$(function() {
    setCategoriesPositions();

    $(".category-container").on("mouseenter", function(e) {
        $(this).addClass("selected");
    
        let nextToSelected = false;
        $(".category-container").each(function() {
            if($(this).hasClass("selected")) {
                nextToSelected = true;
                $(this).css({
                    "margin-top": `${$(this).attr("data-regular-y")}px`,
                    "margin-left": `${$(this).attr("data-regular-x")}px`
                });
                return;
            }
            if(nextToSelected == false) {
                $(this).css({
                    "margin-top": `${$(this).attr("data-top-y")}px`,
                    "margin-left": `${$(this).attr("data-top-x")}px`
                });
            }
    
            else {
                $(this).css({
                    "margin-top": `${$(this).attr("data-bottom-y")}px`,
                    "margin-left": `${$(this).attr("data-bottom-x")}px`
                });
            }
        });
    })
    
    $(".category-container").on("mouseleave", function() {
        $(this).removeClass("selected");
        $(".category-container").each(function() {
            $(this).css({
                "margin-top": `${$(this).attr("data-regular-y")}px`,
                "margin-left": `${$(this).attr("data-regular-x")}px`
            });
        });
    });
})


function setCategoriesPositions() {
    let gapX = 0;
    let gapY = 0;
    
    $($(".category-container").get().reverse()).each(function() {
        $(this).css({
            "margin-top": `${gapY}px`,
            "margin-left": `${gapX}px`
        });

        $(this).attr("data-bottom-x", gapX - 10);
        $(this).attr("data-bottom-y", gapY + 10);
        $(this).attr("data-top-x", gapX + 10);
        $(this).attr("data-top-y", gapY - 10);
        $(this).attr("data-regular-x", gapX);
        $(this).attr("data-regular-y", gapY);

        gapY -= 35;
        gapX += 25;
    });

    $(".category-name").each(function() {
        let nameGap = $(this).width() + 10;
        $(this).css("right", `-${nameGap}px`);
    });
}