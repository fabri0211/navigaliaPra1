document.addEventListener("DOMContentLoaded", function() {
    var barco = document.getElementById("barco");

    document.addEventListener("mousemove", function(event) {
        var posX = event.clientX;
        var posY = barco.offsetTop; // Obtenemos la posición vertical actual del barco

        barco.style.left = posX + "px";
        barco.style.top = posY + "px";
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var barco = document.getElementById("barco");
    var lastX = window.innerWidth / 2;

    document.addEventListener("mousemove", function(event) {
        if (event.clientX > lastX) {
            barco.style.transform = "scaleX(-1)";
        } else {
            barco.style.transform = "scaleX(1)";
        }
        lastX = event.clientX;
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var barco = document.getElementById("barco");
    var mouseX = 0;
    var easingFactor = 0.1; // Ajusta este valor para controlar la velocidad de desaceleración
    var barcoX = barco.offsetLeft + barco.offsetWidth / 2;

    document.addEventListener("mousemove", function(event) {
        mouseX = event.clientX;
    });

    function updateBarcoPosition() {
        var dx = mouseX - barcoX;
        var distance = Math.abs(dx);
        
        // Aplica la interpolación y la desaceleración
        if (distance > 1) {
            var targetX = barcoX + dx * easingFactor;
            barcoX += (targetX - barcoX) * easingFactor; // Gradualmente ajusta la posición del barco

            barco.style.left = barcoX - barco.offsetWidth / 2 + "px";
        }

        requestAnimationFrame(updateBarcoPosition);
    }

    updateBarcoPosition();
});