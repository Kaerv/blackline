let categoriesCount = 0;
let inputs = [
    {singular: "author", plural: "authors"},
    {singular: "category", plural:"categories"}
];

let selectedCategoriesNames = [];

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
}

function fillInputOnListClick(singular, plural) {
    $(`#${plural}-list`)
        .children()
        .on("click", (e) => {
            let divContent = e.currentTarget.innerHTML;
            $(`#quote-${singular}-input`).val(divContent);
            $(`#${plural}-list`).hide();
            if(plural == "categories") {
                addCategory();
            }
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
            addCategory();
        }
    });
    document.getElementById("quote-category-input").addEventListener("keydown", (e) => {
        if(e.keyCode == 8) {

            if($("#quote-category-input").val() == "" && selectedCategoriesNames.length > 0) {
                lastCategoryIndex = selectedCategoriesNames.length - 1;
                lastCategoryName = selectedCategoriesNames[lastCategoryIndex];
                let categoryDOM = $("#selected-categories").find(`#category-${lastCategoryName}`)[0];
                
                removeCategoryFromArray($(categoryDOM).parent());
                $(categoryDOM).parent().remove();
                categoriesCount--;
            }
        }
    });
}

function canAddCategory(e) {
    return (e.key == "Enter" && $("#quote-category-input").val() && categoriesCount < 3)
}

function addCategory() {
    if(!selectedCategoriesNames.includes(getCategoryFromInput())) {
        let newCategoryDOM = prepareCategoryDOM();
        appendCategoryToList(newCategoryDOM);
        selectedCategoriesNames.push(getCategoryFromInput());
        clearCategoryInput();  
        categoriesCount++;
    }
    else {
        clearCategoryInput();
    }
}

function prepareCategoryDOM() {
    let categoryDOM = $(`
    <div class="selected-category">
        <div id="category-${getCategoryFromInput()}" class="category-name">${getCategoryFromInput()}</div>
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
        removeCategoryFromArray(category);
    });
}

function removeCategoryFromArray(category) {
    let deletedCategoryName = $(category).find(".category-name")[0].innerText;
    let deletedCategoryIndex = selectedCategoriesNames.indexOf(deletedCategoryName);
    selectedCategoriesNames.splice(deletedCategoryIndex, 1);
}

function appendCategoryToList(categoryDOM) {
    $("#selected-categories").append(categoryDOM);
}

function clearCategoryInput() {
    $("#quote-category-input").val("");
}
