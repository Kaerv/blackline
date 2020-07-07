function getQuotes(count) {
    $.ajax({
        method: "GET",
        url: "../helpers/quoteGetter.php",
        data: {
            token: token,
            count: count
        },
        success: (msg) => {
            generateCategoriesDOM(msg);
        },
        async: false
    });
}

function generateCategoriesDOM(msg) {
    let bigData = msg.split("*");
    let quotes = convertRawToObjects(bigData);
    showQuotesInPanel(quotes);
}

function convertRawToObjects(bigData) {
    let quotes = [];
    for(let i = 0; i < bigData.length - 1; i++) {
        let isRepeat = false;
        let data = bigData[i].split(";");
        for(let j = 0; j < quotes.length; j++) {
            if(quotes[j].id == data[0]) {
                quotes[j].categories.push(data[3]);
                isRepeat = true;
            }
        }

        if(!isRepeat) 
            quotes.push(createNewQuoteObject(data));
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

function showQuotesInPanel(quotes) {
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
    
    for(let i = 0; i < quotes.length; i++) {
        let actualAuthor = quotes[i].author;
        quotes[i].author = actualAuthor == "" ? "Autor nieznany" : actualAuthor;

        let categories = "";
        for(let j = 0; j < quotes[i].categories.length; j++) {
            categories += quotes[i].categories[j].toLowerCase();
            categories += ";"
        }

        $("#all-quotes").find("tbody").append(`
        <tr>
                        <td class="quote-${quotes[i].id}">
                            <div class="checkbox-container">
                                <input type="checkbox" class="check-quote">
                                <img src="../assets/icons/checked.svg" alt="">
                            </div>
                            <img src="../assets/icons/edit.svg" alt="">
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

