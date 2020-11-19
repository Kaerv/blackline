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
        this.margin = {
            v: 10,
            h: 10
        }
        this.color = "rgba(50, 50, 50, 0.5)";
        this.text;
        this.scale;
    }

    init() {
        super.init();
    }

    draw(ctx, scale) {
        if(this.height) {
            if(this.text)
                this.text.setPosition(this.getRelativeHCenterPos());
            this.scale = scale;
        }
    }

    drawDebug(ctx, scale) {
        if(this.height) {
            super.draw();
            let relPos = this.getRelativeLeftPos();

            ctx.strokeStyle = this.color;
            ctx.lineWidth = 1;
            ctx.rect(relPos.x * this.scale, relPos.y * this.scale, this.width * this.scale, this.height * this.scale);
            ctx.stroke();
        }
    }

    resize() {
        super.resize();
    }

    setText(text) {
        this.text = text;
        this.text.section = this;
    }

    getRelativeLeftPos() {
        let relPos = {
            x: (this.pos.x == "center")? this.canvas.width / 2 / this.scale - this.width / 2 : this.pos.x,
            y: (this.pos.y == "center")? this.canvas.height / 2 / this.scale - this.height / 2 : this.pos.y
        }

        return relPos;
    }
    getRelativeHCenterPos() {
        let relPos = {
            x: (this.pos.x == "center")? this.canvas.width / 2 / this.scale : this.pos.x,
            y: (this.pos.y == "center")? this.canvas.height / 2 / this.scale - this.height / 2 : this.pos.y
        }

        return relPos;
    }
}