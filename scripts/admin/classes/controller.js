class Controller {
    constructor() {
        this.countPerLoad = 25;
        this.loadedCount = 0;
        this.totalCount = 0;
        this.type;
    }

    getAllCount() {  
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: `../php/admin/dispatcher.php`,
                dataType: "JSON",
                data: {
                    token: token,
                    type: controller.type,
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
                logger.error("Wystąpił nieznany błąd w trakcie pobierania liczby materiałów.");
            });
        });
    }

    getRows() {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: `../php/admin/dispatcher.php`,
                dataType: "JSON",
                data: {
                    token: token,
                    type: controller.type,
                    action: "getRows",
                    args: {
                        start: controller.loadedCount,
                        step:  controller.countPerLoad,
                    }
                },
                success: (response) => {
                    if(response[0] == 0) {
                        controller.panel.generateDOM(response[1]);
                        controller.loadedCount += controller.countPerLoad;
                        controller.panel.addLoadMoreButton();
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

    send() {
        let args = this.prepareDataToSend(false);

        logger.log("Dodawanie...");
        $.ajax({
            method: "POST",
            url: `../php/admin/dispatcher.php`,
            dataType: "JSON",
            data: {
                token: token,
                type: this.type,
                action: "send",
                args: args
            },
            success: (response) => {
                if(response[0] == 0) {
                    logger.log(response[1]);
                    this.panel.resetPanel();
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
        logger.log("Usuwanie...");
        $.ajax({
            method: "POST",
            url: `../php/admin/dispatcher.php`,
            dataType: "JSON",
            data: {
                token: token,
                type: controller.type,
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
            logger.error("Wystąpił nieznany błąd w trakcie usuwania rekordu");
        });
    }

    edit(id) {
        let args = this.prepareDataToSend(true, id);

        logger.log("Zapisywanie zmian...");

        $.ajax({
            method: "POST",
            url: `../php/admin/dispatcher.php`,
            dataType: "JSON",
            data: {
                token: token,
                type: this.type,
                action: "edit",
                args: args
            },
            success: (response) => {
                if(response[0] == 0) {
                    logger.log(response[1]);
                    this.cancelEditing();
                    this.panel.resetPanel();
                }
                else 
                    logger.error(response[1]);
            },
            async: true
        }).fail(() => {
            logger.error("Wystąpił nieznany błąd w trakcie wysyłania danych");
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
                    type: this.type,
                    action: "getContentById",
                    args: {
                        id: id
                    }
                },
                success: (response) => {
                    if(response[0] == 0) {
                        logger.log("Pobrano dane!");
                        resolve(response[1]);
                    }
                    else 
                        logger.error(response[1]);
                },
                async: true
            }).fail(() => {
                logger.error("Wystąpił nieznany błąd w trakcie pobierania danych.");
            });
        });
    }

    search() {
        let phrase = $("#search-input").val();
        logger.log("Wyszukiwanie...");
        $.ajax({
            method: "POST",
            url: `../php/admin/dispatcher.php`,
            dataType: "JSON",
            data: {
                token: token,
                type: controller.type,
                action: "search",
                args: {
                    phrase: phrase
                }
            },
            success: (response) => {
                if(response[0] == 0) {
                    console.log(response[1]);
                    if(!response[1].length)
                        logger.log("Nie znaleziono pasujących wyników.");

                    this.panel.clearForm();
                    this.panel.clearTable();
                    this.panel.generateDOM(response[1]);
                    controller.loadedCount += controller.countPerLoad;
                    $("#cancel-search").show();
                }
                else 
                    logger.error(response[1]);
            },
            async: true
        }).fail(() => {
            logger.error("Wystąpił nieznany błąd w trakcie wyszukiwania");
        });
    }

    cancelEditing() {
        $("#edit-quote-background").fadeOut(200);
        $("#edit-quote-panel").hide();
        controller.panel.clearForm();
    }
}

class PanelController {
    constructor() {
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

    resetPanel() {
        controller.panel.clearForm();
        controller.panel.clearTable();
        controller.loadedCount = 0;
        logger.log("Odświeżanie panelu...");
        controller.getAllCount().then(controller.getRows)
    }
}