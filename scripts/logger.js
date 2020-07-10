class Logger {
    constructor() {
        this.container = $("#logs-container");
    }

    log(content) {
        let newLog = $(`<div class="log-message" style="display: none;"><div class="log-content">${content}</div></div>`);
        $(this.container).show();
        $(this.container).append(newLog);
        $(newLog).fadeIn(150);
        this.addEventsToLog(newLog);
    }

    error(content) {
        let newLog = $(`<div class="log-message" style="display: none;"><div class="log-content" style="color:#F55;">${content}</div></div>`);
        $(this.container).show();
        $(this.container).append(newLog);
        $(newLog).fadeIn(150);
        this.addEventsToLog(newLog);
    }

    addEventsToLog(log) {
        $(log).on("click", () => {
            this.removeLog(log);
        });
        $(log).delay(4000).fadeOut(1000, () => {this.removeLog(log) });
        $(this.container).fadeIn(10);
    }

    removeLog(log) {
        $(log).remove();
        if($(this.container).children().length == 1) {
            $(this.container).hide();
        }
    }
}

let logger = new Logger();