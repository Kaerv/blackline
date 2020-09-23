class Article extends Controller {
    constructor() {
        super();
        this.type = "article";
        this.panel = new ArticlesPanelController();
        document.title = "Zarządzanie artykułami";
    }

    prepareDataToSend(editing, id = null) {
        let title, content, author, publication;
        if(!editing) {
            title = $("#add-quote-title").val();
            content = $("#add-quote-content").val();
            author = $("#add-quote-author").val();
            publication = $("#add-quote-publication").val();
        }
        else {
            content = $("#edit-quote-content").val();
            author = $("#edit-quote-author").val();
            title = $("#edit-quote-title").val();
            publication = $("#edit-quote-publication").val();
        }

        return {
            id: id,
            title: title,
            content: content,
            author: author,
            publication: publication
        }
    }
}

class ArticlesPanelController extends PanelController {
    constructor() {
        super();

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
                    <input type="date" id="add-quote-publication">
                </div>
            </div>
            <div>
                <input type="button" value="DODAJ" id="add-button">
            </div>
        </div>
        `);

        $("#add-button").on("click", () => { controller.send(); });
    }

    generateDOM(articles) {
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

    clearForm() {
        $("#add-quote-content").val("");
        $("#add-quote-author").val("");
        $("#add-quote-title").val("");
        $("#add-quote-publication").val("");
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