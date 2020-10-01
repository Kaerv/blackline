class QuotesController {
    constructor() {
        this.loadedCount = 25;
        this.totalCount;
        this.countByStep = 25;
        this.tryCount = 0;

        this.getCount();
    }

    getCount() {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: "/php/quotes.php",
                dataType: "JSON",
                data: {
                    q: "count"
                },
            }).done((response) => {
                if(response[0] == 0) {
                    controller.tryCount = 0;
                    controller.totalCount = response[1];
                    resolve();
                }
                else {
                    if(controller.tryCount < 3) {
                        controller.tryCount++;
                        console.log(`Getting count failed, try ${controller.tryCount} from 3`)
                        controller.getCount();
                    }
                    else {
                        controller.tryCount = 0;
                    }
                }
            }).fail(() => {
                if(controller.tryCount < 3) {
                    controller.tryCount++;
                    console.log(`Getting count failed, try ${controller.tryCount} from 3`)
                    controller.getCount();
                }
                else {
                    controller.tryCount = 0;
                }
            });
        });
    }

    getQuotes() {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: "/php/quotes.php",
                dataType: "JSON",
                data: {
                    q: "quotes",
                    args: {
                        start: controller.loadedCount,
                        step: controller.countByStep,
                        order: order
                    }
                },
            }).done((response) => {
                console.log(response[1]);
                if(response[0] == 0) {
                    controller.tryCount = 0;
                    quotesUI.generateQuotes(response[1]);
                    resolve();
                }
                else {
                    if(controller.tryCount < 3) {
                        controller.tryCount++;
                        console.log(`Getting quotes failed, try ${controller.tryCount} from 3`)
                        controller.getQuotes();
                    }
                    else {
                        controller.tryCount = 0;
                    }
                }
            }).fail(() => {
                if(controller.tryCount < 3) {
                    controller.tryCount++;
                    console.log(`Getting quotes failed, try ${controller.tryCount} from 3`)
                    controller.getQuotes();
                }
                else {
                    controller.tryCount = 0;
                }
            });
        });
    }
}