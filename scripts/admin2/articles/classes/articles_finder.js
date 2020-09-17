$("#search-input").on("keydown", function(e) {
    if(e.keyCode == 13) {
        findArticle($(this).val());
        $("#cancel-search").show();
    }
});

$("#search-button").on("click", function(e) {
    findArticle($(this).val());
    $("#cancel-search").show();
});

$("#cancel-search").on("click", function() {
    resetArticlesPanel();
    getArticles(0);
    $("#search-input").val("");
    $("#cancel-search").hide();
});

function findArticle(phrase) {
    if(phrase != "") {
        let data = {
            phrase: phrase,
        }
    
        $.ajax({
            method: "GET",
            url: "../php/scripts/findArticle.php",
            data: {
                token: token,
                data: data
            },
            success: (msg) => {
                if(msg != "") {
                    if(msg.split(";")[0] != "-1") {
                        resetArticlesPanel();
                        $("#loadMoreMessage").parent().remove();
                        $("#quotes-loading-message").parent().remove();
                        generateArticlesDOM(msg);
                        addEventsToArticles();
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