let formNames = [
    {
        categoryInput: "#add-quote-category",
        newCategoryDOM: `<div class="selected-category">`,
        newCategoryClass: ".selected-category",
        categoriesContainer: "#add-quote-selected-categories",
    }, 
    {
        categoryInput: "#edit-quote-category",
        newCategoryDOM: `<div class="selected-edited-category">`,
        newCategoryClass: ".selected-edited-category",
        categoriesContainer: "#edit-quote-selected-categories"
    }
]

$("#add-quote-category").on("keydown", (e) => {
    if(e.keyCode == 13) {
        addCategoryToList(false);
    }
});

$("#edit-quote-category").on("keydown", (e) => {
    if(e.keyCode == 13) {
        addCategoryToList(true);
    }
});

$("#edit-quote-background").on("click", function() {
    cancelEditing();
});

$("#edit-quote-button").on("click", function() {
    sendChanges();
});

function addCategoryToList(existingQuote) {
    let selectedNames = existingQuote? formNames[1] : formNames[0];

    category = $(selectedNames.categoryInput).val().toUpperCase();

    if(canAddCategory(category, selectedNames)) {
        $(selectedNames.categoryInput).val("");
        newCategoryDom = $(`${selectedNames.newCategoryDOM}${category}</div>`);
        $(selectedNames.categoriesContainer).append($(newCategoryDom));
        addRemoveEvent(newCategoryDom);
    }

}

function canAddCategory(newCategory, selectedNames) {
        quoteDoesNotExist = true;
        $(selectedNames.newCategoryClass).each(function(){
            if($(this).text() == newCategory)
                quoteDoesNotExist = false;
        });
        return (
            $(selectedNames.newCategoryClass).length < 3 &&
            $(selectedNames.categoryInput).val() != "" &&
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

function editQuote(id) {
    let cells = $(`.quote-${id}`).parent().children()
    let content = $(cells[1]).text();
    let author = $(cells[2]).text();
    let categories = $(cells[3]).text();

    $("#edit-quote-title").text(`Edycja cytatu nr #${id}`);
    $("#edit-quote-title").attr("class", id);
    $("#edit-quote-content").val(content);
    $("#edit-quote-author").val(author);

    categories = categories.split(";");
    categories.pop();

    $("#edit-quote-selected-categories").html("");
    categories.forEach((category) => {
        let newCategoryDom = $(`<div class="selected-edited-category">${category.toUpperCase()}</div>`);
        $("#edit-quote-selected-categories").append($(newCategoryDom));
        addRemoveEvent(newCategoryDom);
    });
    
    $("#edit-quote-background").show();
    $("#edit-quote-panel").fadeIn(400);
}

function cancelEditing() {
    $("#edit-quote-background").fadeOut(200);
    $("#edit-quote-panel").hide();
}
