const canvas = document.getElementById('signature-box');
const ctx = canvas.getContext('2d');
canvas.width = canvas.offsetWidth;
canvas.height = 250;
let drawing = false;

function getMousePos(canvas, evt) {
    const rect = canvas.getBoundingClientRect();
    return {
        x: (evt.clientX - rect.left) * (canvas.width / rect.width),
        y: (evt.clientY - rect.top) * (canvas.height / rect.height)
    };
}

function getTouchPos(canvas, touch) {
    const rect = canvas.getBoundingClientRect();
    return {
        x: (touch.clientX - rect.left) * (canvas.width / rect.width),
        y: (touch.clientY - rect.top) * (canvas.height / rect.height)
    };
}

function startDrawing(e) {
    drawing = true;
    ctx.beginPath();
    const pos = e.touches ? getTouchPos(canvas, e.touches[0]) : getMousePos(canvas, e);
    ctx.moveTo(pos.x, pos.y);
    e.preventDefault();
}

function draw(e) {
    if (!drawing) return;
    const pos = e.touches ? getTouchPos(canvas, e.touches[0]) : getMousePos(canvas, e);
    ctx.lineTo(pos.x, pos.y);
    ctx.stroke();
    e.preventDefault();
}

function stopDrawing(e) {
    if (!drawing) return;
    drawing = false;
    e.preventDefault();
}

function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    document.getElementById('signature-svg').value = '';
}

canvas.addEventListener('mousedown', startDrawing);
canvas.addEventListener('mousemove', draw);
canvas.addEventListener('mouseup', stopDrawing);
canvas.addEventListener('mouseout', stopDrawing);

canvas.addEventListener('touchstart', startDrawing);
canvas.addEventListener('touchmove', draw);
canvas.addEventListener('touchend', stopDrawing);
canvas.addEventListener('touchcancel', stopDrawing);

document.getElementById('registration-form').addEventListener('submit', function(e) {
    if (isCanvasBlank(canvas)) {
        e.preventDefault(); // Formun gönderilmesini engelle
        alert('Please provide your signature.'); // Uyarı göster, ancak form gönderimini tamamen durdur
        return; // Burada return kullanarak formun geri kalan işlemlerine devam edilmemesini sağlıyoruz
    }
    
    // Eğer imza mevcutsa, formu işle
    const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="${canvas.width}" height="${canvas.height}">
        <path d="${getPathData()}" fill="none" stroke="black" />
    </svg>`;
    document.getElementById('signature-svg').value = btoa(svg);  // Encode SVG to Base64
});


function getPathData() {
    const data = ctx.getImageData(0, 0, canvas.width, canvas.height).data;
    let path = '';
    let x = 0;
    let y = 0;
    for (let i = 0; i < data.length; i += 4) {
        if (data[i + 3] > 0) {  // Alpha channel
            if (path) {
                path += ' ';
            }
            path += `M${x},${y}L${x + 1},${y + 1}`;
        }
        x += 1;
        if (x >= canvas.width) {
            x = 0;
            y += 1;
        }
    }
    return path;
}

function isCanvasBlank(canvas) {
    const context = canvas.getContext('2d');
    const pixelBuffer = new Uint32Array(
        context.getImageData(0, 0, canvas.width, canvas.height).data.buffer
    );

    return !pixelBuffer.some(color => color !== 0);
}

function updateDeclaration() {
    const firstName = document.getElementById('driverFirstName').value;
    const lastName = document.getElementById('driverLastName').value;
    const declarationText = document.getElementById('declaration-text');
    declarationText.textContent = `I, ${firstName} ${lastName}, declare that:`;
}
