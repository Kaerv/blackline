function getQuotes(start) {
    getQuotesCount();
    $.ajax({
        method: "GET",
        url: "../php/scripts/getQuote.php",
        data: {
            token: token,
            start: start
        },
        success: (msg) => {
            generateQuotesDOM(msg);
            addEventsToQuotes();
            addLoadMoreButton();
        },
        async: false
    });
}

function getQuotesCount() {
    $.ajax({
        method: "GET",
        url: "../php/scripts/getQuotesCount.php",
        data: {
            token: token
        },
        success: (msg) => {
            result = msg.split(";");
            if(result[0] == 0) {
                allQuotesCount = parseInt(result[1]);
            }
            else {
                console.log(result[1]);
            }
        },
        async: false
    });
}

function generateQuotesDOM(msg) {
    let bigData = msg.split("*");
    let quotes = convertRawToObjects(bigData);
    addQuotesToPanel(quotes);
}

function convertRawToObjects(row) {
    let quotes = [];
    for(let i = 0; i < row.length - 1; i++) {
        let isRepeat = false;
        let quote = row[i].split("|");
        quote[0] = parseInt(quote[0]);

        for(let j = 0; j < quotes.length; j++) {
            if(quotes[j].id == quote[0]) {
                quotes[j].categories.push(quote[3]);
                isRepeat = true;
            }
        }

        if(!isRepeat) 
            quotes.push(createNewQuoteObject(quote));
    }
    return quotes;
}

function createNewQuoteObject(data) {
    let quote = {
        id: data[0],
        content: data[1],
        author: data[2],
        categories: [data[3]],
        dateAdded: data[4],
        visitDaily: data[5],
        visitMonthly: data[6],
        visitYearly: data[7]
    }
    return quote;
}

function addQuotesToPanel(quotes) {
    
    for(let i = 0; i < quotes.length; i++) {
        let actualAuthor = quotes[i].author;
        quotes[i].author = actualAuthor == "" ? "Autor nieznany" : actualAuthor;

        let categories = "";
        for(let j = 0; j < quotes[i].categories.length; j++) {
            categories += quotes[i].categories[j].toLowerCase();
            categories += ";"
        }
        let id = quotes[i].id;
        $("#all-quotes").find("tbody").append(`
        <tr>
                        <td class="quote-${id}">
                            <div class="checkbox-container">
                                <input type="checkbox" class="check-quote">
                                <img src="../assets/icons/checked.svg" alt="">
                            </div>
                            <img src="../assets/icons/edit.svg" alt="" class="edit-button">
                            <img src="../assets/icons/close.svg" alt="" class="remove">
                        </td>
                        <td>${quotes[i].content}</td>
                        <td>${quotes[i].author}</td>
                        <td>${categories}</td>
                        <td>${quotes[i].dateAdded}</td>
                        <td>${quotes[i].visitDaily}</td>
                        <td>${quotes[i].visitMonthly}</td>
                        <td>${quotes[i].visitYearly}</td>
                    </tr>
        `);
    }
}

function resetQuotesPanel() {
    displayedQuotes = 25;
    $("#all-quotes").find("tbody").html(`
    <tr>
        <th rowspan="2"></th>
        <th rowspan="2"><div class="border">Treść</div></th>
        <th rowspan="2"><div class="border">Autor</div></th>
        <th rowspan="2"><div class="border">Kategoria</div></th>
        <th rowspan="2"><div class="border" style="border-right: solid 1px rgba(0,0,0,0.5)">Data dodania</div></th>
        <th colspan="3">Wizyty</th>
    </tr>
    <tr>
        <th>Dziennie</th>
        <th>Miesięcznie</th>
        <th>Rocznie</th>
    </tr>
`);
}

function addEventsToQuotes() {
    $(".remove").each(function() {
        let selfId = $(this).parent().attr("class").split("-")[1]
        $(this).click(function() {
            removeQuote(selfId, true);
        });
    });
    $(".edit-button").each(function() {
        let selfId = $(this).parent().attr("class").split("-")[1]
        $(this).click(function() {
            editQuote(selfId);
        });
    });
}

function addLoadMoreButton() {
    if(displayedQuotes < allQuotesCount - 1) {
        $("#all-quotes").find("tbody").append(`
        <tr>
            <td colspan=8><input type="button" id="load-more-button" value="Wczytaj więcej"></td>`
        );

        $("#load-more-button").on("click", function() {
            $("#load-more-button").parent().remove();
            getQuotes(displayedQuotes);
            displayedQuotes += 25;
        });
    }
}

