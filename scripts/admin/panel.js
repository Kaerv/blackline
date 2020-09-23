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

function initEditor(edit) {
  container = edit? '#edit-quote-content' : '#add-quote-content';
  tinymce.init({
    selector: container,
    plugins: 'autolink lists media table',
    toolbar: 'undo redo aligncenter alignjustify alignleft alignright bold italic underline forecolor indent subscript superscript fontsizeselect',
    contextmenu: 'undo redo bold italic underline',
    language: 'pl',
    toolbar_mode: 'floating',
    height: "300",
    setup: function (editor) {
      if(!edit) {
        editor.on("init", function () {
          $("#content-label").html("Treść");
        });
      }
    }
  });
}