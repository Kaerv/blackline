class Article extends Controller {
    constructor() {
        super();
        this.countPerLoad = 25;
        this.loadedCount = 0;
        this.totalCount = 0;
        this.panel = new ArticlesPanelController();
    }

    getRows() {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: `../php/admin/dispatcher.php`,
                dataType: "JSON",
                data: {
                    token: token,
                    type: "article",
                    action: "getRows",
                    args: {
                        start: controller.loadedCount,
                        step:  controller.countPerLoad,
                    }
                },
                success: (response) => {
                    console.log(response);
                    if(response[0] == 0) {
                        controller.panel.generateArticlesDOM(response[1]);
                        controller.loadedCount += controller.countPerLoad;
                        controller.panel.addLoadMoreButton();
                        logger.log("Pobrano artykuły!");
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
                    type: "article",
                    action: "getAllCount",
                    args: {
                    }
                },
                success: (response) => {
                    if(response[0] == 0) {
                        controller.totalCount = parseInt(response[1]);
                        resolve();
                    }
                    else 
                        logger.error(response[1]);
                },
                async: true
            }).fail(() => {
                logger.error("Wystąpił nieznany błąd w trakcie pobierania liczby artykułów.");
            });
        });
    }

    getContentById(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: `../php/admin/dispatcher.php`,
                dataType: "JSON",
                data: {
                    token: token,
                    type: "article",
                    action: "getContentById",
                    args: {
                        id: id
                    }
                },
                success: (response) => {
                    if(response[0] == 0) {
                        logger.log("Pobrano artykuł!");
                        resolve(response[1]);
                    }
                    else 
                        logger.error(response[1]);
                },
                async: true
            }).fail(() => {
                logger.error("Wystąpił nieznany błąd w trakcie pobierania liczby artykułów.");
            });
        });
    }

    send() {
        let title = $("#add-quote-title").val();
        let content = $("#add-quote-content").val();
        let author = $("#add-quote-author").val();
        let publication = $("#add-quote-publication").val();

        logger.log("Dodawanie nowego artykułu...");
        $.ajax({
            method: "POST",
            url: `../php/admin/dispatcher.php`,
            dataType: "JSON",
            data: {
                token: token,
                type: "article",
                action: "send",
                args: {
                    title: title,
                    content: content,
                    author: author,
                    publication: publication
                }
            },
            success: (response) => {
                console.log(response);
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
        let content = $("#edit-quote-content").val();
        let author = $("#edit-quote-author").val();
        let title = $("#edit-quote-title").val();
        let publication = $("#edit-quote-publication").val();

        logger.log("Zapisywanie...");

        $.ajax({
            method: "POST",
            url: `../php/admin/dispatcher.php`,
            dataType: "JSON",
            data: {
                token: token,
                type: "article",
                action: "edit",
                args: {
                    id: id,
                    content: content,
                    author: author,
                    title: title,
                    publication: publication
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
        logger.log("Usuwanie artykułu...");
        $.ajax({
            method: "POST",
            url: `../php/admin/dispatcher.php`,
            dataType: "JSON",
            data: {
                token: token,
                type: "article",
                action: "remove",
                args: {
                    id: id
                }
            },
            success: (response) => {
                if(response[0] == 0) {
                    $(`.resource-${id}`).parent().remove();
                    getAllCount();
                    logger.log(response[1]);
                }
                else 
                    logger.error(response[1]);
            },
            async: true
        }).fail(() => {
            logger.error("Wystąpił nieznany błąd w trakcie usuwania artykułu");
        });
    }

    search() {
        let phrase = $("#search-input").val();
        $.ajax({
            method: "POST",
            url: `../php/admin/dispatcher.php`,
            dataType: "JSON",
            data: {
                token: token,
                type: "article",
                action: "search",
                args: {
                    phrase: phrase
                }
            },
            success: (response) => {
                if(response[0] == 0) {
                    this.panel.clearForm();
                    this.panel.clearTable();
                    this.panel.generateArticlesDOM(response[1]);
                    controller.loadedCount += controller.countPerLoad;
                    $("#cancel-search").show();
                }
                else 
                    logger.error(response[1]);
            },
            async: true
        }).fail(() => {
            logger.error("Wystąpił nieznany błąd w trakcie wyszukiwania artykułów");
        });
    }
}

class ArticlesPanelController extends PanelController {
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

        $("#site-title").text("Zarządzanie artykułami");
        $("#all-title > span").text("Wszystkie artykuły");
        $("#new-title > span").text("Nowy artykuł");
    }

    generateAddingPanel() {
        $("#add-panel").append(
        `
        <div id="add-panel-wrap">
            <div class="adding-label">Tytuł</div>
            <div>
                <div class="add-input">
                    <input type="text" id="add-quote-title">
                </div>
            </div>
            <div class="adding-label">Treść</div>
            <textarea class="add-textarea" id="add-quote-content" cols="30" rows="5"></textarea>
            <div class="adding-label">Autor</div>
            <div>
                <div class="add-input">
                    <input type="text" id="add-quote-author">
                </div>
            </div>
            <div class="adding-label">Data publikacji</div>
            <div>
                <div class="add-input">
                    <input type="text" id="add-quote-publication">
                </div>
            </div>
            <div>
                <input type="button" value="DODAJ" id="add-button">
            </div>
        </div>
        `);

        $("#add-button").on("click", () => { controller.send(); });
    }

    generateArticlesDOM(articles) {
        articles.forEach((article) => {
            let articleDOM = $(`
                <tr>
                    <td class="resource-${article.id}">
                        <img src="../assets/icons/edit.svg" alt="" class="edit-button">
                        <img src="../assets/icons/close.svg" alt="" class="remove">
                    </td>
                    <td>${article.title}</td>
                    <td>${article.author}</td>
                    <td>${article.dateAdded}</td>
                    <td>${article.datePublication}</td>
                    <td>${article.visitDaily}</td>
                    <td>${article.visitMonthly}</td>
                    <td>${article.visitYearly}</td>
                </tr>
            `);

            $(articleDOM).find(".remove").on("click", function() {
                let selfId = $(this).parent().attr("class").split("-")[1]
                controller.remove(selfId);
            });

            $(articleDOM).find(".edit-button").on("click", function() {
                let selfId = $(this).parent().attr("class").split("-")[1]
                controller.panel.showEditPanel(selfId);
            });

            $("#all-resources > tbody").append($(articleDOM));
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
            <th rowspan="2"><div class="border">Tytuł</div></th>
            <th rowspan="2"><div class="border">Autor</div></th>
            <th rowspan="2"><div class="border">Data dodania</div></th>
            <th rowspan="2"><div class="border" style="border-right: solid 1px rgba(0,0,0,0.5)">Data publikacji</div></th>
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
        logger.log("Wczytywanie artykułów...");
        controller.getAllCount().then(controller.getRows)
    }

    
    showEditPanel(id) {
        $("#edit-quote-panel").html(`
        <div id="edit-quote-header">Edycja artykułu</div>
        <img src="/assets/icons/close.svg" id="cancel-edit">
        <div id="edit-panel-wrap">
            <div class="editing-quote-label">Tytuł</div>
            <div>
                <div class="edit-quote-input edit-input">
                    <input type="text" id="edit-quote-title">
                </div>
            </div>
            <div class="editing-quote-label">Treść</div>
            <textarea id="edit-quote-content" class="edit-textarea" cols="30" rows="5"></textarea>
            <div class="editing-quote-label">Autor</div>
            <div>
                <div class="edit-quote-input edit-input">
                    <input type="text" id="edit-quote-author">
                </div>
            </div>
            <div class="editing-quote-label">Data publikacji</div>
            <div>
                <div class="edit-quote-input edit-input">
                    <input type="text" id="edit-quote-publication">
                </div>
            </div>
            <div>
                <input type="button" value="ZAPISZ" id="edit-button">
            </div>
        </div>
        `);
        let row = $(`.resource-${id}`).parent();
        logger.log("Wczytywanie danych artykułu...");
        controller.getContentById(id).then(content => {
            console.log(content);
            let title = $(row).children()[1];
            let author = $(row).children()[2];
            let publication = $(row).children()[4];
    
            $("#edit-quote-content").val(content);
            $("#edit-quote-author").val($(author).text());
            $("#edit-quote-title").val($(title).text());
            $("#edit-quote-publication").val($(publication).text());
    
            $("#edit-quote-background").show();
            $("#edit-quote-panel").fadeIn(400);
            $("#cancel-edit").on("click", controller.cancelEditing);
            $("#edit-quote-background").on("click", controller.cancelEditing);
            $("#edit-button").on("click", () => {controller.edit(id)});
        });
    }
}