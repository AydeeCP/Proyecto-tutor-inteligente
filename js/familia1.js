class Automata {
    constructor(word, alfabeto) {
        this.word = word.toUpperCase();
        this.currentState = 0;
        this.finalState = word.length;
        this.alfabeto = alfabeto;
    }

    transition(letter) {
        if (!this.alfabeto.includes(letter.toUpperCase())) {
            //console.log("Error: la letra", letter, "no está en el alfabeto");
            return false; // La letra no está en el alfabeto
        }
        if (
            this.currentState < this.finalState &&
            letter.toUpperCase() === this.word[this.currentState]
        ) {
            this.currentState++;
            //console.log("Transición exitosa, estado actual:", this.currentState);
            return true;
        }
        return false;
    }

    isAccepted() {
        //console.log("Estado actual:", this.currentState);
        //console.log("Estado final:", this.finalState);
        return this.currentState === this.finalState;
    }
}

const palabras = [
    { castellano: "ESPOSO : HOMBRE", aymara: "CHACHA" },
    { castellano: "ESPOSA : MUJER", aymara: "WARMI" },
    { castellano: "AMIGO", aymara: "MASI" },
    { castellano: "NIÑA", aymara: "LULU" },
    { castellano: "NIÑO", aymara: "WAWA" },
    { castellano: "HERMANO", aymara: "JILA" },
    { castellano: "PAPÁ", aymara: "TATA" },
    { castellano: "HERMANA", aymara: "KULLAKA" },
    { castellano: "BEBÉ", aymara: "ASU" },
    { castellano: "TÍO", aymara: "IPU" }
];

const automatas = palabras.map((palabra) => ({
    palabra: palabra.aymara.toUpperCase(),
    automata: new Automata(
        palabra.aymara.toUpperCase(),
        "KkKHkhK'k'QqQHqh'Q'q'CHchCHHchhCH'ch'PpPHphP'p'TtTHthT't'MmNnÑñLlLLllJjXxRrSsYyWwAaÄäUuÜüIiÏï"
    ),
}));

var containerDiv = document.querySelector(".cuadro");
var currentWordIndex = 0;
var palabrasAcertadas = 0;
var palabrasIncorrectas = 0;
var totalPalabras = 10;

function reproducirAudio(sonido) {
    var audio = new Audio("../audios/" + sonido + ".wav");
    audio.play();
    setTimeout(function () {
    audio.pause();
    audio.currentTime = 0;
    }, 5000);
}
function verificarPalabra(palabra) {
    console.log("Palabra a verificar:", palabra);

    for (const automata of automatas) {
        const { palabra: palabraAymara, automata: automataFinito } = automata;
        console.log("Palabra Aymara válida:", palabraAymara);
        //let estadoActual = automataFinito.currentState;
        //console.log("Estado actual del autómata:", estadoActual);
        for (let i = 0; i < palabra.length; i++) {
            const letter = palabra[i];
            //console.log("Letra actual:", letter);
            //const transitionResult = automataFinito.transition(letter);
            //console.log("¿Transición exitosa?", transitionResult);
            //console.log("Nuevo estado del autómata:", automataFinito.currentState);
        }
        const esAceptada = automataFinito.isAccepted();
        console.log("¿Es aceptada por el autómata?", esAceptada);

        if (palabra.toUpperCase() === palabraAymara) {
            palabrasAcertadas++;
            //console.log("PALABRAS CORRECTAS: "+palabrasCorrectas);
            console.log(`La palabra '${palabra}' es válida en Aymara.`);
            imagenSrc = "../image/victory.gif";
            mensaje = `¡Waliki!`;
            reproducirAudio("correcto"); 

            mostrarMensajeFeedback(mensaje, imagenSrc, "green", 3000);
            document.getElementById("palabrasAcertadasInput").value =
            palabrasAcertadas;
            document.getElementById("correctas").innerText = palabrasAcertadas;
            document.getElementById("sig").disabled = false;
            return true;
        }
    }
    palabrasIncorrectas++;
    //console.log("PALABRAS INCORRECTAS: " + palabrasIncorrectas);
    //document.getElementById("equivocadas").innerHTML = palabrasIncorrectas;
    imagenSrc = "../image/triste.gif";
    mensaje = `¡Janiw walikiti!`;
    reproducirAudio("incorrecto");
    mostrarMensajeFeedback(mensaje, imagenSrc, "red", 3000);
    //console.log(`La palabra '${palabra}' no es válida en ningún autómata.`);
    document.getElementById("equivocadas").innerText = palabrasIncorrectas;
    document.getElementById("sig").disabled = false;
    return false;
}

function mostrarPalabraActual() {
    var currentWord = palabras[currentWordIndex];
    document.getElementById("spanishWord").innerText = currentWord.castellano;
    var mixedLetters = shuffle(currentWord.aymara.toUpperCase());

    var letterDivs = mixedLetters
        .split("")
        .map(
            (letter) =>
                '<div class="letterBox" draggable="true" ondragstart="drag(event)">' +
                letter +
                "</div>"
        )
        .join("");
    document.getElementById("mixedLetters").innerHTML = letterDivs;
    document.getElementById("verificarButton").disabled = false;
}

