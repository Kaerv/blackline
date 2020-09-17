$(document).ready(() => {
    $("#add-quote-button").on("click",() => {sendResource("Quote")})
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

function prepareQuoteToSend(existing) {
    addCategoryToList(existing);
    
    let data = {
        content: $(`#${existing? "edit" : "add"}-quote-content`).val(),
        translation: $(`#${existing? "edit" : "add"}-quote-translation`).val(),
        author: $(`#${existing? "edit" : "add"}-quote-author`).val(),
        categories: []
    };

    if(existing) {
        data.id = $("#edit-quote-title").attr("class");
    }

    $(`.selected${existing? "-edited" : ""}-category`).each(function() {
        data.categories.push( $(this).text() );
    });

    if(dataIsValid(data, "article"))
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
            url: "../php/scripts/sendQuote.php",
            data: {
                token: token,
                data: data
            },
            success: (msg) => {
                let result = msg.split(";");
                if(result[0] == "0") {
                    resetQuotesPanel();
                    getQuotes(0);
                    clearForm();
                    $("#search-input").val("");
                    $("#cancel-search").hide();
                    logger.log("Edytowano cytat!");
                }
                else {
                    logger.error(`Wystąpił błąd podczas edytowania cytatu: ${result[1]}`);
                    sendQuote();
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