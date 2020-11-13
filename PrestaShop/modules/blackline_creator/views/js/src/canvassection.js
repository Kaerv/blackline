import { CanvasElement } from "./canvaselement";

export class CanvasSection extends CanvasElement {
    constructor(props) {
        super(props);
        this.canvas = props.canvas.canvas;
        this.type = "section";
        this.width = 100;
        this.height = 60;
        this.pos = {
            x: "center",
            y: 40
        }
        this.color = "rgba(50, 50, 50, 0.5)";
        this.text;
    }

    init() {
        super.init();
    }

    draw(ctx, scale) {
        if(this.height) {
            super.draw();
            let x = this.pos.x;
            let y = this.pos.y;
            if(x == "center") {
                x = this.canvas.width / 2 / scale - this.width / 2;
            }
            ctx.strokeStyle = this.color;
            ctx.lineWidth = 1;
            ctx.rect(x * scale, y * scale, this.width * scale, this.height * scale);
            ctx.stroke();
        }
    }

    resize() {
        super.resize();
    }

    setText(text) {
        this.text = text;
    }
}