function siguientePalabra() {
    // Incrementar el índice de la palabra actual
    currentWordIndex++;

    // Verificar si el índice supera el límite superior (número total de palabras)
    if (currentWordIndex >= palabras.length) {
        document.getElementById("mensajeF").style.display = "block";
        document.getElementById("cuadro").style.display = "none";
        var correc = document.getElementById("correctasF");
        var cant = document.getElementById("cantidadArray");
        correc.textContent = palabrasAcertadas;
        cant.textContent = palabras.length;
        document.getElementById("correctas").innerText = palabrasAcertadas;

        actualizarInsignia();
    } else {
        var currentWord = palabras[currentWordIndex];

        document.getElementById("dropBox").innerHTML = "";
        document.getElementById("spanishWord").innerText = currentWord.castellano;
        console.log("palabras castellano: " + currentWord.castellano);
        console.log("siguiente palabra: " + currentWord.aymara);
        mostrarLetrasMezcladas(currentWord.aymara.toUpperCase());
        //desabilitar el boton de siguiente
        document.getElementById("sig").disabled = true;
        document.getElementById("sig").classList.add("sig");
    }
}
var vecesJugadas = 1;

function reiniciarJuego() {
    palabrasAcertadas = 0;
    palabrasIncorrectas = 0;
    currentWordIndex = 0;

    document.getElementById("palabrasAcertadasInput").value = palabrasAcertadas;
    console.log("indice actual: " + currentWordIndex);
    mostrarPalabraActual();

    vecesJugadas++;
    console.log("veces jugadas: " + vecesJugadas);
    document.getElementById("vecesJugadasInput").value = vecesJugadas;

    document.getElementById("correctas").innerText = palabrasAcertadas;
    document.getElementById("equivocadas").innerText = palabrasIncorrectas;
    document.getElementById("palabrasAcertadasInput").value = palabrasAcertadas;

    document.getElementById("mensajeF").style.display = "none";
    document.getElementById("cuadro").style.display = "block";
    document.getElementById("dropBox").innerHTML = "";

    localStorage.setItem("vecesJugadas", vecesJugadas);
}

function mostrarLetrasMezcladas(letters) {
    var mixedLetters = shuffle(letters);
    document.getElementById("mixedLetters").innerHTML = mixedLetters
        .split("")
        .map(
            (letter) =>
                '<div class="letterBox" draggable="true" ondragstart="drag(event)">' +
                letter +
                "</div>"
        )
        .join("");
}

function mostrarMensajeFeedback(mensaje, imagenSrc, color, duracion) {
    var mensajeFeedback = document.getElementById("mensajeFeedback");
    var feedbackImage = document.getElementById("feedbackImage");
    var feedbackMessage = document.getElementById("feedbackMessage");
    feedbackImage.src = imagenSrc;
    feedbackMessage.textContent = mensaje;
    feedbackMessage.style.color = color;
    mensajeFeedback.style.display = "block";
    containerDiv.style.display = "none";
    setTimeout(function () {
        mensajeFeedback.style.display = "none";
        containerDiv.style.display = "block";
    }, duracion);
}

function drag(ev) {
    var letter = ev.target.innerText;
    ev.dataTransfer.setData("text", letter);
    ev.target.style.opacity = "0.4";
}

//Soltar una letra
function drop(ev) {
    ev.preventDefault();
    var letter = ev.dataTransfer.getData("text");
    //console.log("Letra soltada:", letter);
    ev.target.innerHTML += '<div class="letterBox">' + letter + "</div>";
    // mixedLetters = mixedLetters.replace(letter, '');
    // document.getElementById("mixedLetters").innerHTML = mixedLetters.split('').map(letter => '<div class="letterBox" draggable="true" ondragstart="drag(event)">' + letter + '</div>').join('');
}

function allowDrop(ev) {
    ev.preventDefault();
}

document.getElementById("sig").addEventListener("click", siguientePalabra);
//  botón de verificación
document
    .getElementById("verificarButton")
    .addEventListener("click", function () {
        var palabraEstudiante = document
            .getElementById("dropBox")
            .innerText.trim()
            .toUpperCase(); // Aquí se obtiene la palabra ingresada por el estudiante
        verificarPalabra(palabraEstudiante);
    });

// Obtener una palabra aleatoria de la lista
var randomIndex = Math.floor(Math.random() * palabras.length);
var currentWord = palabras[randomIndex];

// Mostrar la palabra en castellano en pantalla
document.getElementById("spanishWord").innerText = currentWord.castellano;

// Mezclar las letras de la palabra en aymara
var mixedLetters = shuffle(currentWord.aymara.toUpperCase());

// Función para mezclar letras
function shuffle(word) {
    var shuffledWord = word
        .split("")
        .sort(function () {
            return 0.5 - Math.random();
        })
        .join("");
    return shuffledWord;
}

mostrarPalabraActual();
document.getElementById("dropBox").addEventListener("drop", drop);

// Asignar evento de soltar a la zona de suelta
document.getElementById("dropBox").addEventListener("dragover", function (ev) {
    ev.preventDefault();
});

function almacenarActividad(opcionNavbar, temaPracticado, juegoSeleccionado, palabrasAcertadas,vecesJugadas) {
    var medalla = localStorage.getItem("insignia");

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../datosE/almacenar_actividad.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange=function() {
        if(xhr.readyState == 4 && xhr.status == 200){
            /*console.log ('palabras acertadas : ', palabrasAcertadas);
            console.log('actividad almacenada veces jugadas:', vecesJugadas);
            
            console.log('actividad almacenada', xhr.responseText);*/
        }
    };
    
    var params ="opcion_navbar=" + encodeURIComponent(opcionNavbar) + 
                "&tema_practicado=" + encodeURIComponent(temaPracticado) + 
                "&juego_seleccionado=" + encodeURIComponent(juegoSeleccionado)+
                "&palabrasAcertadas=" + encodeURIComponent(palabrasAcertadas) +
                "&vecesJugadas=" + encodeURIComponent(vecesJugadas)+
                "&medalla="+encodeURIComponent(medalla);
    xhr.send(params);
}