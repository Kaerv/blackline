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

function editArticle(id) {
    let cells = $(`.article-${id}`).parent().children()
    let content = $(cells[1]).text();
    let title = $(cells[1]).text();
    let author = $(cells[3]).text();
    let publication = $(cells[3]).text();

    $("#edit-quote-header").text(`Edycja artykułu nr #${id}`);
    $("#edit-quote-header").attr("class", id);
    $("#edit-quote-title").val(title);
    $("#edit-quote-publication").val(publication);
    $("#edit-quote-content").val(content);
    $("#edit-quote-author").val(author);

    $("#add-quote-content").val(content);
    $("#add-quote-author").val(author);

    $("#edit-quote-background").show();
    $("#edit-quote-panel").fadeIn(400);
}

function cancelEditing() {
    $("#edit-quote-background").fadeOut(200);
    $("#edit-quote-panel").hide();
    clearForm();
}
