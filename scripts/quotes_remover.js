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
            console.log(msg);
            if(result[0] == "0") {
                $(`.quote-${id}`).parent().remove();
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
            removeQuote(id);
        }
    });
}