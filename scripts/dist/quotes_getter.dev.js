"use strict";

function getQuotes(start) {
  getQuotesCount();
  $.ajax({
    method: "GET",
    url: "../php/scripts/getQuote.php",
    data: {
      token: token,
      start: start
    },
    success: function success(msg) {
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
    success: function success(msg) {
      result = msg.split(";");

      if (result[0] == 0) {
        allQuotesCount = parseInt(result[1]);
      } else {
        console.log(result[1]);
      }
    },
    async: false
  });
}

function generateQuotesDOM(msg) {
  var bigData = msg.split("*");
  var quotes = convertRawToObjects(bigData);
  addQuotesToPanel(quotes);
}

function convertRawToObjects(row) {
  var quotes = [];

  for (var i = 0; i < row.length - 1; i++) {
    var isRepeat = false;
    var quote = row[i].split("|");
    quote[0] = parseInt(quote[0]);

    for (var j = 0; j < quotes.length; j++) {
      if (quotes[j].id == quote[0]) {
        quotes[j].categories.push(quote[3]);
        isRepeat = true;
      }
    }

    if (!isRepeat) quotes.push(createNewQuoteObject(quote));
  }

  return quotes;
}

function createNewQuoteObject(data) {
  var quote = {
    id: data[0],
    content: data[1],
    author: data[2],
    categories: [data[3]],
    dateAdded: data[4],
    visitDaily: data[5],
    visitMonthly: data[6],
    visitYearly: data[7]
  };
  return quote;
}

function addQuotesToPanel(quotes) {
  for (var i = 0; i < quotes.length; i++) {
    var actualAuthor = quotes[i].author;
    quotes[i].author = actualAuthor == "" ? "Autor nieznany" : actualAuthor;
    var categories = "";

    for (var j = 0; j < quotes[i].categories.length; j++) {
      categories += quotes[i].categories[j].toLowerCase();
      categories += ";";
    }

    var id = quotes[i].id;
    $("#all-quotes").find("tbody").append("\n        <tr>\n                        <td class=\"quote-".concat(id, "\">\n                            <div class=\"checkbox-container\">\n                                <input type=\"checkbox\" class=\"check-quote\">\n                                <img src=\"../assets/icons/checked.svg\" alt=\"\">\n                            </div>\n                            <img src=\"../assets/icons/edit.svg\" alt=\"\" class=\"edit-button\">\n                            <img src=\"../assets/icons/close.svg\" alt=\"\" class=\"remove\">\n                        </td>\n                        <td>").concat(quotes[i].content, "</td>\n                        <td>").concat(quotes[i].author, "</td>\n                        <td>").concat(categories, "</td>\n                        <td>").concat(quotes[i].dateAdded, "</td>\n                        <td>").concat(quotes[i].visitDaily, "</td>\n                        <td>").concat(quotes[i].visitMonthly, "</td>\n                        <td>").concat(quotes[i].visitYearly, "</td>\n                    </tr>\n        "));
  }
}

function resetQuotesPanel() {
  displayedQuotes = 25;
  $("#all-quotes").find("tbody").html("\n    <tr>\n        <th rowspan=\"2\"></th>\n        <th rowspan=\"2\"><div class=\"border\">Tre\u015B\u0107</div></th>\n        <th rowspan=\"2\"><div class=\"border\">Autor</div></th>\n        <th rowspan=\"2\"><div class=\"border\">Kategoria</div></th>\n        <th rowspan=\"2\"><div class=\"border\" style=\"border-right: solid 1px rgba(0,0,0,0.5)\">Data dodania</div></th>\n        <th colspan=\"3\">Wizyty</th>\n    </tr>\n    <tr>\n        <th>Dziennie</th>\n        <th>Miesi\u0119cznie</th>\n        <th>Rocznie</th>\n    </tr>\n");
}

function addEventsToQuotes() {
  $(".remove").each(function () {
    var selfId = $(this).parent().attr("class").split("-")[1];
    $(this).click(function () {
      removeQuote(selfId, true);
    });
  });
  $(".edit-button").each(function () {
    var selfId = $(this).parent().attr("class").split("-")[1];
    $(this).click(function () {
      editQuote(selfId);
    });
  });
}

function addLoadMoreButton() {
  if (displayedQuotes + 25 < allQuotesCount - 1) {
    $("#all-quotes").find("tbody").append("\n        <tr>\n            <td colspan=8><input type=\"button\" id=\"load-more-button\" value=\"Wczytaj wi\u0119cej\"></td>");
    $("#load-more-button").on("click", function () {
      $("#load-more-button").parent().remove();
      getQuotes(displayedQuotes);
      displayedQuotes += 25;
    });
  }
}