let displayedQuotes = 25;

$(document).ready(() => {
    let start = Date.now();
    getQuotes(displayedQuotes);
    $("#check-all").change(function() {
        let checked = $(this).prop("checked");
        $(".check-quote").prop("checked", checked);
    });

    $("#delete-checked").click(() => {removeSelectedQuotes()});

    let left = Date.now() - start;
    console.log(`%c${left}ms`, "color: #0A0");
})