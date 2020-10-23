import {chooseQuoteEvents} from "./choose-quote";
import "./creator-select-input";
import { selectInputEvents } from "./creator-select-input";

class Creator {
    constructor() {
        this.canvas;
        this.ctx;
        this.size;
        this.sides;
        this.currentImage;
        this.start = Date.now();
        console.log("Initializing creator...");
        this.init();
        console.log("Creator initialized");
        console.log(`${Date.now() - this.start}ms`);
    }

    init() {
        this.initEventListeners();
        this.initImages();
    }

    initEventListeners() {
        chooseQuoteEvents();
        selectInputEvents();
        $("#product-sides > div").on("click", function() {
            let newSide = $(this).data().side;
            creator.changeImage(creator.sides[newSide]);
            $("#product-sides .current").removeClass("current");
            $(this).addClass("current");
        });

        $(".color-container").click(function() {
            $(".color-container").removeClass('selected');
            $(this).addClass("selected");
        });
    }

    initImages() {
        let front = new Image();
        let back = new Image();

        let size;
        front.onload = function() {
            creator.size = {
                width: this.width,
                height: this.height
            }
            creator.initCanvas(size);
        }
        front.src = images.front;
        back.src = images.back;
        this.sides = {
            front: front,
            back: back
        }
        this.currentImage = this.sides.front;
    }

    initCanvas(size) {
        let container = $("#product-view");
        $(container).append(`<canvas id='product-live-view' width='${this.size.width * 1.5}' height='${this.size.height * 1.5}'></canvas>`);
        this.canvas = $("#product-live-view")[0];
        this.ctx = this.canvas.getContext("2d");
        this.reloadCanvas();
    }

    changeImage(image) {
        this.currentImage = image;
        this.reloadCanvas();
    }

    reloadCanvas() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.ctx.drawImage(this.currentImage, 10, 10, this.size.width * 1.5, this.size.height * 1.5);
    }
}

let creator = new Creator();