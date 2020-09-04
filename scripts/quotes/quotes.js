$(document).ready(function() {
    showLoadingMessage();
    loadQuotes(0);  
});

function showLoadingMessage() {
    $("#loading-message").append("Ładowanie...");
}

function hideLoadingMessage() {
    $("#loading-message").html("");
}

function loadQuotes(start) {
    $.ajax({
        url: "/php/quotes.php",
        method: "GET",
        data: {
            token: token,
            start: start  
        },
        success: function(response) {
            let quotes = parseQuotes(response);
            let filters = new Filters(quotes);
            showQuotes(quotes);
            hideLoadingMessage(); 
            filters.init();
        }
    });
}

function parseQuotes(response) {
    let quotesArray = response.split("*");
    let quotesObjectsArray = [];
    quotesArray.forEach((item, index) => {
        let data = item.split("|");
        let sameQuoteExists = false;

        quotesObjectsArray.forEach((q, i) => {
            if(q.id == data[0]) {
                sameQuoteExists = true;
                q.categories.push(data[3])
            }
        });
        if(!sameQuoteExists) {
            quotesObjectsArray.push({
                id: data[0],
                content: data[1],
                author: data[2],
                categories: [data[3]],
                dateAdded: data[4],
                visitDaily: data[5],
                visitMonthly: data[6],
                visitYearly: data[7]
            });
        }
    });
    quotesObjectsArray.pop(); // last item is undefined
    return quotesObjectsArray;
}

function showQuotes(quotes) {
    let i = 0;
    quotes.forEach((quote) => {
        $("#quotes").append(quoteHTML(quote));
    });
}

function quoteHTML(quote) {
    let element = `
    <div class="quote">
        <div class="quote-id">id = ${quote.id}</div>
        <div class="quote-content">content = ${quote.content}</div>
        <div class="quote-author">author = ${quote.author}</div>
        <div class="quote-category1">category 1 = ${quote.categories[0]}</div>
        <div class="quote-category2">category 2 = ${quote.categories[1]}</div>
        <div class="quote-category3">category 3 = ${quote.categories[2]}</div>
        <div class="quote-dateAdded">dateAdded = ${quote.dateAdded}</div>
        <div class="quote-visitDaily">visitDaily = ${quote.visitDaily}</div>
        <div class="quote-visitMonthly">visitMonthly = ${quote.visitMonthly}</div>
        <div class="quote-visitYearly">visitYearly = ${quote.visitYearly}</div>
    </div>
    `;
    return element;
}