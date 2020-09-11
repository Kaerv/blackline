$("#edit-quote-background").on("click", function() { cancelEditing() });
$("#cancel-edit").on("click", function() { cancelEditing() });
$("#edit-quote-button").on("click", function() { sendChanges() });

function addRemoveEvent(obj) {
    $(obj).on("click", () => {
        $(obj).remove();
    });
}

function clearForm() {
    $("#add-quote-content").val("");
    $("#add-quote-author").val("");
    $("#add-quote-title").val("");
}

function editQuote(id) {
    let cells = $(`.quote-${id}`).parent().children()
    let content = $(cells[1]).text();
    let translation = $(cells[2]).text();
    let author = $(cells[3]).text();
    let categories = $(cells[4]).text();

    $("#edit-quote-title").text(`Edycja cytatu nr #${id}`);
    $("#edit-quote-title").attr("class", id);
    $("#edit-quote-content").val(content);
    $("#edit-quote-translation").val(translation);
    $("#edit-quote-author").val(author);

    $("#add-quote-content").val(content);
    $("#add-quote-translation").val(translation);
    $("#add-quote-author").val(author);

    categories = categories.split(";");
    categories.pop();

    $("#edit-quote-selected-categories").html("");
    $("#edit-quote-background").show();
    $("#edit-quote-panel").fadeIn(400);
}

function cancelEditing() {
    $("#edit-quote-background").fadeOut(200);
    $("#edit-quote-panel").hide();
    clearForm();
}
