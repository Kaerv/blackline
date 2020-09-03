$("#search-input").on("keydown", function(e) {
    if(e.keyCode == 13) {
        findQuote($(this).val());
        $("#cancel-search").show();
    }
});

$("#search-button").on("click", function(e) {
    findQuote($(this).val());
    $("#cancel-search").show();
});

$("#cancel-search").on("click", function() {
    resetQuotesPanel();
    getQuotes(0);
    $("#search-input").val("");
    $("#cancel-search").hide();
});

function findQuote(phrase) {
    if(phrase != "") {
        let data = {
            phrase: phrase,
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