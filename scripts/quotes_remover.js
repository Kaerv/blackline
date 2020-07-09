function removeQuote(id) {
    $.ajax({
        method: "POST",
        url: "../helpers/quoteRemover.php",
        data: {
            token: token,
            id: id
        },
        success: (msg) => {
            let result = msg.split(";");
            if(result[0] == "0") {
                getQuotes(displayedQuotes);
            }
            else {
                console.log(result[1]);
            }
        },
        async: false
    });
}

function removeSelectedQuotes() {
    $("#check-all").prop("checked", false);
    $(".check-quote").each(function() {
        if($(this).prop("checked")) {
            let id = $(this).parent().parent().attr("class").split("-")[1];
            removeQuote(id);
        }
    });
}