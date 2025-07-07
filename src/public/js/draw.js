let canva = document.getElementById('canva');
let saveButton = document.getElementById('save-button');
let draw = canva.getContext('2d');

let drawingTitleElement = document.getElementById('draw-title'),
    drawingDescriptionElement = document.getElementById('draw-description');

// https://developer.mozilla.org/pt-BR/docs/Web/API/HTMLCanvasElement/toDataURL
// https://developer.mozilla.org/en-US/docs/Web/API/Canvas_API/Tutorial/Using_images

// BASICS
// Coordinates start in the top left corner, as (0,0).

// .moveTo(x, y): move line drawing pointer to (x, y)
// .lineTo(x, y): draw line from pointer to (x, y)
// .lineWidth: property that holds line width (int).
// .strokeStyle: property that holds line or outline color (e.g.: "blue").
// .lineCap: property that holds the line edge style ("butt", "round" or "square")

// .fillStyle: property that holds fill color to draw with
// .rect(x, y, width, height): draw a rectangle
// .fillRect(x, y, width, height): draw filled rectangle

//.beginPath(): starting new path.
// .arc(x, y, radius, startangle, endangle)

// .stroke(): render

// TEXT
// .font: holds "<font-size> <font-family>"
// .fillText(text, x, y): render full written text with .font
// .strokeText(text, x, y): render text outline with .font
// .createLinearGradient(angle, ...)

// Background Color
draw.fillStyle = "white";
draw.fillRect(0, 0, 900, 900);
draw.stroke();

draw.lineWidth = 4;

let coordinates = [0, 0]

let mouseOut = true;

// Drawing Event
canva.addEventListener('mousemove', (e)=>
    {
        let pressed = e.buttons;
        if(pressed)
            {
                draw.beginPath();
                if(!mouseOut)
                    draw.moveTo(coordinates[0], coordinates[1]);
                else draw.moveTo(e.offsetX-1, e.offsetY-1);
                draw.lineTo(e.offsetX, e.offsetY);

                coordinates = [e.offsetX, e.offsetY];
                draw.stroke();
                mouseOut = false;
                
            }
        else mouseOut = true;
    })

let savedImg = new Image();

savedImg.addEventListener('load', ()=>
    {
        draw.drawImage(savedImg, 0, 0);
    })

window.addEventListener('resize', ()=>
    {
        console.log('a', window.innerWidth);
        let url = canva.toDataURL();

        if(window.innerWidth > 940)
            {
                canva.height = "600";
                canva.width = "600";
                
            }
        else if (window.innerWidth > 500)
            {
                canva.height = "450";
                canva.width = "450";
                draw.stroke();
            }
        else
        {
                canva.height = "300";
                canva.width = "300";
                draw.stroke();
        }
        savedImg.src = url;
    })



async function saveDrawing()
{
    let savedDrawingURL = canva.toDataURL();

    // https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch
    let res = await fetch('/api/create_drawing.php', {
        method: "POST",
        body: new URLSearchParams({
            'title': drawingTitleElement.value,
            'description': drawingDescriptionElement.value,
            'drawing_data': savedDrawingURL
        }),
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })

    console.log(await res.json());
}



saveButton.addEventListener('click', (e)=>
    {
        e.preventDefault();
        saveDrawing();
    })