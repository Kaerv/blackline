class Quote extends Controller{
    constructor() {
        super();

        this.countPerLoad = 25;
        this.loadedCount = 0;
        this.totalCount = 0;
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

        $("#add-button").on("click", () => { this.send(); });
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

    getRows(async) {
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
                        start: this.loadedCount,
                        step: this.countPerLoad,
                    }
                },
                success: (response) => {
                    if(response[0] == 0) {
                        this.generateQuotesDOM(response[1]);
                        this.loadedCount += this.countPerLoad;
                        this.addLoadMoreButton();
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

    generateQuotesDOM(quotes) {
        quotes.forEach((quote) => {
            let categories = "";
            quote.categories.forEach((category) => {
                categories += category + ";";
            });
            categories = categories.substring(0, categories.length - 1);
            let quoteDOM = $(`<tr>
                <td class="quote-${quote.id}">
                    <div class="checkbox-container">
                        <input type="checkbox" class="check-quote">
                        <img src="../assets/icons/checked.svg" alt="">
                    </div>
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

            let remove = this.remove;
            let edit = this.edit;
            $(quoteDOM).find(".remove").on("click", function() {
                let selfId = $(this).parent().attr("class").split("-")[1]
                remove(selfId);
            });

            $(quoteDOM).find(".edit-button").on("click", function() {
                let selfId = $(this).parent().attr("class").split("-")[1]
                edit(selfId);
            });

            $("#all-resources tbody").append($(quoteDOM));
        })
    }

    addLoadMoreButton() {
        console.log(this.loadedCount, this.totalCount);
        if(this.loadedCount < this.totalCount + 1) {
            $("#all-resources").find("tbody").append(`
            <tr>
                <td colspan=100><input type="button" id="load-more-button" value="Wczytaj więcej"></td>`
            );
    
            $("#load-more-button").on("click", function() {
                $("#load-more-button").parent().html("<div id='loadMoreMessage'>Wczytywanie...</div>");
                this.getRows();
            });
        }
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
                        this.totalCount = response[1];
                        logger.log("Pobrano liczbę cytatów!");
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
        this.addCategoryToList(false);
        let content = $("#add-quote-content").val();
        let translation = $("#add-quote-translation").val();
        let author = $("#add-quote-author").val();
        let categories = [];
        $(".selected-category").each(function() {
            categories.push($(this).html());
        });

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
                    this.clearForm();
                    this.getAllCount();
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

    clearForm() {
        $("#add-quote-content").val("");
        $("#add-quote-translation").val("");
        $("#add-quote-author").val("");
        $("#add-quote-category").val("");
        $(".selected-category").remove();
    }

    edit() {

    }

    remove(id) {
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
                    this.getAllCount();
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

    }

    getSearchResultCount() {

    }

}