class QuotesUI {
    constructor() {
        this.setCheckboxListEvents();
        this.setSortEvents();
        this.setWindowEvents();
        this.setSearchEvents();
        this.areCategoriesSearching = false;
    }

    setCheckboxListEvents() {
        $(".checkbox-list").scrollbar();
        $("#categories-list").scrollbar();
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

    setWindowEvents() {
        let actualLoading = false;
        $(window).scroll(function(event) {
            let windowBottom = $(this).scrollTop() + $(this).height();
            let lastQuotePos = $(".quote").last().offset().top;

            if(windowBottom >= lastQuotePos && !actualLoading) {
                actualLoading = true;
                console.log("Hej");
                controller.getQuotes().then(() =>{actualLoading = false});
            }
        })
    }

    setSearchEvents() {
        $("#category-search-input").on("input", this.searchCategories);
    }

    searchCategories() {
        if(!this.areCategoriesSearching) {
            this.areCategoriesSearching = true;
            let phrase = $("#category-search-input").val();
            console.log(`%cWpisano coś! Treść: ${phrase}`, "color:white");
            if(phrase != ""){
                controller.findCategories(phrase).then(quotesUI.generateCategories);
            }
            else 
                $("#categories-list").html("");

            let timeout = setTimeout(() => {
                console.log(`%cMożna wyszukiwać. ${phrase} => ${$("#category-search-input").val()}`, "color:#50FF50");
                this.areCategoriesSearching = false;
                if(phrase != $("#category-search-input").val()) {
                    console.log(`%cWyszukuję ponownie. ${phrase} => ${$("#category-search-input").val()}`, "color: #fbff00");
                    quotesUI.searchCategories();
                }
            }, 500);
        }
    }

    generateCategories(data) {
        console.log("%cKoniec wyszukiwania", "color: #FF5050");
        let categoriesDOM = "";
        data.forEach((category) => {
            categoriesDOM += `
            <div class="filter-value-container">
                <div class="filter-value">
                    <span>${category["name"]}</span>
                    <img src="/assets/icons/close.svg">
                </div>
            </div>
            `
        });
        $("#categories-list").html(categoriesDOM);
    }

    generateQuotes(data) {
        data.forEach(function (quote) {
            let categories = "";
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
}