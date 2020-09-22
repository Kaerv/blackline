let controller;
$(document).ready(() => {
    controller = eval(`new ${controllerName}()`);

    controller.getAllCount()
    .then(controller.getRows)
    .then(() => {$("#panel-loading-cover").fadeOut(500)});
});

function changePanelSite(which) {
    widths = [["0%", "0%", "25%"], ["25%", "25%", "0%"]]
    $($(".pusher")[0]).css("width", widths[which][0]);
    $($(".pusher")[1]).css("width", widths[which][1]);
    $($(".pusher")[2]).css("width", widths[which][2]);

    if(which == 0) {
      $("#add-panel").hide();
      $("#all-resources-panel").fadeIn(500);

    } 

    else {
      $("#all-resources-panel").hide();
      $("#add-panel").fadeIn(500);
    } 
}