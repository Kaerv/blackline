class PreviewQuotesController {
    constructor() {
        this.loadedCount = 25;
        this.totalCount;
        this.countByStep = 25;
        this.tryCount = 0;

        this.getCount();
    }

    getCount() {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: "/php/quotes.php",
                dataType: "JSON",
                data: {
                    q: "count",
                },
            }).done((response) => {
                if(response[0] == 0) {
                    previewController.tryCount = 0;
                    previewController.totalCount = response[1];
                    resolve();
                }
                else {
                    if(previewController.tryCount < 3) {
                        previewController.tryCount++;
                        console.log(`Getting count failed, try ${previewController.tryCount} from 3`)
                        previewController.getCount();
                    }
                    else {
                        previewController.tryCount = 0;
                    }
                }
            }).fail(() => {
                if(previewController.tryCount < 3) {
                    previewController.tryCount++;
                    console.log(`Getting count failed, try ${previewController.tryCount} from 3`)
                    previewController.getCount();
                }
                else {
                    previewController.tryCount = 0;
                }
            });
        });
    }

    getQuotes() {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: "/php/quotes.php",
                dataType: "JSON",
                data: {
                    q: "quotes",
                    args: {
                        start: previewController.loadedCount,
                        step: previewController.countByStep,
                        order: $("#sort-actual").attr("class"),
                        filters: previewController.getFiltersArray(),
                        customer_id: customerId
                    }
                },
            }).done((response) => {
                if(response[0] == 0) {
                    previewController.tryCount = 0;
                    previewController.loadedCount += previewController.countByStep;
                    quotesUI.generateQuotes(response[1]);
                    resolve();
                }
                else {
                    if(previewController.tryCount < 3) {
                        previewController.tryCount++;
                        console.log(`Getting quotes failed, try ${previewController.tryCount} from 3`)
                        previewController.getQuotes();
                    }
                    else {
                        previewController.tryCount = 0;
                    }
                }
            }).fail((response) => {
                if(previewController.tryCount < 3) {
                    previewController.tryCount++;
                    console.log(`Getting quotes failed, try ${previewController.tryCount} from 3`)
                    previewController.getQuotes();
                }
                else {
                    previewController.tryCount = 0;
                }
            });
        });
    }

    find(singular, plural, phrase) {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: "/php/quotes.php",
                dataType: "JSON",
                data: {
                    q: `find_filters`,
                    args: {
                        plural: plural,
                        singular: singular,
                        phrase: phrase
                    }
                },
            }).done((response) => {
                if(response[0] == 0) {
                    resolve(response[1]);
                }
                else {
                }
            }).fail(() => {
            });
        })
    }

    filter() {
        let baseUrl = currentUrl.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
        let sortPos = baseUrl.indexOf("&sort");
        let filtersPos = baseUrl.indexOf("&filters");
        
        if(sortPos != -1)
            baseUrl = baseUrl.substr(0, sortPos);

        if(filtersPos != -1)
            baseUrl = baseUrl.substr(0, filtersPos);

        let sortUrl = `&sort=${$("#sort-actual").attr("class")}`;
        let filterUrl = previewController.createFilterUrl();
        let newUrl = baseUrl + sortUrl + filterUrl;
        window.location.replace(newUrl);
    }

    createFilterUrl() {
        let filterUrl = ""
        if($("#selected-authors-list .filter-value.selected").length || $("#selected-categories-list .filter-value.selected").length)
            filterUrl += "&filter=";

        if($("#selected-authors-list .filter-value.selected").length > 0)
            filterUrl += "autorzy:";

        $("#selected-authors-list .filter-value.selected span").each(function () {
            if(filterUrl[filterUrl.length - 1] != ":") 
                filterUrl += "/";
            filterUrl += $(this).text().split(' ').join('+');
        });

        if($("#selected-categories-list .filter-value.selected").length > 0) {
            if(filterUrl.includes("autorzy")) 
                filterUrl += "|"

            filterUrl += "kategorie:";
        }

        $("#selected-categories-list .filter-value.selected span").each(function () {
            if(filterUrl[filterUrl.length - 1] != ":") 
                filterUrl += "/";
            filterUrl += $(this).text().split(' ').join('+');
        });
        return filterUrl;
    }

    getFiltersArray() {
        let categories = [];
        let authors = [];

        $("#selected-authors-list .filter-value.selected span").each(function () {
            authors.push($(this).text());
        });

        $("#selected-categories-list .filter-value.selected span").each(function () {
            categories.push($(this).text());
        });
        return {
            "kategorie": categories,
            "autorzy": authors
        };
    }

    like(quoteId, customerId) {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: "/php/quotes.php",
                dataType: "JSON",
                data: {
                    q: `like`,
                    args: {
                        quote_id: quoteId,
                        customer_id: customerId
                    }
                },
            }).done((response) => {
                if(response[0] == 0) {
                    resolve(response[1]);
                }
                else {
                }
            }).fail((response, r, aa) => {
                console.log(aa);
            });
        })
    }
}