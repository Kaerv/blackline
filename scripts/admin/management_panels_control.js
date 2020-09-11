function changePanelSite(which) {
    widths = [["0%", "0%", "25%"], ["25%", "25%", "0%"]]
    $($(".pusher")[0]).css("width", widths[which][0]);
    $($(".pusher")[1]).css("width", widths[which][1]);
    $($(".pusher")[2]).css("width", widths[which][2]);

    if(which == 0) {
      $("#add-quote-panel").hide();
      $("#all-quotes-panel").fadeIn(500);

    } 

    else {
      $("#all-quotes-panel").hide();
      $("#add-quote-panel").fadeIn(500);
    } 
}