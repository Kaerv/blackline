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
                console.log(msg);
                if(msg != "") {
                    if(msg.split(";")[0] != "-1") {
                        resetQuotesPanel();
                        $("#loadMoreMessage").parent().remove();
                        $("#quotes-loading-message").parent().remove();
                        generateQuotesDOM(msg);
                        addEventsToQuotes();
                    }
                    else {
                        logger.error(`Wystąpił błąd: ${msg.split(";")[1]}`)
                    }
                }
            },
            async: false
        });
    }
    
}