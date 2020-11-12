var lastX, step = 0, maxStep, mobileCats;
$(init);

function init() {
    setCategoriesPositions();
    mobileCats = new MobileCatsSlider();
}

function setCategoriesPositions() {
    let gapX = 0;
    let gapY = 0;
    
    $($(".category-container").get().reverse()).each(function() {
        $(this).css({
            "margin-top": `${gapY}px`,
            "margin-left": `${gapX}px`
        });
        gapY -= 45;
        gapX += 60;
    });

    $(".category-name").each(function() {
        let nameGap = $(this).width() + 10;
        $(this).css("right", `-${nameGap}px`);
    });
}   

class MobileCatsSlider {
    constructor() {
        this.margin = 20;
        this.swipeTime = 300;
        this.isSwiping = false;
        this.centerElement;
        this.maxStep = $(".mobile-category-container").length;
        this.cats = $(".mobile-category-container");
        $(this.cats).css("transition", `all ${this.swipeTime}ms linear 0s`);
        this.centerElement = Math.floor($(this.cats).length / 2);
        this.initEventListeners();
        $(this.cats).find("img").on("load", () => {setTimeout(() => {this.setPositions(), 1000})});
    }

    initEventListeners() {
        $(".category-container").on("mouseenter", function(e) {
            $(this).addClass("selected");
        });
        
        $(".category-container").on("mouseleave", function() {
            $(this).removeClass("selected");
        });
    
        $("#mobile-shop-preview-module").on("touchstart", function(e) {
            lastX = e.originalEvent.touches ? e.originalEvent.touches[0].pageX : e.pageX;
        });
    
        $("#mobile-shop-preview-module").on("touchstart", function(e) {
            lastX = e.originalEvent.touches ? e.originalEvent.touches[0].pageX : e.pageX;
        });
    
        $("#mobile-shop-preview-module").bind("touchmove", (e) => {
            var currentX = e.originalEvent.touches ? e.originalEvent.touches[0].pageX : e.pageX;
            if(!this.isSwiping) {
                if (Math.abs(currentX-lastX) < 15) { }
               if (currentX > lastX) {
                   this.swipe(false);
                   this.isSwiping = true;
               } else {
                   this.swipe(true);
                   this.isSwiping = true;
               }
               setTimeout(() => {this.isSwiping = false}, this.swipeTime);
            }
        });
        $(window).on("resize", () => {
            this.setPositions();
        });
    }

    setPositions() {
        this.centerPos = {
            x: $("#mobile-shop-preview-module").width() / 2,
            y: $("#mobile-shop-preview-module").height() / 2
        };

        $($(this.cats)[this.centerElement]).css({
            "left": this.centerPos.x,
            "top": this.centerPos.y,
        });

        let centerElementGap = $($(this.cats)[this.centerElement]).width() / 2;

        let newGap = centerElementGap + this.margin;
        for(let i = this.centerElement - 1; i >= 0; i--) {
            let element = $($(this.cats)[i]);
            let elementGap = $(element).width() / 2;
            $(element).css("left", this.centerPos.x - (newGap + elementGap));
            $(element).css("top", this.centerPos.y);
            newGap += 2 * elementGap + this.margin;
        }
        
        newGap = centerElementGap + this.margin;
        for(let i = this.centerElement + 1; i < $(this.cats).length; i++) {
            let element = $($(this.cats)[i]);
            let elementGap = $(element).width() / 2;
            $(element).css("left", this.centerPos.x + (newGap + elementGap));
            $(element).css("top", this.centerPos.y);
            newGap += 2 * elementGap + this.margin;
        }
    }

    swipe(next) {
        console.log(this.centerElement, this.maxStep);
        if(next && this.centerElement + 1 <= this.maxStep - 1) {
            this.centerElement++;
        }
        else if(!next && this.centerElement - 1 >= 0){
            this.centerElement --;
        }
        this.setPositions();
    }
}