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
                }
            }
            else {
                console.log(result[1]);
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