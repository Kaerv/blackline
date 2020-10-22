let acutalText = "";
function updateView(text = acutalText) {
    acutalText = text;
}

$(function() {
    if($(".selected-quote").length) {
        updateView()
    }
});