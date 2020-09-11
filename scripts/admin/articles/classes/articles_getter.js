function getArticles(start) {
    console.log(start, allArticlesCount);
    getArticlesCount();
    $.ajax({
        method: "GET",
        url: "../php/scripts/getArticle.php",
        data: {
            token: token,
            start: start
        },
        success: (msg) => {
            $("#loadMoreMessage").parent().remove();
            $("#article-loading-message").parent().remove();
            generateArticlesDOM(msg);
            addEventsToArticles();
            addLoadMoreButton();
        },
        async: true
    });
}

function getArticlesCount() {
    $.ajax({
        method: "GET",
        url: "../php/scripts/getArticlesCount.php",
        data: {
            token: token
        },
        success: (msg) => {
            result = msg.split(";");
            if(result[0] == 0) {
                allArticlesCount = parseInt(result[1]);
            }
            else {
                console.log(result[1]);
            }
        },
        async: false
    });
}

function generateArticlesDOM(msg) {
    let bigData = msg.split("*");
    let articles = convertRawToObjects(bigData);
    addArticlesToPanel(articles);
}

function convertRawToObjects(row) {
    let articles = [];
    for(let i = 0; i < row.length - 1; i++) {
        let article = row[i].split("|");
        article[0] = parseInt(article[0]);
        articles.push(createNewArticleObject(article));
    }
    return articles;
}

function createNewArticleObject(data) {
    let article = {
        id: data[0],
        title: data[1],
        author: data[2],
        dateAdded: data[3],
        datePublication: data[4],
        visitDaily: data[5],
        visitMonthly: data[6],
        visitYearly: data[7]
    }
    return article;
}

function addArticlesToPanel(articles) {
    
    for(let i = 0; i < articles.length; i++) {
        let actualAuthor = articles[i].author;
        articles[i].author = actualAuthor == "" ? "Autor nieznany" : actualAuthor;
        let id = articles[i].id;
        $("#all-quotes").find("tbody").append(`
        <tr>
                        <td class="article-${id}">
                            <div class="checkbox-container">
                                <input type="checkbox" class="check-quote">
                                <img src="../assets/icons/checked.svg" alt="">
                            </div>
                            <img src="../assets/icons/edit.svg" alt="" class="edit-button">
                            <img src="../assets/icons/close.svg" alt="" class="remove">
                        </td>
                        <td>${articles[i].title}</td>
                        <td>${articles[i].author}</td>
                        <td>${articles[i].dateAdded}</td>
                        <td>${articles[i].datePublication}</td>
                        <td>${articles[i].visitDaily}</td>
                        <td>${articles[i].visitMonthly}</td>
                        <td>${articles[i].visitYearly}</td>
                    </tr>
        `);
    }
}

function resetArticlesPanel() {
    displayedArticles = 25;
    $("#all-quotes").find("tbody").html(`
    <tr>
        <th rowspan="2"></th>
        <th rowspan="2"><div class="border">Tytuł</div></th>
        <th rowspan="2"><div class="border">Autor</div></th>
        <th rowspan="2"><div class="border">Data dodania</div></th>
        <th rowspan="2"><div class="border" style="border-right: solid 1px rgba(0,0,0,0.5)">Data publikacji</div></th>
        <th colspan="3">Wizyty</th>
    </tr>
    <tr>
        <th>Dziennie</th>
        <th>Miesięcznie</th>
        <th>Rocznie</th>
    </tr>
    <tr>
        <td colspan="8" id="article-loading-message">Wczytywanie artykułów...</td>
    </tr>
`);
}

function addEventsToArticles() {
    $(".remove").each(function() {
        let selfId = $(this).parent().attr("class").split("-")[1]
        $(this).click(function() {
            removeArticle(selfId, true);
        });
    });
    $(".edit-button").each(function() {
        let selfId = $(this).parent().attr("class").split("-")[1]
        $(this).click(function() {
            editArticle(selfId);
        });
    });
}

function addLoadMoreButton() {
    if(displayedArticles < allArticlesCount + 1) {
        $("#all-quotes").find("tbody").append(`
        <tr>
            <td colspan=9><input type="button" id="load-more-button" value="Wczytaj więcej"></td>`
        );

        $("#load-more-button").on("click", function() {
            $("#load-more-button").parent().html("<div id='loadMoreMessage'>Wczytywanie...</div>");
            getQuotes(displayedArticles);
            displayedArticles += 25;
        });
    }
}

