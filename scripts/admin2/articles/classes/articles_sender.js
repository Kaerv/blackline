$(document).ready(() => {
    $("#add-quote-button").on("click",() => {sendResource("Article")})
});

function sendResource(type) {
    let data = type == "Quote" ? prepareQuoteToSend(false): prepareArticleToSend(false);

    if(data) {
        $.ajax({
            method: "POST",
            url: `../php/scripts/send${type}.php`,
            data: {
                token: token,
                data: data
            },
            success: (msg) => {
                let result = msg.split(";");
                if(result[0] == "0") {
                    logger.log("Dodano pomyślnie!");
                    getResourcesCount();
                    resetResourcesPanel();
                    getResources(0);
                    clearForm();
                }
                else {
                    logger.error(`Wystąpił błąd podczas dodawania: ${result[1]}`);
                }
            },
            async: false
        });
    }
    else {
        logger.error(`Wprowadzone dane są niepoprawne!`);
    }
}

function prepareArticleToSend(existing) {
    let data = {
        title: $(`#${existing? "edit" : "add"}-quote-title`).val(),
        content: $(`#${existing? "edit" : "add"}-quote-content`).val(),
        author: $(`#${existing? "edit" : "add"}-quote-author`).val(),
        publication: $(`#${existing? "edit" : "add"}-quote-publication`).val(),
    };

    if(existing) {
        data.id = $("#edit-quote-header").attr("class");
    }

    if(data.publication == "") {
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;
        data.publication = dateTime;
    }

    if(dataIsValid(data, "quote"))
        return data;

    return false;
}

function dataIsValid(data, type) {
    isValid = true;

    if(data.content == "") {
        isValid = false;
    }

    if(type == "quote" && data.categories.length == 0) {
        isValid = false;
    }

    return isValid;
}

function sendChanges() {
    let data = prepareDataToSend(true);
    removeResource(data.id);

    if(data) {
        $.ajax({
            method: "POST",
            url: "../php/scripts/sendArticle.php",
            data: {
                token: token,
                data: data
            },
            success: (msg) => {
                let result = msg.split(";");
                if(result[0] == "0") {
                    resetArticlesPanel();
                    getArticles(0);
                    clearForm();
                    $("#search-input").val("");
                    $("#cancel-search").hide();
                    logger.log("Edytowano artykuł!");
                }
                else {
                    logger.error(`Wystąpił błąd podczas edytowania artykułu: ${result[1]}`);
                    sendArticle();
                }
                cancelEditing();
            },
            async: false
        });
    }
    else {
        alert("Ups :(");
    }

}