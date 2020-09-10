$(document).ready(() => {
    let quotesLoader = new QuotesLoader();
});

class QuotesLoader {
    constructor() {
        this.areQuotesLoaded = false;
        this.controlWindowScroll();
        this.start = 25;
        this.getQuotesCount();
    }

    getQuotesCount() {
        $.ajax({
            url: "/php/scripts/front/liveQuotesLoad.php",
            method: "GET",
            data: {
                token: token,
                q: $_GET("q"),
                query: "count"
            },
            success: (msg) => {
                this.max = parseInt(msg);
            }
        })
    }

    controlWindowScroll() {
        $(window).on("scroll", () => {
            let quotesBottom = $("#quotes").offset().top + $("#quotes").height();
            let endOfQuotes = quotesBottom - $(window).innerWidth();
        
            if($(window).scrollTop() >= endOfQuotes) {
                this.loadMoreQuotes();
            }
        });

    }

    loadMoreQuotes() {
        if(!this.areQuotesLoaded && this.start < this.max + 1) {
            $("#quotes").append("<div id='new-quotes-loading-message'>Wczytywanie cytatów...</div>")
            this.areQuotesLoaded = true;
            $.ajax({
                url: "/php/scripts/front/liveQuotesLoad.php",
                method: "GET",
                data: {
                    token: token,
                    start: this.start,
                    q: $_GET("q"),
                    query: "quotes"
                },
                success: (msg) => {
                    let quotes = this.parseQuotes(msg);
                    this.createQuotesDOM(quotes);
                    $("#new-quotes-loading-message").remove();
                    this.start += 25;
                    this.areQuotesLoaded = false;
                }
            });
        }
    }

    parseQuotes(data) {
        data = data.substring(0, data.length - 1);
        data = data.split("*");
        let quotes = [];
        data.forEach(function(quote) {
            quote = quote.split("|");
            quote[4] = quote[4].split("@");
            quotes.push(quote);
        });
        return quotes;
    }

    createQuotesDOM(quotes) {
        quotes.forEach((quote) => {
            let categoriesDOM = "";
            quote[4].forEach((category) => {
                categoriesDOM += `<span class="category">${category}</span>`
            });
            $("#quotes").append(`
            <div class="quote" id="quote-${quote[0]}">
                <div class="quote-mark">,,</div>
                <div class="quote-content">${quote[1]}</div>
                <div class="quote-translation">${quote[2]}</div>
                <div class="quote-author">${quote[3]}</div>
                <div class="categories-container">
                    ${categoriesDOM}
                </div>
            </div>
            `);
        });
    }
}