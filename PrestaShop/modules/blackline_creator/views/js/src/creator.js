import { chooseQuoteEvents } from "./choose-quote";
import "./creator-select-input";
import { selectInputEvents } from "./creator-select-input";
import { Canvas } from "./canvas";
import { CanvasText } from "./canvastext";
import { CanvasImage } from "./canvasimage";
 
class Creator {
    constructor() {
        this.start = Date.now();
        this.sides = {};
        this.currentImage;
        this.canvas;
        this.text;

        this.init();
    }

    init() {
        this.canvas = new Canvas();
        this.initImages().then((image) => {
            console.log(`Images loaded: ${Date.now() - this.start}ms`);

            this.canvas.init({width: image.width, height: image.height});
            this.changeImage(creator.sides.front);
            this.initEventListeners();
            this.initText();
            this.canvas.redraw();
            console.log(`Koniec: ${Date.now() - this.start}ms`);
        });
    }

    initImages() {
        return new Promise ((resolve, reject) => {
            this.sides.front = new CanvasImage();
            this.sides.back = new CanvasImage();

            Promise.all([
                this.sides.front.init(images.front),
                this.sides.back.init(images.back)
            ]).then((images) => {
                resolve({
                    width: images[0].width, 
                    height: images[0].height
                });
            });
        });
    }

    initText() {
        this.text = new CanvasText();

        let selectedQuote = $(".selected-quote").text();
        let ownText = $("#own-text-editor textarea").val();

        if(selectedQuote) {
            this.text.setContent(selectedQuote);
        }
        else if(ownText) {
            self = this;
            this.text.setContent(ownText);
            $("#own-text-editor textarea").on("input", function() {
                self.text.setContent($(this).val());
                self.canvas.redraw();
            });
        }

        this.canvas.elements.text = this.text;
    }

    initEventListeners() {
        let self = this;
        chooseQuoteEvents();
        selectInputEvents();
        $("#product-sides > div").on("click", function() {
            self.changeSide(this);
        });

        $(".color-container").click(function() {
            $(".color-container").removeClass('selected');
            $(this).addClass("selected");
        });

        $(window).on("resize", function() {
            self.canvas.resize();
        });

        $("#font-select").on("change", function(ev) {
            self.text.setFontFamily($("#font-select").val());
            self.canvas.redraw();
        })
    }

    changeSide(button) {
        let newSide = $(button).data("side");
        this.changeImage(creator.sides[newSide]);
        $("#product-sides .current").removeClass("current");
        $(button).addClass("current");
    }

    changeImage(image) {
        this.currentImage = this.canvas.elements.image = image;
        this.canvas.redraw();
    }
}

let creator = new Creator();