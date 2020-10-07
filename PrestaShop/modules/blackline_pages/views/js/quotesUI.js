class QuotesUI {
    constructor() {
        this.setCheckboxListEvents();
        this.setSortEvents();
        this.setWindowEvents();
        this.setSearchEvents();
        this.setFiltersEvents();
        this.areCategoriesSearching = false;
    }

    setCheckboxListEvents() {
        $(".checkbox-list").scrollbar();
        $("#categories-list").scrollbar();
        $("#authors-list").scrollbar();
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
                controller.getQuotes().then(() =>{
                    setTimeout(() => {actualLoading = false}, 600);
                });
            }
        })
    }

    setSearchEvents() {
        $("#category-search-input").on("keyup", () => {categoriesSearch.search(categoriesSearch)});
        $("#category-search-input").on("cut", () => {categoriesSearch.search(categoriesSearch)});
        $("#author-search-input").on("keyup", () => {authorsSearch.search(authorsSearch)});
        $("#author-search-input").on("cut", () => {authorsSearch.search(authorsSearch)});
    }

    setFiltersEvents() {
        $("#filter-button").click(controller.filter);
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

class FilterSearch {
    constructor(s, p) {
        this.singular = s;
        this.plural = p;
        this.isSearching = false;
    }

    search(self, repeat = false) {
        if(!self.isSearching || repeat) {
            self.isSearching = true;
            let phrase = $(`#${self.singular}-search-input`).val();

            if(phrase != "")
                controller.find(self.singular, self.plural, phrase).then((data) => {self.generateFilters(self, data)});
            else 
                $(`#${self.plural}-list`).html("Wyszukaj filtry");
            let timeout = setTimeout(() => {
                self.checkResultsAreActual(self, phrase);
            }, 700);
        }
    }

    checkResultsAreActual(self, phrase) {
        if(phrase != $(`#${self.singular}-search-input`).val()) {
            self.search(self, true);
        }
        else {
            self.isSearching = false;
        }
    }

    generateFilters(self, data) {
        let newContent = (data.length == 0) ? "Nie znaleziono wyników" : "";
        $(`#${self.plural}-list`).text(newContent);

        data.forEach((filter) => {
            let name = filter["name"];
            if(self.singular == 'category') {
                name = name.toLowerCase();
                name = name.charAt(0).toUpperCase() + name.slice(1);
            }
            let newFilter = $(`
            <div class="filter-value-container">
                <div class="filter-value">
                    <span>${name}</span>
                    <img src="/assets/icons/close.svg">
                </div>
            </div>
            `);
            $(newFilter).click(function() {$(this).find(".filter-value").toggleClass("selected")});
            $(`#${self.plural}-list`).append($(newFilter));
        });
    }
}