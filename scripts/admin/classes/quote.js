class Quote extends Controller {
    constructor() {
        super();
        this.countPerLoad = 25;
        this.loadedCount = 0;
        this.totalCount = 0;
        this.panel = new QuotesPanelController();
    }

    getRows() {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: `../php/admin/dispatcher.php`,
                dataType: "JSON",
                data: {
                    token: token,
                    type: "quote",
                    action: "getRows",
                    args: {
                        start: controller.loadedCount,
                        step:  controller.countPerLoad,
                    }
                },
                success: (response) => {
                    if(response[0] == 0) {
                        controller.panel.generateQuotesDOM(response[1]);
                        controller.loadedCount += controller.countPerLoad;
                        controller.panel.addLoadMoreButton();
                        logger.log("Pobrano cytaty!");
                        resolve();
                    }
                    else 
                        logger.error(response[1]);
                },
                async: true
            }).fail(() => {
                logger.error("Wystąpił nieznany błąd w trakcie pobierania danych");
            });
        }) 
    }

    getAllCount() {  
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: `../php/admin/dispatcher.php`,
                dataType: "JSON",
                data: {
                    token: token,
                    type: "quote",
                    action: "getAllCount",
                    args: {
                    }
                },
                success: (response) => {
                    if(response[0] == 0) {
                        this.totalCount = parseInt(response[1]);
                        resolve();
                    }
                    else 
                        logger.error(response[1]);
                },
                async: true
            }).fail(() => {
                logger.error("Wystąpił nieznany błąd w trakcie pobierania liczby cytatów.");
            });
        });
    }

    send() {
        this.panel.addCategoryToList(false);
        let content = $("#add-quote-content").val();
        let translation = $("#add-quote-translation").val();
        let author = $("#add-quote-author").val();
        let categories = [];
        $(".selected-category").each(function() {
            categories.push($(this).html());
        });

        logger.log("Dodawanie nowego cytatu...");
        $.ajax({
            method: "POST",
            url: `../php/admin/dispatcher.php`,
            dataType: "JSON",
            data: {
                token: token,
                type: "quote",
                action: "send",
                args: {
                    content: content,
                    translation: translation,
                    author: author,
                    categories: categories
                }
            },
            success: (response) => {
                if(response[0] == 0) {
                    this.panel.resetPanel();
                    logger.log(response[1]);
                }
                else 
                    logger.error(response[1]);
            },
            async: true
        }).fail(() => {
            logger.error("Wystąpił nieznany błąd w trakcie wysyłania danych");
        });
    }

    cancelEditing() {
        $("#edit-quote-background").fadeOut(200);
        $("#edit-quote-panel").hide();
        controller.panel.clearForm();
    }

    edit(id) {
        this.panel.addCategoryToList(false);
        let content = $("#edit-quote-content").val();
        let translation = $("#edit-quote-translation").val();
        let author = $("#edit-quote-author").val();
        let categories = [];
        $(".selected-edited-category").each(function() {
            categories.push($(this).html());
        });

        logger.log("Zapisywanie zmian...");

        $.ajax({
            method: "POST",
            url: `../php/admin/dispatcher.php`,
            dataType: "JSON",
            data: {
                token: token,
                type: "quote",
                action: "edit",
                args: {
                    id: id,
                    content: content,
                    translation: translation,
                    author: author,
                    categories: categories
                }
            },
            success: (response) => {
                if(response[0] == 0) {
                    this.cancelEditing();
                    this.panel.resetPanel();
                    logger.log(response[1]);
                }
                else 
                    logger.error(response[1]);
            },
            async: true
        }).fail(() => {
            logger.error("Wystąpił nieznany błąd w trakcie wysyłania danych");
        });
    }

    remove(id) {
        let getAllCount = this.getAllCount;

        logger.log("Usuwanie cytatu...");
        $.ajax({
            method: "POST",
            url: `../php/admin/dispatcher.php`,
            dataType: "JSON",
            data: {
                token: token,
                type: "quote",
                action: "remove",
                args: {
                    id: id
                }
            },
            success: (response) => {
                if(response[0] == 0) {
                    $(`.quote-${id}`).parent().remove();
                    getAllCount();
                    logger.log(response[1]);
                }
                else 
                    logger.error(response[1]);
            },
            async: true
        }).fail(() => {
            logger.error("Wystąpił nieznany błąd w trakcie usuwania cytatu");
        });
    }

    search() {
        let phrase = $("#search-input").val();

        logger.log("Wyszukiwanie cytatów...");
        $.ajax({
            method: "POST",
            url: `../php/admin/dispatcher.php`,
            dataType: "JSON",
            data: {
                token: token,
                type: "quote",
                action: "search",
                args: {
                    phrase: phrase
                }
            },
            success: (response) => {
                if(response[0] == 0) {
                    this.panel.clearForm();
                    this.panel.clearTable();
                    this.panel.generateQuotesDOM(response[1]);
                    controller.loadedCount += controller.countPerLoad;
                    $("#cancel-search").show();
                }
                else 
                    logger.error(response[1]);
            },
            async: true
        }).fail(() => {
            logger.error("Wystąpił nieznany błąd w trakcie wyszukiwania cytatów");
        });
    }
}

