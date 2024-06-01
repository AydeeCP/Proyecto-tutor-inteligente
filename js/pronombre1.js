const oraciones = [
    "Juan come pollo.",
    "María lee un libro.",
    "Pedro compra frutas.",
];

let palabrasAcertadas = 0;
let oracionesIncorrectas = 0;
let indiceOracionActual = 0;
var vecesJugadas = 1;
var totalPalabras=3;
var containerDiv = document.querySelector(".container");
var mensajeFinalDiv = document.getElementById("mensajeFinal");

document.addEventListener("DOMContentLoaded", function () {
    const checkButton = document.getElementById("checkButton");
    const siguienteButton = document.getElementById("btnSiguiente");
    const volverJ = document.getElementById("volverEmpezar");
    checkButton.addEventListener("click", verificarRespuesta);
    siguienteButton.addEventListener("click", mostrarSiguienteOracion);
    volverJ.addEventListener("click", volverJugar);
    iniciarJuego();
});

function iniciarJuego() {
    const oracionCorrecta = oraciones[indiceOracionActual];
    const oracionDesordenada = barajarPalabras(oracionCorrecta); 
    document.getElementById("oracion").textContent = oracionDesordenada;
}
function mostrarSiguienteOracion() {
    indiceOracionActual++;
    if (indiceOracionActual >= oraciones.length) {
        console.log("Juego terminado");
        mensajeFinalDiv.style.display = "block";
        var correc= document.getElementById('correctasF');
        var cant = document.getElementById('cantidadArray');
        correc.textContent=palabrasAcertadas;
        cant.textContent = oraciones.length;
        actualizarInsignia();
        containerDiv.style.display="none";
        return;
    }
    const siguienteOracion = oraciones[indiceOracionActual];
    document.getElementById("oracion").textContent = barajarPalabras(siguienteOracion);
    document.getElementById("oracionIngresada").value = '';
    limpiarRetroalimentacion();
}

function barajarPalabras(oracion) {
    if (!oracion) {
        return '';
    }
    const palabras = oracion.split(" ");
    palabras.sort(() => Math.random() - 0.5);
    return palabras.join(" ");
}

function verificarRespuesta() {
    let oracionIngresada = document.getElementById("oracionIngresada").value.trim().toLowerCase();
    const oracionCorrecta = oraciones[indiceOracionActual].toLowerCase();
    limpiarRetroalimentacion();
    
    // Agregar un punto al final si no está presente
    if (!oracionIngresada.endsWith('.')) {
        oracionIngresada += '.';
    }

    if (oracionIngresada === oracionCorrecta) {
        palabrasAcertadas++;
        console.log("¡Correcto!");
        imagenSrc = "../image/victory.gif";
        mensaje = "¡Correcto!";
        mostrarMensajeFeedback(mensaje, imagenSrc,'green',3000);
        document.getElementById("palabrasAcertadasInput").value = palabrasAcertadas;

    } else {
        oracionesIncorrectas++;
        imagenSrc = "../image/triste.gif";
        mensaje = "¡Incorrecto!";
        console.log("¡Incorrecto!");
        mostrarMensajeFeedback(mensaje,imagenSrc,'red',3000);
        mostrarRetroalimentacion(oracionIngresada, oracionCorrecta);

    }
    console.log("Oraciones correctas: " + palabrasAcertadas);
    console.log("Oraciones incorrectas: " + oracionesIncorrectas);
    
}
function mostrarRetroalimentacion(oracionIngresada, oracionCorrecta) {
    let retroalimentacion = "Incorrecto.\n";
    const palabrasIngresadas = oracionIngresada.split(" ");
    const palabrasCorrectas = oracionCorrecta.split(" ");
    
    for (let i = 0; i < palabrasIngresadas.length; i++) {
        if (palabrasIngresadas[i] !== palabrasCorrectas[i]) {
            retroalimentacion += "La palabra " + palabrasIngresadas[i] + "\n";
            //+ "' debería ser '" + palabrasCorrectas[i] + "
            
        }
    }
    document.getElementById("retroalimentacion").textContent = retroalimentacion;
}
function limpiarRetroalimentacion() {
    document.getElementById("retroalimentacion").textContent = "";
}
function mostrarMensajeFeedback(mensaje, imagenSrc, color, duracion) {
    var mensajeFeedback = document.getElementById("mensajeFeedback");
    var feedbackImage = document.getElementById("feedbackImage");
    var feedbackMessage = document.getElementById("feedbackMessage");
    feedbackImage.src = imagenSrc;
    feedbackMessage.textContent = mensaje;
    feedbackMessage.style.color = color;
    mensajeFeedback.style.display = "block";
    containerDiv.style.opacity = "0";
    setTimeout(function () {
        mensajeFeedback.style.display = "none";
        containerDiv.style.opacity = "1";
    }, duracion);
}
//VOLVER A JUGAR
function volverJugar(){
    palabrasAcertadas=0;
    oracionesIncorrectas=0;
    indiceOracionActual=0;
    mensajeFinalDiv.style.display="none";
    containerDiv.style.display="block";
    document.getElementById("oracionIngresada").value="";
    document.getElementById("palabrasAcertadasInput").value="0";
    vecesJugadas++;
    console.log("veces jugadas: " + vecesJugadas);
    document.getElementById("vecesJugadasInput").value = vecesJugadas;

    localStorage.setItem("vecesJugadas", vecesJugadas);

    iniciarJuego();
}

// salir de jugar
function almacenarActividad(opcionNavbar, temaPracticado, juegoSeleccionado, palabrasAcertadas,vecesJugadas) {

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../datosE/almacenar_actividad.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange=function() {
        if(xhr.readyState == 4 && xhr.status == 200){
            console.log ('palabras acertadas : ', palabrasAcertadas);
            console.log('actividad almacenada veces jugadas:', vecesJugadas);
            
            console.log('actividad almacenada', xhr.responseText);
        }
    };
    var params ='opcion_navbar=' + encodeURIComponent(opcionNavbar) + 
                '&tema_practicado=' + encodeURIComponent(temaPracticado) + 
                '&juego_seleccionado=' + encodeURIComponent(juegoSeleccionado)+
                '&palabrasAcertadas=' + encodeURIComponent(palabrasAcertadas) +
                '&vecesJugadas=' + encodeURIComponent(vecesJugadas);
    xhr.send(params);
}