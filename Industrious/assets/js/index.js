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

document.addEventListener("DOMContentLoaded", function () {
    var imagenesRutas = {
        ruta1: "images/ruta-MON.jpg",
        ruta2: "images/ruta-MLL.jpg",
        ruta3: "images/ruta-ROM.jpg",
        ruta4:  "images/ruta-ATH.jpg",
        ruta5: "images/ruta-BCN.jpg"
    };

    var imagenBase = document.getElementById("imagenBase");

    // Función para restaurar la imagen base
    function restaurarImagenBase() {
        imagenBase.src = "images/mapabase.jpg"; // Ruta de la imagen base
    }

    // Agregar eventos a cada ruta para cambiar la imagen al pasar el cursor sobre ella
    var rutas = document.getElementsByClassName("ruta");
    for (var i = 0; i < rutas.length; i++) {
        rutas[i].addEventListener("mouseover", function () {
            var idRuta = this.id;
            imagenBase.src = imagenesRutas[idRuta];
        });

        // Restaurar la imagen base al quitar el cursor de encima de la ruta
        rutas[i].addEventListener("mouseout", restaurarImagenBase);
    }
});
