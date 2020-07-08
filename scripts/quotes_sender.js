$(document).ready(() => {
    $("#add-quote-button").on("click",sendQuote)
});

function sendQuote() {
    let data = prepareDataToSend(false);
    if(data) {
        $.ajax({
            method: "POST",
            url: "../helpers/quoteSender.php",
            data: {
                token: token,
                data: data
            },
            success: (msg) => {
                let result = msg.split(";");
                if(result[0] == "0") {
                    getQuotes(50);
                    clearForm();
                }
                else {
                    console.log(result[1]);
                }
            },
            async: false
        });
    }
    else {
        alert("Ups :(");
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
        $("#add-quote-content").val(Math.random());
        $("#add-quote-author").val(Math.random());
        $("#add-quote-category").val(Math.random());
        sendQuote();
    }
}

function sendChanges() {
    let data = prepareDataToSend(true);
    removeQuote(data.id);

    if(data) {
        $.ajax({
            method: "POST",
            url: "../helpers/quoteSender.php",
            data: {
                token: token,
                data: data
            },
            success: (msg) => {
                let result = msg.split(";");
                if(result[0] == "0") {
                    getQuotes(50);
                }
                else {
                    console.log(result[1]);
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