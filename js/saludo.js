class Automata {
    constructor(word, alphabet) {
        this.word = word.toUpperCase();
        this.currentState = 0;
        this.finalState = word.length;
        this.alphabet = alphabet;
    }

    transition(letter) {
        if (!this.alphabet.includes(letter.toUpperCase())) {
            console.log("Error: la letra", letter, "no está en el alfabeto");
            return false; // La letra no está en el alfabeto
        }
        if (this.currentState < this.finalState && letter.toUpperCase() === this.word[this.currentState]) {
            this.currentState++;
            console.log("Transición exitosa, estado actual:", this.currentState);
            return true;
        }
        return false;
    }

    isAccepted() {
        console.log("Estado actual:", this.currentState);
        console.log("Estado final:", this.finalState);
        return this.currentState === this.finalState;
    }
}

// Definimos el alfabeto y el conjunto de saludos con sus autómatas
const alphabet = ' KkKHkhK\'k\'QqQHqh\'Q\'q\'CHchCHHchhCH\'ch\'PpPHphP\'p\'TtTHthT\'t\'MmNnÑñLlLLllJjXxRrSsYyWwAaÄäUuÜüIiÏï';
const saludos = [
    { frase: "ASKI URUKIPANA", automata: new Automata("ASKI URUKIPANA", alphabet) },
    { frase: "ASKI JAYP'UKIPANA", automata:new Automata("ASKI JAYP'UKIPANA",alphabet)},
    { frase: "ASKI ARUMAKIPANA", automata: new Automata("ASKI ARUMAKIPANA", alphabet)},
    {frase:"ASKI URUKIPANA JILATA", automata: new Automata("ASKI URUKIPANA JILATA",alphabet)},
    {frase:"ASKI ARUMAKIPANA MASI", automata:new Automata("ASKI ARUMAKIPANA MASI",alphabet)}
];

var containerDiv = document.querySelector(".Contenedor3");
var palabrasAcertadas = 0;

var vecesJugadas = 1;
var totalPalabras = 5;

document.addEventListener("DOMContentLoaded",function(){
    deshabilitarEnlace();
});
function reproducirAudio(sonido) {
    var audio = new Audio("../audios/" + sonido + ".mp3");
    audio.play();
    setTimeout(function () {
    audio.pause();
    audio.currentTime = 0;
    }, 5000);
}

