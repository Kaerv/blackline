$(document).ready(() => {
    let start = Date.now();
    getQuotes(50);
    $("#check-all").change(function() {
        let checked = $(this).prop("checked");
        $(".check-quote").prop("checked", checked);
    });

    $(".remove").each(function() {
        let selfId = $(this).parent().attr("class").split("-")[1]
        $(this).click(function() {
            removeQuote(selfId);
        });
    })

    let left = Date.now() - start;
    console.log(`%c${left}ms`, "color: #0A0");
})