$(document).ready(() => {
    $("#add-quote-button").on("click",sendArticle)
});

function sendArticle() {
    let data = prepareDataToSend(false);
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
                    logger.log("Dodano artykuł!");
                    getArticlesCount();
                    resetArticlesPanel();
                    getArticles(0);
                    clearForm();
                }
                else {
                    logger.error(`Wystąpił błąd podczas dodawania artykułu: ${result[1]}`);
                }
            },
            async: false
        });
    }
    else {
        logger.error(`Wprowadzone dane są niepoprawne!`);
    }
}

function prepareDataToSend(existingArticle) {
    let data = {
        title: $(`#${existingArticle? "edit" : "add"}-quote-title`).val(),
        content: $(`#${existingArticle? "edit" : "add"}-quote-content`).val(),
        author: $(`#${existingArticle? "edit" : "add"}-quote-author`).val(),
        publication: $(`#${existingArticle? "edit" : "add"}-quote-publication`).val(),
    };

    if(existingArticle) {
        data.id = $("#edit-quote-header").attr("class");
    }

    if(data.publication == "") {
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;
        data.publication = dateTime;
    }

    if(dataIsValid(data))
        return data;

    return false;
}

function dataIsValid(data) {
    isValid = true;

    if(data.content == "") {
        isValid = false;
    }

    return isValid;
}

function sendChanges() {
    let data = prepareDataToSend(true);
    removeArticle(data.id);

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