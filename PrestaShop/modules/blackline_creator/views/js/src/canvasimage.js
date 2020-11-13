import { CanvasElement } from "./canvaselement";
export class CanvasImage extends CanvasElement {
    constructor(props) {
        super(props);
        this.imageHandler = new Image();
        this.width;
        this.height;
        this.type = "image";
    }

    init(src) {
        super.init();
        let self = this;
        return new Promise((resolve, reject) => {
            this.imageHandler.src = src;
            this.imageHandler.onload = function() { 
                self.width = this.width;
                self.height = this.height;
                resolve({
                    width: self.width, 
                    height: self.height
                });
            }
        });
    } 

    draw(ctx, scale) {
        ctx.drawImage(
            this.imageHandler, 
            0, 0, 
            this.width * scale, 
            this.height * scale
        ); 
    }

    resize(scale) {
        
    }
}