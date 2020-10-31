export class CanvasText {
    constructor() {
        this.selectedFontSize = 12;
        this.fontStyle = "normal"; // italic, oblique
        this.fontVariant = "normal"; //small-caps
        this.fontWeight = "normal";
        this.fontSize = "12pt";
        this.fontFamily = "Arial";
        this.font = `${this.fontStyle} ${this.fontVariant} ${this.fontWeight} ${this.fontSize} ${this.fontFamily}`;
        this.fillStyle = "black";

        this.pos = {x: 0, y: 0};
        this.content;
        this.scale;
    }

    draw(ctx, scale) {
        ctx.font = this.font;
        ctx.fillStyle = this.fillStyle;
        ctx.fillText(this.content, this.pos.x * scale, this.pos.y * scale);
    }
    
    setContent(text) {
        this.pos = { x: 65, y: 100 };
        this.content = text;
    }

    setFontSize(size) {
        this.selectedFontSize = size;
        this.fontSize = `${this.selectedFontSize * this.scale}px`;
        this.font = `${this.fontStyle} ${this.fontVariant} ${this.fontWeight} ${this.fontSize} ${this.fontFamily}`;
    }

    resize(scale) {
        this.scale = scale;
        this.fontSize = `${this.selectedFontSize * this.scale}px`;
        this.font = `${this.fontStyle} ${this.fontVariant} ${this.fontWeight} ${this.fontSize} ${this.fontFamily}`;
    }

    setFontFamily(family) {
        this.fontFamily = family;
        this.font = `${this.fontStyle} ${this.fontVariant} ${this.fontWeight} ${this.fontSize} ${this.fontFamily}`;
    }
}