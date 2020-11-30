export class Canvas {
    constructor() {
        this.canvas;
        this.ctx;

        this.scale;
        this.imagesSize;
        this.container;
        this.elements = [];

        this.isPosShowing = false;
        this.drawTimes = 0;
        this.debug = false;
    }

    init(imagesSize) {
        this.imagesSize = imagesSize;
        this.container = $("#product-view");
        this.updateScale();
        $(this.container).append(`
            <canvas 
                id='product-live-view' 
                width='${this.imagesSize.width * this.scale}'
                height='${this.imagesSize.height * this.scale}'>
                </canvas>
        `);
        this.canvas = $("#product-live-view").get(0);
        this.ctx = this.canvas.getContext("2d");
    }

    resize() {
        this.updateScale();
        for(const property in this.elements) 
            this.elements[property].resize(this.scale);
        
        this.canvas.width = this.imagesSize.width * this.scale;
        this.canvas.height = this.imagesSize.height * this.scale;
        this.redraw();
    }

    updateScale() {
        let containerWidth = $(this.container).width();
        this.scale = containerWidth / this.imagesSize.width;
    }

    initCursorHandler() {
        let self = this;

        $(window).on("mousemove", function() {
            if(self.isPosShowing) {
                self.redraw();
                self.isPosShowing = false;
            }
        });

        this.canvas.addEventListener("mousemove", function(evt) {
            if(self.debug) {
                evt.preventDefault();
                evt.stopImmediatePropagation();
                self.isPosShowing = true;

                let rect = self.canvas.getBoundingClientRect();
                let x = Math.round(evt.clientX - rect.left);
                let y = Math.round(evt.clientY - rect.top);

                self.redraw();
                self.drawCircle(x, y, 2, "white");
                self.drawCursorPos(x, y);
            }
        });
    }

    drawCircle(x, y, radius, color) {
        this.ctx.beginPath();
        this.ctx.arc(x, y, radius, 0, 2 * Math.PI, false);
        this.ctx.fillStyle = color;
        this.ctx.fill();
        this.ctx.lineWidth = 1;
        this.ctx.strokeStyle = '#333';
        this.ctx.stroke();
    }

    drawCursorPos(x, y) {
        this.ctx.lineWidth = 1;
        this.ctx.strokeStyle = '#333';
        this.ctx.fillStyle = '#FFF';
        this.ctx.font = "11px Arial";
        this.ctx.textAlign = "left";
        this.ctx.fillText(`x: ${x}, y: ${y}`, x + 5, y);
        this.ctx.strokeText(`x: ${x}, y: ${y}`, x + 5, y);
        this.ctx.fillText(`ox: ${Math.round(x / this.scale)}, oy: ${Math.round(y / this.scale)}`, x + 5, y + 12);
        this.ctx.strokeText(`ox: ${Math.round(x / this.scale)}, oy: ${Math.round(y / this.scale)}`, x + 5, y + 12);
    }

    redraw() {
        if(this.ctx) {
            this.drawTimes++;
            let elements = [];
            this.elements.forEach((el, index) => {
                elements.push({
                    priority: el.priority,
                    el: el
                });
            });
            elements.sort(compare);
            
            this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
            elements.forEach((obj, index) => { 
                this.ctx.save();
                this.ctx.scale(this.scale, this.scale);
                obj.el.draw(this.ctx);
                this.ctx.restore();
            });

            if(this.debug) {
                elements.forEach((obj, index) => { 
                    this.ctx.save();
                    this.ctx.scale(this.scale, this.scale);
                    obj.el.drawDebug(this.ctx, this.scale);
                    this.ctx.restore();
                });
                this.drawDebug();
            }
        }
    }

    drawDebug() {
        this.ctx.save();
        this.ctx.fillStyle = "#F00";
        this.ctx.font = "10px Arial";
        this.ctx.textAlign = "left";
        this.ctx.fillText("Tryb debugowania włączony", 10, this.canvas.height - 20);
        this.ctx.restore();
    }

    add(element) {
        this.elements.push(element);
        element.canvas = this;
        this.redraw();
    }

    removeElementByType(type) {
        let el = this.getElementByType(type);
        let index = this.elements.indexOf(el);
        if(index > -1) {
            this.elements.splice(index, 1);
        }
    }

    getElementByType(type) {
        let result;
        this.elements.forEach((el, index) => {
            if(el.type == type)
                result = el;
        });
        return result;
    }
}


function compare( a, b ) {
    if ( a.priority < b.priority ){
      return -1;
    }
    if ( a.priority > b.priority ){
      return 1;
    }
    return 0;
  }