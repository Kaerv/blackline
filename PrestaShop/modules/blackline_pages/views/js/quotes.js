let quotesUI;
let controller;
let categoriesSearch;
let authorsSearch;
$(document).ready(() => {
    categoriesSearch = new FilterSearch("category", "categories");
    authorsSearch = new FilterSearch("author", "authors");
    controller = new QuotesController();
    quotesUI = new QuotesUI();
})