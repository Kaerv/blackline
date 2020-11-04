let delays = {
    hideContent: 200,
    heightChange: 150,
    showingDelay: 150,
    firstCatDelay: 50,
    showingActions: 250,
    autoChange: 8000
}

class Slider {
    constructor(elementClass) {
        this.slides = $(`.${elementClass}`);
        this.actualSlide;
        this.actualIndex;
        this.slidesCount = this.slides.length;

        this.generatedSlide = this.slides[this.slidesCount - 1];
        $(this.generatedSlide).addClass("generated");
        this.slides.splice(-1,1);
        this.slidesCount--;

        this.actualIndex = 0;
        this.actualSlide = this.slides[this.actualIndex];
        this.showSlide(this.actualSlide);
        $(this.generatedSlide).show();

        $(".slider-button.left").on("click", () => {this.changeSlide(false)});
        $(".slider-button.right").on("click", () => {this.changeSlide(true)});

        $(".quote").css("transition", `height ${delays.heightChange}ms linear 0s`);
        $(".quote *").css("transition", `opacity ${delays.hideContent}ms linear 0s`)

        this.autoChangeTimeout;
        this.startAutoChange();
    }

    startAutoChange() {
        this.autoChangeTimeout = setTimeout(() => {
            this.changeSlide(true);
        }, delays.autoChange);
    }

    changeSlide(next) {
        clearTimeout(this.autoChangeTimeout);
        this.startAutoChange();
        let nextIndex;
        if(next) {
            nextIndex = (this.actualIndex >= this.slidesCount - 1)? 0 : this.actualIndex + 1;
        }
        else {
            nextIndex = (this.actualIndex <= 0)? this.slidesCount - 1 : this.actualIndex - 1;

        }
        this.actualIndex = nextIndex;
        this.actualSlide = this.slides[this.actualIndex];

        this.showSlide(this.actualSlide);
    }

    showSlide(slide) {
        let data = this.getDataFromSlide(slide);
        let targetHeight = $(slide).height();
        this.clearGeneratedQuoteData();
        setTimeout(() => {
            $(this.generatedSlide).height(targetHeight);
            setTimeout(() => {
                this.setGeneratedQuoteData(data);
            }, delays.heightChange);
        }, delays.hideContent);
        
        
    }

    getDataFromSlide(slide) {
        let cats = $(slide).find(".quote-categories span");
        let categories = "";
        $(cats).each(function() {
            categories += `<span style="opacity:0;transition:opacity ${delays.hideContent}ms linear 0s">${$(this).text()}</span>`;
        });

        return {
            content: $(slide).find(".quote-content").text(),
            author: $(slide).find(".quote-author").text(),
            likes: $(slide).find(".fav-count").text(),
            categories: categories,
            id: $(slide).attr("id"),
            liked: $(slide).find(".fav-ico").attr("src")
        }
    }

    setGeneratedQuoteData(quote) {
        $(this.generatedSlide).find(".quote-content").text(quote.content);
        $(this.generatedSlide).find(".quote-author").text(quote.author);
        $(this.generatedSlide).find(".quote-categories").html(quote.categories);
        $(this.generatedSlide).find(".fav-count").html(`<span>${quote.likes}</span>`);
        $(this.generatedSlide).attr("id", quote.id);
        $(this.generatedSlide).find(".fav-ico").attr("src", quote.liked);

        $(this.generatedSlide).find(".quote-wrap").css("opacity", 1);
        
        setTimeout(() => {$(this.generatedSlide).find(".quote-actions").css("opacity", 1)}, delays.showingActions);

        let categories = $(this.generatedSlide).find(".quote-categories span");
        for(let i = $(categories).length - 1; i >= 0; i--) {
            let delay = ($(categories).length - i - 1) * delays.showingDelay + delays.firstCatDelay;
            setTimeout(() => {$($(categories)[i]).css("opacity", 1);}, delay)
        }
    }

    clearGeneratedQuoteData() {

        $(this.generatedSlide).find(".quote-wrap").css("opacity", 0);
        $(this.generatedSlide).find(".quote-categories span").css("opacity", 0);
        $(this.generatedSlide).find(".quote-actions").css("opacity", 0);

        $(this.generatedSlide).find(".quote-content").text("");
        $(this.generatedSlide).find(".quote-author").text("");
        $(this.generatedSlide).find(".quote-categories").html("");
        $(this.generatedSlide).find(".fav-count").html("");
        $(this.generatedSlide).attr("id", 0);
    }
}