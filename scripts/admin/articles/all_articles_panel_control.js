let displayedArticles = 25;
let allArticlesCount;

$(document).ready(() => {
    let start = Date.now();
    resetArticlesPanel();
    getArticles(0);
    $("#check-all").change(function() {
        let checked = $(this).prop("checked");
        $(".check-article").prop("checked", checked);
    });

    $("#delete-checked").click(() => {removeSelectedArticles()});

    let left = Date.now() - start;
    console.log(`%c${left}ms`, "color: #0A0");
})