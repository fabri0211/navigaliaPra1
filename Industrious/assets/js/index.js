document.addEventListener("DOMContentLoaded", function() {
    var barco = document.getElementById("barco");

    document.addEventListener("mousemove", function(event) {
        var posX = event.clientX;
        var posY = barco.offsetTop; // Obtenemos la posición vertical actual del barco

        barco.style.left = posX + "px";
        barco.style.top = posY + "px";
    });
});

