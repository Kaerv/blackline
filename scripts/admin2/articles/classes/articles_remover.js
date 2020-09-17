function removeArticle(id, oneArticle) {
    $.ajax({
        method: "POST",
        url: "../php/scripts/removeArticle.php",
        data: {
            token: token,
            id: id
        },
        success: (msg) => {
            let result = msg.split(";");
            if(result[0] == "0") {
                if(oneArticle) {
                    getArticlesCount();
                    resetArticlesPanel();
                    getArticles(0);
                    logger.log("Usunięto artykuł!");
                }
            }
            else {
                console.log(result[1]);
                logger.error(`Wystąpił błąd podczas usuwania artykułu: ${result[1]}`);
            }
        },
        async: false
    });
}

function removeSelectedArticlesQuotes() {
    $(".check-quote").each(function() {
        if($(this).prop("checked")) {
            let id = $(this).parent().parent().attr("class").split("-")[1];
            removeArticle(id, false);
        }
    });
    $("#check-all").prop("checked", false);
    resetArticlesPanel();
    getArticles(0);
}