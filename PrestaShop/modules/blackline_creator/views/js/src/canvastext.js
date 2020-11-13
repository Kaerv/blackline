import { CanvasElement } from "./canvaselement";
export class CanvasText extends CanvasElement {
    constructor(props) {
        super(props);
        this.selectedFontSize = 12;
        this.font = {
            style: "normal",
            variant: "normal",
            weight: "normal",
            size: `${this.selectedFontSize * this.scale}px`,
            family: "Arial",
            color: "black"
        }

        this.pos = {x: 100, y: 100};
        this.content = "";
        this.scale;
        this.priority = 100;
    }

    init() {
        super.init();
    }

    draw(ctx, scale) {
        if(this.font) {
            ctx.font = this.generateFont();
            ctx.fillStyle = this.font.color;
            ctx.fillText(this.content, this.pos.x * scale, this.pos.y * scale);
        }
    }
    
    setContent(text) {
        this.content = text;
    }

    setPosition(pos) {
        this.pos = pos;
    }

    setFontSize(size = this.selectedFontSize) {
        this.selectedFontSize = size;
        this.font.size = `${this.selectedFontSize * this.scale}px`;
    }

    resize(scale) {
        this.scale = scale;
        this.setFontSize();
    }

    setFontFamily(family) {
        this.font.family = family;
    }

    generateFont() {
        return `${this.font.style} ${this.font.variant} ${this.font.weight} ${this.font.size} ${this.font.family}`
    }
}