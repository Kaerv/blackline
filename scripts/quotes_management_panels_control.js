function changePanelSite(which) {
    widths = [["0%", "0%", "25%"], ["25%", "25%", "0%"]]
    $($(".pusher")[0]).css("width", widths[which][0]);
    $($(".pusher")[1]).css("width", widths[which][1]);
    $($(".pusher")[2]).css("width", widths[which][2]);

    $("#all-quotes-panel").css({"position": "absolute"});
    $("#add-quote-panel").css({"position": "absolute"});

    if(which == 0) {
      $("#all-quotes-panel").fadeIn(500);
      $("#add-quote-panel").fadeOut(500);
    } 

    else {
      $("#all-quotes-panel").fadeOut(500);
      $("#add-quote-panel").fadeIn(500);
    } 
       
    setTimeout(() => {
        $("#all-quotes-panel").css({"position": "relative"});
        $("#add-quote-panel").css({"position": "relative"});
    }, 500)
}