let displayedQuotes = 25;
let allQuotesCount;


$(document).ready(() => {
    let start = Date.now();
    resetQuotesPanel();
    getQuotes(0);	
    $("#check-all").change(function() {	 
        let checked = $(this).prop("checked");	  
        $(".check-quote").prop("checked", checked);	   
    });	

    $("#delete-checked").click(() => {removeSelectedQuotes()});

    let left = Date.now() - start;	 
    console.log(`%c${left}ms`, "color: #0A0");
});