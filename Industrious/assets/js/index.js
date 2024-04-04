
// Vaixell
document.addEventListener("DOMContentLoaded", function() {
    var barco = document.getElementById("barco");

    document.addEventListener("mousemove", function(event) {
        var posX = event.clientX;
        var posY = barco.offsetTop; 

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
    var easingFactor = 0.1; 
    var barcoX = barco.offsetLeft + barco.offsetWidth / 2;

    document.addEventListener("mousemove", function(event) {
        mouseX = event.clientX;
    });

    function updateBarcoPosition() {
        var dx = mouseX - barcoX;
        var distance = Math.abs(dx);
        
        
        if (distance > 1) {
            var targetX = barcoX + dx * easingFactor;
            barcoX += (targetX - barcoX) * easingFactor; 

            barco.style.left = barcoX - barco.offsetWidth / 2 + "px";
        }

        requestAnimationFrame(updateBarcoPosition);
    }

    updateBarcoPosition();
});

// Rutes
document.addEventListener("DOMContentLoaded", function () {
    var imagenesRutas = {
        ruta1: "images/ruta-MON.jpg",
        ruta2: "images/ruta-MLL.jpg",
        ruta3: "images/ruta-ROM.jpg",
        ruta4: "images/ruta-ATH.jpg",
        ruta5: "images/ruta-BCN.jpg"
    };

    var imagenBase = document.getElementById("imagenBase");
    var imagenBaseSrc = imagenBase.src; 

   
    function cambiarImagen(ruta) {
        imagenBase.style.opacity = "0"; 
        imagenBase.src = ruta; 
        setTimeout(function () {
            imagenBase.style.opacity = "1"; 
        }, 100); 
    }

    
    document.body.addEventListener("mouseout", function () {
        cambiarImagen(imagenBaseSrc); 
    });

    
    var rutas = document.getElementsByClassName("ruta");
    for (var i = 0; i < rutas.length; i++) {
        rutas[i].addEventListener("mouseover", function () {
            var idRuta = this.id;
            cambiarImagen(imagenesRutas[idRuta]); 
        });
    }
});

//Bruixola

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
