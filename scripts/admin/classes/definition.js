class Definition extends Controller {
    constructor() {
        super();
        this.type = "definition";
        this.panel = new DefinitionsPanelController();
        document.title = "Zarządzanie definicjami";
    }

    prepareDataToSend(editing, id = null) {
        let title, content, author;
        if(!editing) {
            title = $("#add-quote-title").val();
            content = $("#add-quote-content").val();
            author = $("#add-quote-author").val();  
        }
        else {
            content = $("#edit-quote-content").val();
            author = $("#edit-quote-author").val();
            title = $("#edit-quote-title").val();
        }

        return {
            id: id,
            title: title,
            content: content,
            author: author
        }
    }
}

class DefinitionsPanelController extends PanelController {
    constructor() {
        super();

        $("#site-title").text("Zarządzanie definicjami");
        $("#all-title > span").text("Wszystkie definicje");
        $("#new-title > span").text("Nowa definicja");
    }

    generateAddingPanel() {
        $("#add-panel").append(
        `
        <div id="add-panel-wrap">
            <div class="adding-label">Definiowane wyrażenie</div>
            <div>
                <div class="add-input">
                    <input type="text" id="add-quote-title">
                </div>
            </div>
            <div class="adding-label">Treść definicji</div>
            <textarea class="add-textarea" id="add-quote-content" cols="30" rows="5"></textarea>
            <div class="adding-label">Autor</div>
            <div>
                <div class="add-input">
                    <input type="text" id="add-quote-author">
                </div>
            </div>
            <div>
                <input type="button" value="DODAJ" id="add-button">
            </div>
        </div>
        `);

        $("#add-button").on("click", () => { controller.send(); });
    }

    generateDOM(definitions) {
        definitions.forEach((definition) => {
            let definitionDOM = $(`
                <tr>
                    <td class="resource-${definition.id}">
                        <img src="../assets/icons/edit.svg" alt="" class="edit-button">
                        <img src="../assets/icons/close.svg" alt="" class="remove">
                    </td>
                    <td>${definition.title}</td>
                    <td>${definition.author}</td>
                    <td>${definition.dateAdded}</td>
                    <td>${definition.visitDaily}</td>
                    <td>${definition.visitMonthly}</td>
                    <td>${definition.visitYearly}</td>
                </tr>
            `);

            $(definitionDOM).find(".remove").on("click", function() {
                let selfId = $(this).parent().attr("class").split("-")[1]
                controller.remove(selfId);
            });

            $(definitionDOM).find(".edit-button").on("click", function() {
                let selfId = $(this).parent().attr("class").split("-")[1]
                controller.panel.showEditPanel(selfId);
            });

            $("#all-resources > tbody").append($(definitionDOM));
        })
    }

    clearForm() {
        $("#add-quote-content").val("");
        $("#add-quote-author").val("");
        $("#add-quote-title").val("");
    }

    clearTable() {
        $("#all-resources > tbody").html(`
        <tr>
            <th rowspan="2"></th>
            <th rowspan="2"><div class="border">Tytuł</div></th>
            <th rowspan="2"><div class="border">Autor</div></th>
            <th rowspan="2"><div class="border">Data dodania</div></th>
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
        <div id="edit-quote-header">Edycja definicji</div>
        <img src="/assets/icons/close.svg" id="cancel-edit">
        <div id="edit-panel-wrap">
            <div class="editing-quote-label">Definiowane wyrażenie</div>
            <div>
                <div class="edit-quote-input edit-input">
                    <input type="text" id="edit-quote-title">
                </div>
            </div>
            <div class="editing-quote-label">Treść definicji</div>
            <textarea id="edit-quote-content" class="edit-textarea" cols="30" rows="5"></textarea>
            <div class="editing-quote-label">Autor</div>
            <div>
                <div class="edit-quote-input edit-input">
                    <input type="text" id="edit-quote-author">
                </div>
            </div>
            <div>
                <input type="button" value="ZAPISZ" id="edit-button">
            </div>
        </div>
        `);
        let row = $(`.resource-${id}`).parent();
        logger.log("Wczytywanie danych definicji...");
        controller.getContentById(id).then(content => {
            console.log(content);
            let title = $(row).children()[1];
            let author = $(row).children()[2];
    
            $("#edit-quote-content").val(content);
            $("#edit-quote-author").val($(author).text());
            $("#edit-quote-title").val($(title).text());
    
            $("#edit-quote-background").show();
            $("#edit-quote-panel").fadeIn(400);
            $("#cancel-edit").on("click", controller.cancelEditing);
            $("#edit-quote-background").on("click", controller.cancelEditing);
            $("#edit-button").on("click", () => {controller.edit(id)});
        });
    }
}