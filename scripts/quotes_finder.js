$("#search-input").on("keydown", function(e) {
    if(e.keyCode == 13) {
        findQuote($(this).val(), true, false, false);
        $("#cancel-second-search").hide();
        $("#cancel-search").hide();
        $("#cancel-search").show();
    }
});

$("#second-search-input").on("keydown", function(e) {
    if(e.keyCode == 13) {
        let byAuthor = $("#search-by-author").prop("checked");
        let byCategory = $("#search-by-category").prop("checked");

        $("#cancel-second-search").hide();
        $("#cancel-search").hide();
        $("#cancel-second-search").show();
        findQuote($(this).val(), false, byAuthor, byCategory);
    }
});

$("#cancel-search").on("click", function() {
    resetQuotesPanel();
    getQuotes(0);
    $("#search-input").val("");
    $("#cancel-search").hide();
});

$("#cancel-second-search").on("click", function() {
    resetQuotesPanel();
    getQuotes(0);
    $("#second-search-input").val("");
    $("#cancel-second-search").hide();
});

function findQuote(phrase, byContent = false, byAuthor = false, byCategory = false) {
    if(phrase != "") {
        let data = {
            phrase: phrase,
            byContent: byContent,
            byAuthor: byAuthor,
            byCategory: byCategory
        }
    
        $.ajax({
            method: "GET",
            url: "../php/scripts/findQuote.php",
            data: {
                token: token,
                data: data
            },
            success: (msg) => {
                if(msg != "") {
                    resetQuotesPanel();
                    generateQuotesDOM(msg);
                    addEventsToQuotes();
                }
            },
            async: false
        });
    }
    
}