import { CanvasElement } from "./canvaselement";
export class CanvasText extends CanvasElement {
    constructor(props) {
        super(props);
        this.selectedFontSize = 5;
        this.font = {
            style: "normal",
            variant: "normal",
            weight: "normal",
            size: `${this.selectedFontSize * this.scale}px`,
            family: "Arial",
            color: "black"
        }

        this.pos = {x: 100, y: 100};
        this.lines = [];
        this.scale;
        this.priority = 100;
        this.textHeight = this.getHeight().descent;
    }

    init() {
        super.init();
    }

    draw(ctx, scale) {
        if(this.font) {
            this.lines = this.breakText(this.section.width * scale);
            ctx.font = this.generateFont();
            ctx.fillStyle = this.font.color;
            ctx.textAlign = "center";
            let y = 0;
            this.lines.forEach((el) => {
                ctx.fillText(el, this.pos.x * scale, this.pos.y * scale + y + this.textHeight * scale);
                y += this.textHeight * scale;
            });

        }
    }

    drawDebug(ctx, scale) {
        if(this.font) {
            let y = 0;
            this.lines.forEach((el) => {
                let elWidth = this.getWidth(el);
                y += this.textHeight * scale;
                this.canvas.drawCircle(
                    this.pos.x * scale - elWidth / 2, 
                    this.pos.y * scale + y - this.textHeight / 2, 
                    1, "red"
                );

                this.canvas.drawCircle(
                    this.pos.x * scale + elWidth / 2, 
                    this.pos.y * scale + y - this.textHeight / 2, 
                    1, "red"
                );
            });
        }
    }
    
    addLine(text) {
        this.lines.push(text);
    }

    setPosition(pos) {
        this.pos = pos;
    }

    setFontSize(size = this.selectedFontSize) {
        this.selectedFontSize = size;
        this.font.size = `${this.selectedFontSize * this.scale}px`;
        this.textHeight = this.getHeight().descent;
    }

    resize(scale) {
        this.scale = scale;
        this.setFontSize();
    }

    setFontFamily(family) {
        this.font.family = family;
        this.textHeight = this.getHeight().descent;
    }

    generateFont() {
        return `${this.font.style} ${this.font.variant} ${this.font.weight} ${this.font.size} ${this.font.family}`
    }

    getWidth(text) {
        return this.canvas.ctx.measureText(text).width;
    }

    breakText(width) {
        this.canvas.ctx.font = this.generateFont();
        let lines = [];
        for(let j = 0; j < this.lines.length; j++) {
            let words = this.lines[j].split(" ");
            let wordsCount = words.length;
            let currLine = "";
    
            for(let i = 0; i < wordsCount; i++) {
                let currWord = words.shift();
                let temp = currLine;
                temp += ` ${currWord}`;
                if(this.getWidth(temp) < width) {
                    currLine = temp;
                }
                else {
                    lines.push(currLine);
                    currLine = currWord;
                }
            }
    
            lines.push(currLine);
        }

        return lines;
    }

    getHeight() {
        var text = $('<span>Hg</span>').css({ fontFamily: `${this.font.size} ${this.font.family}` });
        var block = $('<div style="display: inline-block; width: 1px; height: 0px;"></div>');
      
        var div = $('<div></div>');
        div.append(text, block);
      
        var body = $('body');
        body.append(div);
      
        try {
          var result = {};
      
          block.css({ verticalAlign: 'baseline' });
          result.ascent = block.offset().top - text.offset().top;
      
          block.css({ verticalAlign: 'bottom' });
          result.height = block.offset().top - text.offset().top;
      
          result.descent = result.height - result.ascent;
      
        } finally {
          div.remove();
        }
      
        return result;
      };
}