function checkAnswer() {
    const answers = document.querySelectorAll('.answer');
    const inputs = document.querySelectorAll('.Contenedor3 .input-respuesta');
    let palabrasCorrectas = 0;
    let palabrasIncorrectas = 0;

    inputs.forEach((input, index) => {
        //console.log("Index de input:", index); // Imprimir el índice del elemento en la lista inputs
        const userInput = input.value.trim().toUpperCase();
        const saludoData = saludos[index]; // Obtener el objeto de saludo correspondiente

        if (!saludoData) {
            alert("Error: No hay datos de saludo correspondientes para el input en el índice", index);
            return; // Salir de la iteración si no hay datos de saludo correspondientes
        }
        let automata = saludoData.automata;
        automata.currentState = 0;

        let isCorrect = false;

        for (let letter of userInput) {
            if (!automata.alphabet.includes(letter)) {
                console.log("Error: la letra", letter, "no está en el alfabeto");
                return;
            }
            if (!automata.transition(letter)) {
                console.log("Transición fallida para el saludo:", saludoData.frase);
                break;
            }
        }


        if (automata.isAccepted()) {
            //console.log("Transición exitosa para el saludo:", saludoData.frase);
            isCorrect = true;
        }

        if (isCorrect) {
            palabrasCorrectas++;
            palabrasAcertadas++;
            input.classList.remove('incorrect-answer');
            input.classList.add('correct-answer');
        } else {
            palabrasIncorrectas++;
            input.classList.remove('correct-answer');
            input.classList.add('incorrect-answer');
        }
        deshabilitarEnlace();
    });

    let mensaje;
    if (palabrasCorrectas === inputs.length && palabrasIncorrectas === 0) {
        document.getElementById("correctas").innerHTML = palabrasCorrectas;
        document.getElementById("palabrasAcertadasInput").value=palabrasAcertadas;
        mensaje = "¡Waliki!";
        reproducirAudio("correcto"); 
        mostrarMensajeFeedback(mensaje,'../image/victory.gif','green',3000);
        deshabilitarInputs();
        document.getElementById("volverJ").disabled = false;
        habilitarEnlace();

    } else if (palabrasCorrectas === 0 && palabrasIncorrectas === inputs.length) {
        document.getElementById("equivocadas").innerHTML = palabrasIncorrectas;
        document.getElementById("palabrasAcertadasInput").value=palabrasAcertadas;
        mensaje = "¡Janiw walikiti!";
        reproducirAudio("incorrecto");
        mostrarMensajeFeedback(mensaje,'../image/triste.gif','red',4000);
        deshabilitarInputs();
        document.getElementById("volverJ").disabled = false;
        document.getElementById('volverJ').classList.add('b-activado');
        habilitarEnlace();
    } else {
        document.getElementById("palabrasAcertadasInput").value=palabrasAcertadas;
        mensaje = "Te equivocaste en algunas respuestas.";
        document.getElementById("equivocadas").innerHTML = palabrasIncorrectas;
        document.getElementById("correctas").innerHTML = palabrasCorrectas;
        mostrarMensajeFeedback(mensaje,'../image/pensando.gif','orange',3000);
        deshabilitarInputs();
        document.getElementById("volverJ").disabled = false;
        document.getElementById('volverJ').classList.add('b-activado');
        habilitarEnlace();
    }
    console.log("correctas: " + palabrasCorrectas);
    console.log("Incorrectas: " + palabrasIncorrectas);
    console.log(mensaje);
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

function deshabilitarInputs(){
    const inputs = document.querySelectorAll('.Contenedor3 .input-respuesta');
    inputs.forEach(input => {
        input.disabled = true;
    });
}
function habilitarInputs(){
    const inputs = document.querySelectorAll('.Contenedor3 .input-respuesta');
    inputs.forEach(input => {
        input.value = ''; 
        input.disabled = false;
        input.classList.remove('correct-answer','incorrect-answer');
        input.classList.add('answer-empty');
    });
}

function habilitarEnlace(){
    var enlace = document.getElementById('miEnlace');
    enlace.removeAttribute('disabled');
}

function deshabilitarEnlace(){
    var enlace = document.getElementById('miEnlace');
    enlace.setAttribute('disabled', 'disabled');
}

function reiniciarJuego() {
    palabrasAcertadas = 0;
    palabrasCorrectas=0;
    palabrasIncorrectas=0;

    console.log("palabras acertadas: "+palabrasAcertadas);
    
    habilitarInputs();
  // Reiniciar el contador de veces jugadas
    vecesJugadas++;
    console.log("veces jugadas: " + vecesJugadas);
    document.getElementById("vecesJugadasInput").value = vecesJugadas;
    document.getElementById("palabrasAcertadasInput").value = 0;
    document.getElementById("correctas").innerHTML = "0";
    document.getElementById("equivocadas").innerHTML="0";
    localStorage.setItem("vecesJugadas", vecesJugadas);
    deshabilitarEnlace();
}
function actualizarInsigniaYAlmacenar() {
    // Primero, actualiza la insignia
    actualizarInsignia();

    // Luego, obtiene la medalla actualizada desde localStorage
    let medalla = localStorage.getItem("insignia");
    //console.log("insignia: " + medalla); // Imprimir la medalla para depurar

    //llama a la función almacenarActividad con la medalla correcta
    almacenarActividad('Gramática','Saludos','Traduce los saludos',palabrasAcertadas,vecesJugadas,medalla);
}
/*BOTON SALIR*/
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("miEnlace").addEventListener("click",function(event){
        document.getElementById("mensajeFinal").style.display="block";
        var correc= document.getElementById('correctasF');
        var cant = document.getElementById('cantidadArray');
        correc.textContent=palabrasAcertadas;
        cant.textContent = saludos.length;
        actualizarInsignia();
        event.preventDefault();
        console.log(correc); // Agregado para depurar
        console.log(cant); // Agregado para depurar
        document.querySelector(".Contenedor3").style.display="none";
        /*REDIRECCIONAMIENTO A LA PAGIA DE INICIO*/
        setTimeout(function() {
                window.location.href = "../cursos/tercero.php";
            },5000);
        });
});

function almacenarActividad(opcionNavbar, temaPracticado, juegoSeleccionado, palabrasAcertadas, vecesJugadas, medalla) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../datosE/almacenar_actividad.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            //console.log('Actividad almacenada', xhr.responseText);
        }
    };
    var params = 'opcion_navbar=' + encodeURIComponent(opcionNavbar) + 
                '&tema_practicado=' + encodeURIComponent(temaPracticado) + 
                '&juego_seleccionado=' + encodeURIComponent(juegoSeleccionado) +
                '&palabrasAcertadas=' + encodeURIComponent(palabrasAcertadas) +
                '&vecesJugadas=' + encodeURIComponent(vecesJugadas) +
                '&medalla=' + encodeURIComponent(medalla);
    xhr.send(params);
}