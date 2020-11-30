import { chooseQuoteEvents } from "./choose-quote";
import "./creator-select-input";
import { selectInputEvents } from "./creator-select-input";
import { Canvas } from "./canvas";
import { CanvasText } from "./canvastext";
import { CanvasImage } from "./canvasimage";
import { CanvasSection } from "./canvassection";
 
class Creator {
    constructor() {
        this.start = Date.now();
        this.sides = {};
        this.currentImage;
        this.canvas;
        this.text;
        this.section;

        this.init();
    }

    init() {
        this.canvas = new Canvas();
        this.initImages().then((image) => {
            console.log(`Images loaded: ${Date.now() - this.start}ms`);

            this.canvas.init({width: image.width, height: image.height});
            this.changeImage(creator.sides.front);
            this.initEventListeners();
            this.initSection();
            this.initText();
            this.canvas.resize();
            this.canvas.initCursorHandler();

            console.log(`Creator ready: ${Date.now() - this.start}ms`);
        });
    }

    initImages() {
        let canvas = this.canvas;
        return new Promise ((resolve, reject) => {
            this.sides.front = new CanvasImage({canvas: canvas});
            this.sides.back = new CanvasImage({canvas: canvas});

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

    initSection() {
        this.section = new CanvasSection({canvas: this.canvas});
        this.section.init();
        this.section.addSide("front", config.front);
        this.section.addSide("back", config.back);
        this.section.changeSide("front");
    }

    initText() {
        this.text = new CanvasText({canvas: this.canvas});
        this.section.setText(this.text);

        let selectedQuote = $(".selected-quote").text();

        if(selectedQuote) {
           this.text.addLine(",,", "Overpass", 16, 6);
           this.text.addLine(quote, "Overpass", 4, 3);
           this.text.addLine(author, "Overpass", 4, 0);
        }
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

        $("#continue-button").on("click", function() {
            let canvasData = self.canvas.canvas.toDataURL();
            $.ajax({
                method: "post",
                url: `${$(this).data("redirect")}`,
                data: {
                    id_product: productId,
                    img: canvasData
                },
                success: function(response) {
                    console.log(response);
                }
            });
        });
    }

    changeSide(button) {
        let newSide = $(button).data("side");
        this.changeImage(creator.sides[newSide]);
        this.section.changeSide(newSide);
        $("#product-sides .current").removeClass("current");
        $(button).addClass("current");
    }

    changeImage(image) {
        this.canvas.removeElementByType("image");
        this.canvas.add(image);
        this.currentImage = image;
        this.canvas.redraw();
    }
}

let creator = new Creator();