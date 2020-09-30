class Quote extends Controller {
    constructor() {
        super();
        this.type = "quote";
        this.panel = new QuotesPanelController();
        document.title = "Zarządzanie cytatami";
    }

    prepareDataToSend(editing, id) {
        let content,translation, author, categories;
        if(!editing) {
            this.panel.addCategoryToList(false);
            content = $("#add-quote-content").val();
            translation = $("#add-quote-translation").val();
            author = $("#add-quote-author").val();
            categories = [];
            $(".selected-category").each(function() {
                categories.push($(this).html());
            });
        }

        else {
            this.panel.addCategoryToList(false);
            content = $("#edit-quote-content").val();
            translation = $("#edit-quote-translation").val();
            author = $("#edit-quote-author").val();
            categories = [];
            $(".selected-edited-category").each(function() {
                categories.push($(this).html());
            });
        }

        return {
            id: id,
            content: content,
            translation: translation,
            author: author,
            categories: categories
        }
    }
}

class QuotesPanelController extends PanelController {
    constructor() {
        super();

        $("#site-title").text("Zarządzanie cytatami");
        $("#all-title > span").text("Wszystkie cytaty");
        $("#new-title > span").text("Nowy cytat");
    }

    generateAddingPanel() {
        $("#add-panel").append(
        `
        <div id='add-panel-wrap'>
            <div class='adding-label'>Treść</div>
            <textarea class="add-textarea" id='add-quote-content' cols='30' rows='5'></textarea>
            <div class='adding-label'>Tłumaczenie (opcjonalnie)</div>
            <textarea class='add-textarea' id='add-quote-translation' cols='30' rows='5'></textarea>
            <div class='adding-label'>Autor</div>
            <div>
                <div class="add-input">
                    <input type="text" id="add-quote-author">
                </div>
            </div>
            <div class="adding-label">Kategorie</div>
            <div>
                <div class="add-input">
                    <div id="add-quote-selected-categories"></div>
                    <input type="text" id="add-quote-category">
                </div>
            </div>
            <div>
                <input type="button" value="DODAJ" id="add-button">
            </div>
        </div>
        `);

        $("#add-button").on("click", () => { controller.send(); });
        $("#add-quote-category").on("keydown", (event) => { if(event.keyCode == 13) this.addCategoryToList(false) });
    }

    addCategoryToList(existingQuote) {
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

        let selectedNames = existingQuote? formNames[1] : formNames[0];
    
        let category = $(selectedNames.categoryInput).val().toUpperCase();
    
        if(this.canAddCategory(category, selectedNames)) {
            $(selectedNames.categoryInput).val("");
            let newCategoryDom = $(`${selectedNames.newCategoryDOM}${category}</div>`);
            $(selectedNames.categoriesContainer).append($(newCategoryDom));
            this.addRemoveEvent(newCategoryDom);
        }
    }

    canAddCategory(newCategory, selectedNames) {
        let quoteDoesNotExist = true;
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

    addRemoveEvent(obj) {
        $(obj).on("click", () => {
            $(obj).remove();
        });
    }

    generateDOM(quotes) {
        quotes.forEach((quote) => {
            let categories = "";
            quote.categories.forEach((category) => {
                categories += category + ";";
            });
            categories = categories.substring(0, categories.length - 1);
            let quoteDOM = $(`<tr>
                <td class="resource-${quote.id}">
                    <img src="../assets/icons/edit.svg" alt="" class="edit-button">
                    <img src="../assets/icons/close.svg" alt="" class="remove">
                </td>
                <td>${quote.content}</td>
                <td>${quote.translation}</td>
                <td>${quote.author}</td>
                <td>${categories}</td>
                <td>${quote.dateAdded}</td>
                <td>${quote.likes}</td>
            </tr>
            `);

            $(quoteDOM).find(".remove").on("click", function() {
                let selfId = $(this).parent().attr("class").split("-")[1]
                controller.remove(selfId);
            });

            $(quoteDOM).find(".edit-button").on("click", function() {
                let selfId = $(this).parent().attr("class").split("-")[1]
                controller.panel.showEditPanel(selfId);
            });

            $("#all-resources > tbody").append($(quoteDOM));
        })
    }


    clearForm() {
        $("#add-quote-content").val("");
        $("#add-quote-translation").val("");
        $("#add-quote-author").val("");
        $("#add-quote-category").val("");
        $(".selected-category").remove();
    }

    clearTable() {
        $("#all-resources > tbody").html(`
        <tr>
            <th></th>
            <th><div class="border">Treść</div></th>
            <th><div class="border">Tłumaczenie</div></th>
            <th><div class="border">Autor</div></th>
            <th><div class="border">Kategoria</div></th>
            <th><div class="border" style="border-right: solid 1px rgba(0,0,0,0.5)">Data dodania</div></th>
            <th>Polubienia</th>
        </tr>

        `);
    }

    showEditPanel(id) {
        $("#edit-quote-panel").html(`
        <div id="edit-quote-header">Edycja cytatu</div>
        <img src="/assets/icons/close.svg" id="cancel-edit">
        <div id="edit-panel-wrap">
            <div class="editing-quote-label">Treść</div>
            <textarea id="edit-quote-content" class="edit-textarea" cols="30" rows="5"></textarea>
            <div class="adding-quote-label">Tłumaczenie (opcjonalnie)</div>
            <textarea id="edit-quote-translation" class="edit-textarea" cols="30" rows="5"></textarea>
            <div class="editing-quote-label">Autor</div>
            <div>
                <div class="edit-quote-input edit-input">
                    <input type="text" id="edit-quote-author">
                </div>
            </div>
            <div class="editing-quote-label">Kategorie</div>
            <div>
                <div class="edit-quote-input edit-input">
                    <div id="edit-quote-selected-categories"></div>
                    <input type="text" id="edit-quote-category">
                </div>
            </div>
            <div>
                <input type="button" value="ZAPISZ" id="edit-button">
            </div>
        </div>
        `);
        let row = $(`.resource-${id}`).parent();
        let content = $(row).children()[1];
        let translation = $(row).children()[2];
        let author = $(row).children()[3];
        let categories = $(row).children()[4];

        $("#edit-quote-content").val($(content).text());
        $("#edit-quote-translation").val($(translation).text());
        $("#edit-quote-author").val($(author).text());
        $(categories)
        .text()
        .split(";")
        .forEach((category) => {
                $("#edit-quote-selected-categories").append(`<div class="selected-edited-category">${category}</div>`);
        })
        $("#edit-quote-background").show();
        $("#edit-quote-panel").fadeIn(400);
        $("#cancel-edit").on("click", controller.cancelEditing);
        $("#edit-quote-background").on("click", controller.cancelEditing);
        $("#edit-button").on("click", () => {controller.edit(id)})
    }
}