class QuotesPanelController extends PanelController {
    constructor() {
        super();
        
        this.generateAddingPanel();
        this.clearTable();

        $("#search-input").on("keydown", function(event) {
            if(event.keyCode == 13) {
                controller.search();
            }
        });

        $("#cancel-search").click(() => {
            this.resetPanel();
            $("#search-input").val("");
            $("#cancel-search").hide();
        });

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

    generateQuotesDOM(quotes) {
        quotes.forEach((quote) => {
            let categories = "";
            quote.categories.forEach((category) => {
                categories += category + ";";
            });
            categories = categories.substring(0, categories.length - 1);
            let quoteDOM = $(`<tr>
                <td class="quote-${quote.id}">
                    <img src="../assets/icons/edit.svg" alt="" class="edit-button">
                    <img src="../assets/icons/close.svg" alt="" class="remove">
                </td>
                <td>${quote.content}</td>
                <td>${quote.translation}</td>
                <td>${quote.author}</td>
                <td>${categories}</td>
                <td>${quote.dateAdded}</td>
                <td>${quote.visitDaily}</td>
                <td>${quote.visitMonthly}</td>
                <td>${quote.visitYearly}</td>
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

    addLoadMoreButton() {
        let getRows = controller.getRows;
        if(controller.loadedCount < controller.totalCount + 1) {
            $("#all-resources").find("tbody").append(`
            <tr>
                <td colspan=100><input type="button" id="load-more-button" value="Wczytaj więcej"></td>
            </tr>`
            );
    
            $("#load-more-button").on("click", function() {
                $("#load-more-button").parent().html("<div id='loadMoreMessage'>Wczytywanie...</div>");
                getRows().then(() => {
                    $("#loadMoreMessage").parent().remove();
                });
            });
        }
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
            <th rowspan="2"></th>
            <th rowspan="2"><div class="border">Treść</div></th>
            <th rowspan="2"><div class="border">Tłumaczenie</div></th>
            <th rowspan="2"><div class="border">Autor</div></th>
            <th rowspan="2"><div class="border">Kategoria</div></th>
            <th rowspan="2"><div class="border" style="border-right: solid 1px rgba(0,0,0,0.5)">Data dodania</div></th>
            <th colspan="3">Wizyty</th>
        </tr>
        <tr>
            <th>Dziennie</th>
            <th>Miesięcznie</th>
            <th>Rocznie</th>
        </tr>
        `);
    }

    resetPanel() {
        controller.panel.clearForm();
        controller.panel.clearTable();
        controller.loadedCount = 0;
        logger.log("Wczytywanie cytatów...");
        controller.getAllCount().then(controller.getRows)
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
        let row = $(`.quote-${id}`).parent();
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