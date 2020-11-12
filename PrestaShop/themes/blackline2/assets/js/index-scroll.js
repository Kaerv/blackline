/*var lastScroll = 0;
var currentSection = 0;
var sections = [
    "#header",
    "#quote_section",
    "#preamble-wrap",
    "#shop-preview",
    "#youtube-preview",
    "#footer"
];
var isScrolling = false;
var container = $("body > main")[0];

$(document).ready(function() {
    hideScroll();
    window.addEventListener("resize", function () {
        hideScroll();
    });

    container.addEventListener("scroll", function(event) {
        event.preventDefault();
        if(!isScrolling) {
            isScrolling = true;
            let currentScroll = container.scrollTop;
            if(currentScroll > lastScroll && currentSection != sections.length - 1) {
                currentSection++;
                scrollBySection(sections[currentSection]);
            }
    
            else if(currentScroll > 0 && currentSection != 0) {
                currentSection--;
                scrollBySection(sections[currentSection]);
            }
            
            else {
                isScrolling = false;
            }
        }
    });
});

function hideScroll() {

    let scrollWidth = container.offsetWidth - container.clientWidth;
    $("body > main").css("width", `calc(100% + ${scrollWidth}px`);
}

function scrollBySection(section) {
    $(container).css("overflow", "hidden");
    hideScroll();
        $([container]).animate({
            scrollTop: $(container).scrollTop() + $(section).offset().top
        }, 500, function() {
            setTimeout(function() {
                isScrolling = false;
                lastScroll = container.scrollTop;
                $(container).css("overflow", "auto");
                hideScroll();
            }, 50)
        });
}*/