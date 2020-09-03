function removeQuote(id, oneQuote) {
    $.ajax({
        method: "POST",
        url: "../php/scripts/removeQuote.php",
        data: {
            token: token,
            id: id
        },
        success: (msg) => {
            let result = msg.split(";");
            if(result[0] == "0") {
                if(oneQuote) {
                    getQuotesCount();
                    resetQuotesPanel();
                    getQuotes(0);
                    logger.log("Usunięto cytat!");
                }
            }
            else {
                console.log(result[1]);
                logger.error(`Wystąpił błąd podczas usuwania cytatu: ${result[1]}`);
            }
        },
        async: false
    });
}

function removeSelectedQuotes() {
    $(".check-quote").each(function() {
        if($(this).prop("checked")) {
            let id = $(this).parent().parent().attr("class").split("-")[1];
            removeQuote(id, false);
        }
    });
    $("#check-all").prop("checked", false);
    resetQuotesPanel();
    getQuotes(0);
}