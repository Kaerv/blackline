$("#add-quote-category").on("keydown", (e) => {
    if(e.keyCode == 13) {
        addCategoryToList();
    }
});

function addCategoryToList() {
    category = $("#add-quote-category").val().toUpperCase();
    if(canAddCategory(category)) {
        $("#add-quote-category").val("");
        newCategoryDom = $(`<div class="selected-category">${category}</div>`);
        $("#add-quote-selected-categories").append($(newCategoryDom));
        addRemoveEvent(newCategoryDom);
    }
}

function canAddCategory(newCategory) {
    quoteDoesNotExist = true;
    $(".selected-category").each(function(){
        if($(this).text() == newCategory)
            quoteDoesNotExist = false;
    });
    return (
        $(".selected-category").length < 3 &&
        $("#add-quote-category").val() != "" &&
        quoteDoesNotExist
        );
}

function addRemoveEvent(obj) {
    $(obj).on("click", () => {
        $(obj).remove();
    });
}

function clearForm() {
    $("#add-quote-content").val("");
    $("#add-quote-author").val("");
    $("#add-quote-category").val("");
    $("#add-quote-selected-categories").html("");
}
