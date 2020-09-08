$(document).ready(() => {
    $("#add-quote-button").on("click",sendQuote)
});

function sendQuote() {
    let data = prepareDataToSend(false);
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
                    logger.log("Dodano cytat!");
                    getQuotesCount();
                    resetQuotesPanel();
                    getQuotes(0);
                    clearForm();
                }
                else {
                    logger.error(`Wystąpił błąd podczas dodawania cytatu: ${result[1]}`);
                }
            },
            async: false
        });
    }
    else {
        logger.error(`Wprowadzone dane są niepoprawne!`);
    }
}

function prepareDataToSend(existingQuote) {
    addCategoryToList(existingQuote);
    
    let data = {
        content: $(`#${existingQuote? "edit" : "add"}-quote-content`).val(),
        author: $(`#${existingQuote? "edit" : "add"}-quote-author`).val(),
        categories: []
    };

    if(existingQuote) {
        data.id = $("#edit-quote-title").attr("class");
    }

    $(`.selected${existingQuote? "-edited" : ""}-category`).each(function() {
        data.categories.push( $(this).text() );
    });

    if(dataIsValid(data))
        return data;

    return false;
}

function dataIsValid(data) {
    isValid = true;

    if(data.content == "") {
        isValid = false;
    }

    if(data.categories.length == 0) {
        isValid = false;
    }

    return isValid;
}

function createRandomQuotes(count) {
    for(let i = 0; i < count; i++) {
        $("#add-quote-content").val(`${i}`);
        $("#add-quote-author").val(`${i}`);
        $("#add-quote-category").val(`${i}`);
        sendQuote();
    }
}

function sendChanges() {
    let data = prepareDataToSend(true);
    removeQuote(data.id);

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