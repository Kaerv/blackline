export class CanvasElement {
    constructor(props) {
        props.canvas.add(this);
        this.id = "";
        this.type = "";
        this.priority = 0;
        this.canvas = props.canvas;
    }

    init() {

    }

    draw() {

    }

    resize() {

    }

    drawDebug(ctx, scale) {

    }
}