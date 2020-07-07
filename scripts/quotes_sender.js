$(document).ready(() => {
    $("#add-quote-button").on("click",sendQuote)
});

function sendQuote() {
    let data = {
        content: Math.random(),
        author: Math.random(),
        categories: [Math.random()]
    };
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
            }
        });
    }
    else {
        alert("Ups :(");
    }
}

function prepareDataToSend() {
    addCategoryToList();
    
    let data = {
        content: $("#add-quote-content").val(),
        author: $("#add-quote-author").val(),
        categories: []
    };

    $(".selected-category").each(function() {
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