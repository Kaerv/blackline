import { CanvasElement } from "./canvaselement";

export class CanvasSection extends CanvasElement {
    constructor(props) {
        super(props);
        this.canvas = props.canvas;
        this.type = "section";
        this.width = 120;
        this.height = 60;
        this.pos = {
            x: "center",
            y: 40
        }
        this.margin = {
            v: 10,
            h: 10
        }

        this.sides = {};
        this.color = "rgba(50, 50, 50, 0.5)";
        this.text;
    }

    init() {
        super.init();
    }

    addSide(side, params) {
        this.sides[side] = {
            x: params.x,
            y: params.y,
            width: params.width,
            height: params.height
        }
    }

    changeSide(side) {
        this.pos.x = (this.sides[side].x == "center")? this.sides[side].x : parseInt(this.sides[side].x);
        this.pos.y =  (this.sides[side].y == "center")? this.sides[side].y : parseInt(this.sides[side].y);
        this.width = parseInt(this.sides[side].width);
        this.height = parseInt(this.sides[side].height);
        this.canvas.redraw();
    }

    draw(ctx) {
        if(this.height) {
            if(this.text) {
                this.text.setPosition(this.getRelativeHCenterPos());
            }

        }
    }

    drawDebug(ctx) {
        if(this.height) {
            super.draw();
            let relPos = this.getRelativeLeftPos();

            ctx.strokeStyle = this.color;
            ctx.lineWidth = 1;
            ctx.rect(relPos.x, relPos.y, this.width, this.height);
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
            x: (this.pos.x == "center")? this.canvas.canvas.width / 2 / this.canvas.scale - this.width / 2 : this.pos.x,
            y: (this.pos.y == "center")? this.canvas.canvas.height / 2 / this.canvas.scale - this.height / 2 : this.pos.y
        }

        return relPos;
    }
    getRelativeHCenterPos() {
        let relPos = {
            x: (this.pos.x == "center")? this.canvas.canvas.width / 2 / this.canvas.scale : this.pos.x + this.width / 2,
            y: (this.pos.y == "center")? this.canvas.canvas.height / 2 / this.canvas.scale - this.height / 2 : this.pos.y
        }

        return relPos;
    }
}