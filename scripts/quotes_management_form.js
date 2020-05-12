const inputs = [
    {singular: "author", plural: "authors"},
    {singular: "category", plural:"categories"}
];
const listCount = inputs.length;
let form;

$(document).ready(() => {
    form = new QuotesFormManager();
    form.createEventListeners();
    $("#confirm-quote").on("click", sendQuote);
});

function sendQuote() {
    let QuoteData = form.getQuoteData();
    $.ajax({
        method: "POST",
        url: "../helpers/sendQuote.php",
        data: QuoteData,
        success: (msg) => {
            let response = msg.split(";");
            let status = response[0];
            if(status == -1) {
                let error_message = response[1];
                console.log("%c" + error_message, "color: #FF1111");
                showLog(`Wystąpił błąd: ${error_message}`);
            }
            else {
                let message = response[1];
                console.log(message);
                showLog("Pomyślnie dodano cytat! ❤️")
            }
            console.log(`Full response: "${msg}"`);
        }
    });
}
let timeout;
function showLog(message) {
    clearTimeout(timeout);
    $("#log").text(`#${message}`);
    $("#log").show();
    timeout = setTimeout(() => {
        $("#log").fadeOut(1000);
    }, 3000);
    
}


class QuotesFormManager {
    constructor() {
        this.selectedCategoriesNames = [];
        this.categoriesCount = 0;
        this.categoryInput = $("#quote-category-input");
        this.categoriesDOMContainer = $("#selected-categories");
    }

    getQuoteData() {
        return {
            content: $("#quote-content-input").val(),
            author: $("#quote-author-input").val(),
            categories: this.selectedCategoriesNames,
        }
    }

    createEventListeners() {
        this.createEventsForShowingLists();
        this.createEventsForInputClickAndFill();
        this.createEventForEnterOnCategories();
        this.createEventForBackspaceOnCategories();
    }

    createEventsForShowingLists() {
        $(document).on("click", () => {
            for(let i = 0; i < listCount; i++) {
                let singular = inputs[i].singular;
                let plural = inputs[i].plural;
                let isClickOnInput = $(`#quote-${singular}-input`).is(":focus");
                
                if(isClickOnInput) 
                    $(`#${plural}-list`).show(); 
                else 
                    $(`#${plural}-list`).hide();
            }
        });

    }

    createEventsForInputClickAndFill() {
        for(let i = 0; i < listCount; i++) {
            let singular = inputs[i].singular;
            let plural = inputs[i].plural;
        
            $(`#${singular}-input-wrap`).on("click", () => { 
                $(`#quote-${singular}-input`).focus() 
            });

            $(`#${plural}-list`).children().on("click", (e) => {
                this.fillInputOnListClick(e, singular, plural);
            });
        }
    }

    fillInputOnListClick(e, singular, plural) {
        let divContent = e.currentTarget.innerHTML;
        $(`#quote-${singular}-input`).val(divContent);
        $(`#${plural}-list`).hide();
        if(plural == "categories") {
            this.addCategory();
        }
    }

    createEventForEnterOnCategories() {
        $(this.categoryInput).keypress((e) => {
            if(e.key == "Enter") {
                $("#categories-list").hide();
                $("#categories-warning").hide();

                if(this.canAddCategory(e)) {
                    this.addCategory();
                }
                else {
                    this.showSuitableWarning(e);
                }
            }
        });
    }

    canAddCategory(e) {
        return ($(this.categoryInput).val() && this.categoriesCount < 3)
    }

    addCategory() {
        let newCategoryName = this.getCategoryFromInput();

        if(!this.selectedCategoriesNames.includes(newCategoryName)) {
            let newCategoryDOM = this.prepareCategoryDOM();
            this.appendCategoryToList(newCategoryDOM);
            this.selectedCategoriesNames.push(newCategoryName);
            this.categoriesCount++;
            $("#categories-warning").hide();
        }
        else {
            $("#categories-warning").text("*Kategorie nie mogą się powtarzać");
            $("#categories-warning").show();
        }

        this.clearCategoryInput();
    }

    showSuitableWarning(e) {
        if(e.key == "Enter") {
            if($(this.categoryInput).val() == "" ) {
                $("#categories-warning").text("*Kategoria nie może być pustym napisem")
            }
            else if(this.categoriesCount >= 3) {
                $("#categories-warning").text("*Możliwe jest dodanie tylko 3 kategorii");
            }
            $("#categories-warning").show();
        }
    }

    getCategoryFromInput() { return $(this.categoryInput).val().toUpperCase(); }
    appendCategoryToList(categoryDOM) { $(this.categoriesDOMContainer).append(categoryDOM) }
    clearCategoryInput() { $(this.categoryInput).val("") }

    prepareCategoryDOM() {
        let newCategoryName = this.getCategoryFromInput()
        let categoryDOM = $(`
        <div class="selected-category">
            <div id="category-${newCategoryName}" class="category-name">${newCategoryName}</div>
            <img src="../assets/icons/close.svg" class="delete-category">
        </div>
        `);
        this.deleteCategoryOnClick(categoryDOM);  
        return categoryDOM;
    }

    deleteCategoryOnClick(category) {
        $(category)
        .on('click', () => {
            $(category).remove();
            this.categoriesCount--;
            this.removeCategoryFromArray(category);
        });
    }

    createEventForBackspaceOnCategories() {
        document.getElementById("quote-category-input").addEventListener("keydown", (e) => {
            if(e.keyCode == 8) {
                if(this.canDeleteCategory()) {
                    let lastCategoryIndex = this.selectedCategoriesNames.length - 1;
                    let lastCategoryName = this.selectedCategoriesNames[lastCategoryIndex];
                    let categoryDOM = $(this.categoriesDOMContainer).find(`#category-${lastCategoryName}`)[0];
                    
                    this.removeCategoryFromArray($(categoryDOM).parent());
                    $(categoryDOM).parent().remove();
                    this.categoriesCount--;
                }
            }
        });
    }

    canDeleteCategory() {
        return ( $(this.categoryInput).val() == "" && this.selectedCategoriesNames.length > 0 );
    }

    removeCategoryFromArray(category) {
        let deletedCategoryName = $(category).find(".category-name")[0].innerText;
        let deletedCategoryIndex = this.selectedCategoriesNames.indexOf(deletedCategoryName);
        this.selectedCategoriesNames.splice(deletedCategoryIndex, 1);
    }
}
