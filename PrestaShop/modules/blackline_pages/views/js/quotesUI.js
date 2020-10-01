class QuotesUI {
    constructor() {
        this.setCheckboxListEvents();
        this.setSortEvents();
    }

    setCheckboxListEvents() {
        $(".checkbox-list").scrollbar();
        $("#all-authors-title").click(() => {
            $("#all-authors-list").toggle();
            $("#all-authors-button").toggleClass('button-rotated');
        });
    }

    setSortEvents() {
        $(document).click(() => {
            $("#quote-sort-list").hide();
        })
        $("#sort-input").click((event) => {
            $("#quote-sort-list").toggle();
            $("#sort-input > img").toggleClass("button-rotated");
            event.stopImmediatePropagation();
        });
    }

    generateQuotes(data) {
        data.forEach(function (quote) {
            let categories = "";
            console.log(quote);
            quote.categories.forEach(function (category) {
                categories += `<span>${category}</span>`;
            });

            $("#quotes-container").append(`
            <div class="quote" id="${quote.id}">
                <div class="quote-categories">
                    ${categories}
                </div>
                <div class="quote-border">
                    <div class="border lt"></div>
                    <div class="border rt"></div>
                    <div class="border lb"></div>
                    <div class="border rb"></div>
                </div>
                <div class="quote-wrap">
                    <img class="quotation-mark" src="/assets/icons/quotation.svg">
                    <div class="quote-content">${quote.content}</div>
                    <div class="quote-author">- ${quote.author} -</div>
                </div>
                <div class="quote-actions">
                    <div class="quote-favourite">
                        <div class="fav-count"><span>${quote.likes}</span></div>
                        <img src="/assets/icons/heart.svg" class="fav-ico">
                    </div>
                    <div class="quote-embed">
                        <img class="embed-ico" src="/assets/icons/embed.png">
                        <div class="embed-message">Umieść na produkcie</div>
                    </div>
                </div>
            </div>
            `)
        });
    }

    clearQuotes() {
        $(".quote").remove();
    }
}