import { CanvasElement } from "./canvaselement";
export class CanvasText extends CanvasElement {
    constructor(props) {
        super(props);
        this.selectedFontSize = 4;
        this.font = {
            style: "normal",
            variant: "normal",
            weight: "normal",
            size: `${this.selectedFontSize}`,
            family: "Overpass",
            color: "black"
        }

        this.pos = {x: 100, y: 100};
        this.lines = [];
        this.priority = 100;
        this.textGap = 1;
    }

    init() {
        super.init();
    }

    draw(ctx) {
        if(this.font) {
            this.paragraphs = this.breakText(this.section.width);
            ctx.fillStyle = this.font.color;
            ctx.textAlign = "center";

            this.sectionCenter = this.section.pos.y + this.section.height / 2;
            let y = this.sectionCenter;
            this.paragraphs.forEach((el) => {
                y -= el.height + el.margin;
            });

            this.paragraphs.forEach((el) => {
                this.font.size = `${el.size}`;
                this.font.family = el.font; 
                ctx.font = this.generateFont();
                ctx.fillText(el.content, this.pos.x, y + el.height);
                y += el.height + el.margin + this.textGap;
            });

        }
    }

    drawDebug(ctx) {
        if(this.font) {
            let y = this.sectionCenter;
            this.paragraphs.forEach((el) => {
                y -= el.height + el.margin;
            });
            
            this.paragraphs.forEach((el) => {
                let elWidth = this.getWidth(el);

                this.canvas.drawCircle(
                    this.pos.x - elWidth / 2, 
                    y + el.height, 
                    1, "rgba(255,0,0.1)"
                );

                this.canvas.drawCircle(
                    this.pos.x + elWidth / 2, 
                    y + el.height, 
                    1, "rgba(255,0,0.1)"
                );
                y += el.height + el.margin;
            });

            this.canvas.drawCircle(
                this.pos.x, 
                this.sectionCenter, 
                3, "rgba(0,0,0, 0.5)"
            );    
        }
    }
    
    addLine(text, font, size, margin) {
        let newLine = {
            content: text, 
            size: size? size : this.selectedFontSize, 
            font: font? font : this.font.family,
            margin: margin,
            height: null
        }
        newLine.height = newLine.size
        this.lines.push(newLine);
    }

    setPosition(pos) {
        this.pos = pos;
    }

    resize(scale) {
        this.scale = scale;
        this.lines.forEach((el) => {
            el.height = el.size
        });
    }

    generateFont() {
        return `${this.font.style} ${this.font.variant} ${this.font.weight} ${this.font.size}pt ${this.font.family}`;
    }

    getWidth(el) {
        this.font.size = el.size;
        this.font.family = el.font;
        this.canvas.ctx.font = this.generateFont();
        return this.canvas.ctx.measureText(el.content).width;
    }

    breakText(width) {
        let lines = [];
        for(let j = 0; j < this.lines.length; j++) {
            let words = this.lines[j].content.split(" ");
            let wordsCount = words.length;
            let currLine = "";
            let font = this.lines[j].font;
            let size = this.lines[j].size;
    
            for(let i = 0; i < wordsCount; i++) {
                let currWord = words.shift();
                let temp = currLine;
                temp += (temp == "")?`${currWord}` : ` ${currWord}`;
                if(this.getWidth({ content: temp, font: font, size: size }) < width) {
                    currLine = temp;
                }
                else {
                    lines.push({
                        content: currLine, 
                        font: this.lines[j].font, 
                        size: this.lines[j].size, 
                        margin: 0,
                        height: this.lines[j].height
                    });
                    currLine = currWord;
                }
            }
    
            lines.push({
                content: currLine, 
                font: this.lines[j].font, 
                size: this.lines[j].size, 
                margin: this.lines[j].margin,
                height: this.lines[j].size
            });
        }

        return lines;
    }
}