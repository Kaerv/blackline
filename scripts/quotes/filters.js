class Filters {
    constructor(quotes) {
        this.quotes = quotes;
        this.filtersData = this.getFiltersData(this.quotes);
    }

    getFiltersData(quotes) {
        let categories = [];
        let authors = []

        quotes.forEach((quote, quoteIndex) => {
            let author = quote.author;
            if(!authors.includes(author)) 
                authors.push(author);
            
            quote.categories.forEach((cat, catIndex) => {
                if(!categories.includes(cat)) 
                    categories.push(cat);
            });
        });
        
        return [
            {
                name: "categories",
                values: categories
            },
            {
                name: "authors",
                values: authors
            }
        ];
    }

    init() {
        this.prepareDOMForFilters();
        this.generateFilters();
    }

    prepareDOMForFilters() {
        this.filtersData.forEach((filter, index) => {
            let filterName = filter.name;
            $("#filters").append(`<div id="${filterName}-filter" class="filter">Wczytywanie filtrów...<div>`);
        });
    }

    generateFilters() {
        this.filtersData.forEach((filter, index) => {
            let filterName = filter.name;
            $(`#${filterName}-filter`).html(`${filterName}`);
            filter.values.forEach((value, index) => {
                $(`#${filterName}-filter`).append(`
                    <div class="filter-option">
                        <label for="${value}">${value}</label>
                        <input type="checkbox" name="${value}">
                    </div>
                `);
            });
        });
    }
}