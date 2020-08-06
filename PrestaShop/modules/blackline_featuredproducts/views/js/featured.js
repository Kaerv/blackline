let productsSets = $(".featured-set");
let currentSet = 0;
let nextSet = null;
let canSlide = true;
let lastSet = productsSets.length - 1;

$(document).ready(function () {
    $(productsSets).css({"display": "none"})
    $(productsSets[0]).css({"display": "flex"});

    $(".featured-button.left").on("click", function() {
        if(canSlide) {
            canSlide = false;
            nextSet = currentSet == 0? lastSet : currentSet - 1;
            resetSets();
            
            $(productsSets[currentSet]).animate(
                {right: "-2000px"}, 
                1000, 
                function() {
                    $(productsSets[currentSet]).css({"display": "none"});
                    currentSet = currentSet == 0? lastSet : currentSet - 1;
                });
    
            showNext("left");
        }
    });

    $(".featured-button.right").on("click", function() {
        if(canSlide) {
            canSlide = false;
            nextSet = currentSet == lastSet? 0 : currentSet + 1;
            resetSets();
            $(productsSets[currentSet]).animate(
                {left: "-2000px"}, 
                1000, 
                function() {
                    $(productsSets[currentSet]).css({"display": "none"});
                    currentSet = currentSet == lastSet? 0 : currentSet + 1;
                });
    
             showNext("right");
        }
    });
});

function resetSets() {
    $(productsSets[currentSet]).css({"left": "", "right": ""});
    $(productsSets[nextSet]).css({"left": "", "right": ""});
}

function showNext(direction) {
    $(productsSets[nextSet]).css({"display": "flex"});

    if(direction == "left")
        $(productsSets[nextSet]).css({"left": "-2000px"});
    else
        $(productsSets[nextSet]).css({"right": "-2000px"});

    $(productsSets[nextSet]).animate(
        { left: "0px" }, 
        1000, 
        function() {
        canSlide = true
    });
}