let categoriesCount = 0;
let inputs = [
    {singular: "author", plural: "authors"},
    {singular: "category", plural:"categories"}
];

$(document).ready(() => {
    for(let i = 0; i < 2; i++) {
        let singular = inputs[i].singular;
        let plural = inputs[i].plural;
    
        addFocusOnInputClick(singular);
        fillInputOnListClick(singular, plural);
    }
    hideAndShowListsOnClick();
    addCategoriesEvents();
});

function addFocusOnInputClick(singular) {
    $(`#${singular}-input-wrap`).on("click", () => { 
        $(`#quote-${singular}-input`).focus() 
    });

    return true;
}

function fillInputOnListClick(singular, plural) {
    $(`#${plural}-list`)
        .children()
        .on("click", (e) => {
            let divContent = e.currentTarget.innerHTML;
            $(`#quote-${singular}-input`).val(divContent);
            $(`#${plural}-list`).hide();
        });
}

function hideAndShowListsOnClick() {
    $(document).on("click", () => {
        let isClickOnAuthorInput = $("#quote-author-input").is(":focus");
        let isClickOnCategoryInput = $("#quote-category-input").is(":focus");
    
        if(isClickOnAuthorInput) 
            $("#authors-list").show(); else $("#authors-list").hide();

        if(isClickOnCategoryInput) 
            $("#categories-list").show(); else $("#categories-list").hide();
    });
}

function addCategoriesEvents() {
    $("#quote-category-input").keypress((e) => {
        if(canAddCategory(e)) {
            let newCategoryDOM = prepareCategoryDOM();
            addCategory(newCategoryDOM);
            clearCategoryInput();  
            categoriesCount++;
        }
    });
}

function canAddCategory(e) {
    return (e.key == "Enter" && $("#quote-category-input").val() && categoriesCount < 3)
}

function prepareCategoryDOM() {
    let categoryDOM = $(`
    <div class="selected-category">
        <div>${getCategoryFromInput()}</div>
        <img src="../assets/icons/close.svg" class="delete-category">
    </div>
    `);
    deleteCategoryOnClick(categoryDOM);  
    return categoryDOM;
}

function getCategoryFromInput() {
    return $("#quote-category-input").val();
}

function deleteCategoryOnClick(category) {
    $(category)
    .on('click', () => {
        $(category).remove();
        categoriesCount--;
    });
}

function addCategory(categoryDOM) {
    $("#selected-categories").append(categoryDOM);
}

function clearCategoryInput() {
    $("#quote-category-input").val("");
}
