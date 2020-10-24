class QuotesUI {
    constructor() {
        this.setCheckboxListEvents();
        this.setSortEvents();
        this.setWindowEvents();
        this.setSearchEvents();
        this.setFiltersEvents();
        this.setFavouritesEvents();
        this.setCreatorEvents();
        this.areCategoriesSearching = false;
    }

    setCheckboxListEvents() {
        $(".checkbox-list").scrollbar();
        $("#categories-list").scrollbar();
        $("#authors-list").scrollbar();
        $("#selected-categories-list").scrollbar();
        $("#selected-authors-list").scrollbar();
        $("#all-authors-title").click(() => {
            $("#all-authors-list").toggle();
            $("#all-authors-button").toggleClass('button-rotated');
        });
        $("#best-authors input").click(function() {
            let filter = $(this).parents(".custom-checkbox").find(".checkbox-label").text();
            let type = "authors";
            let selected = $(this).prop("checked");
            quotesUI.selectFilter(type, filter, selected);
        });
        $("#all-authors input").click(function() {
            let filter = $(this).parents(".custom-checkbox").find(".checkbox-label").text();
            let type = "authors";
            let selected = $(this).prop("checked");
            quotesUI.selectFilter(type, filter, selected);
        });
    }

    setSortEvents() {
        $(document).click(() => {
            if($("#quote-sort-list").is(":visible")) {
                $("#sort-input > img").toggleClass("button-rotated");
            }
            $("#quote-sort-list").hide();
        })
        $("#sort-input").click((event) => {
            $("#quote-sort-list").toggle();
            $("#sort-input > img").toggleClass("button-rotated");
            event.stopImmediatePropagation();
        });

        $(".sort-option").click(function() {
            let name = $(this).text();
            let filter = $(this).attr("id");
                $("#sort-actual").removeClass().addClass(filter).text(name);
                controller.filter();
        })
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
        $(".filter-value.selected").parent().click(function() {
            let filter = $(this).find("span").text();
            let type = $(this).parent().attr("id").split("-")[1];
            let selected = false;
            quotesUI.selectFilter(type, filter, selected);
        });
        $("#filter-button").click(controller.filter);

        $("#clear-filters").click(function() {
            $(".filter-value.selected").parent().remove();
            controller.filter();
        });
    }

    setFavouritesEvents() {
        $(".fav-ico").click(function() {
            if(prestashop.customer.is_logged) {
                let quoteId = $(this).parents(".quote").attr("id");
                let likesCount = $(this).parent().find(".fav-count > span");
                controller.like(quoteId, customerId).then((response) => {
                    $(likesCount).text(response["likes"]);
                    if(response["liked"]) {
                        $(this).addClass("liked");
                        $(this).attr("src", "/assets/icons/heart black.svg");
                    }
                    else {
                        $(this).removeClass("liked");
                        $(this).attr("src", "/assets/icons/heart.svg");
                    }
                });
            }
            else {
                alert("Żeby móc polubić ten cytat, musisz się zalogować.");
            }
        });
    }

    setCreatorEvents() {
        $("#cancel-quote").on("click", function(){
            $.ajax({
                url:`${prestashop.urls.base_url}index.php?fc=module&module=blackline_creator&controller=abortcreator&ajax=true`,
                data: {
                },
                method: "POST",
                success: function(response) {
                    console.log(response);
                    if(response == 1)
                        window.location.reload();
                }
        });
        });
    }

    generateQuotes(data) {
        data.forEach(function (quote) {
            let categories = "";
            quote.categories.forEach(function (category) {
                categories += `<span>${category}</span>`;
            });
            let newQuote = $(`
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
                        
                    </div>
                    <div class="quote-embed">
                        <img class="embed-ico" src="/assets/icons/embed.png">
                        <div class="embed-message">Umieść na produkcie</div>
                    </div>
                </div>
                <div class="add-to-product">
                <a href="${prestashop.urls.base_url}index.php?fc=module&module=blackline_creator&controller=creator&quote_id=${quote.id}>Wybierz</a>
                </div>
            </div>
            `);
            let favIco = $(`<img src="/assets/icons/heart${quote.liked > 0? " black" : ""}.svg" class="fav-ico ${quote.liked > 0? "liked" : ""}">`);
            $(newQuote).find(".quote-favourite").append(favIco);
            $("#quotes-container").append(newQuote);
        });
    }

    selectFilter(type, filter, selected) {
        if(selected) {
            $(`#${type}-list span`).each(function() {
                if($(this).text() == filter) {
                    $(this)
                    .parents(".filter-value").addClass("selected")
                    .parents(".filter-value-container").hide();
                }
            });
            quotesUI.createNewSelectedFilter(type, filter);
        }
        else {
            $(`#selected-${type}-list span`).each(function() {
                if($(this).text() == filter) {
                    $(this).parents(".filter-value-container").remove();
                    
                }
            });
            $(`#${type}-list span`).each(function() {
                if($(this).text() == filter) {
                    $(this)
                    .parents(".filter-value").removeClass("selected")
                    .parents(".filter-value-container").show();
                }
            });
        }
        if(type == "authors") {
            $("#all-authors-list .custom-checkbox, #best-authors .custom-checkbox").each(function() {
                let currentLabel = $(this).find(".checkbox-label").text();
                if(filter == currentLabel) {
                    $(this).find("input").prop("checked", selected);
                }
                    
            })
        }
    }

    createNewSelectedFilter(type, filter) {
        let newFilter = $(`
        <div class="filter-value-container">
            <div class="filter-value selected">
                <span>${filter}</span>
                <img src="/assets/icons/close.svg">
            </div>
        </div>
        `);
        $(newFilter).click(function() {
            let filter = $(this).find("span").text();
            let type = $(this).parent().attr("id").split("-")[1];
            let selected = false;
            quotesUI.selectFilter(type, filter, selected);
        });
        $(`#selected-${type}-list`).append($(newFilter));
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
                $(`#${self.plural}-list .filter-value-container`).each(function() {
                    $(this).remove();
                });

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
        $(`#${self.plural}-list .filter-value-container`).each(function() {
            $(this).remove();
        })

        data.forEach((filter) => {
            let name = filter["name"];
            if(self.singular == 'category') {
                name = name.toLowerCase();
                name = name.charAt(0).toUpperCase() + name.slice(1);
            }
            if(!$(`#${self.plural}-list span:contains('${name}')`).length) {
                let newFilter = $(`
                <div class="filter-value-container">
                    <div class="filter-value">
                        <span>${name}</span>
                        <img src="/assets/icons/close.svg">
                    </div>
                </div>
                `);
                $(newFilter).click(function() {
                    let filter = $(this).find("span").text();
                    let type = $(this).parent().attr("id").split("-")[0];
                    let selected = true;
                    quotesUI.selectFilter(type, filter, selected);
                });
                let quoteIsSelected = false;
                $(`#selected-${self.plural}-list span`).each(function() {
                    if($(this).text() == name)
                        quoteIsSelected = true;
                });
                if(!quoteIsSelected)
                    $(`#${self.plural}-list`).append($(newFilter));
            }
        });
    }
}