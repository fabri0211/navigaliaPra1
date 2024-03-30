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
        ruta4: "images/ruta-ATH.jpg",
        ruta5: "images/ruta-BCN.jpg"
    };

    var imagenBase = document.getElementById("imagenBase");
    var imagenBaseSrc = imagenBase.src; // Guardar la fuente original de la imagen base

    // Función para cambiar la imagen base
    function cambiarImagen(ruta) {
        imagenBase.style.opacity = "0"; // Iniciar transición de opacidad
        imagenBase.src = ruta; // Cambiar la imagen base
        setTimeout(function () {
            imagenBase.style.opacity = "1"; // Restaurar opacidad después de la transición
        }, 100); // Esperar un breve período antes de restaurar la opacidad
    }

    // Controlador de evento para restaurar la imagen base cuando el cursor está fuera de las rutas
    document.body.addEventListener("mouseout", function () {
        cambiarImagen(imagenBaseSrc); // Restaurar la imagen base original
    });

    // Agregar eventos a cada ruta para cambiar la imagen al pasar el cursor sobre ella
    var rutas = document.getElementsByClassName("ruta");
    for (var i = 0; i < rutas.length; i++) {
        rutas[i].addEventListener("mouseover", function () {
            var idRuta = this.id;
            cambiarImagen(imagenesRutas[idRuta]); // Llamar a la función para cambiar la imagen
        });
    }
});

const imagen = document.getElementById('brujula');

document.addEventListener('mousemove', function(e) {
  const { clientX, clientY } = e;
  const { left, top, width, height } = imagen.getBoundingClientRect();

  const centerX = left + width / 2;
  const centerY = top + height / 2;

  const deltaX = clientX - centerX;
  const deltaY = clientY - centerY;

  const angle = Math.atan2(deltaY, deltaX);
  const angleDeg = angle * (180 / Math.PI) - 90;

  imagen.style.transform = `rotate(${angleDeg}deg)`;
});
