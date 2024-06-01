class Automata {
    constructor(word) {
        this.word = word.toUpperCase();
        this.currentState = 0;
        this.finalState = word.length;
        this.transitionsLog = []; //registro de transiciones
    }
    transition(letter) {
        if (this.currentState < this.finalState && letter.toUpperCase() === this.word[this.currentState]) {
            this.transitionsLog.push({
                from: this.currentState,
                to: this.currentState + 1,
                letter: letter.toUpperCase()
            });
            this.currentState++;
            return true;
        }
        return false;
    }
    isAccepted() {
        return this.currentState === this.finalState;
    }

    getTransitionsLog() {
        return this.transitionsLog || []; 
    }
}

const words = [
    {word:"URPU", hint: "Pueden traer lluvia, nieve o simplemente dar sombra al sol"},
    {word:"ANU", hint: "Le gusta jugar, correr y ladrar"},
    {word:"ISPILLU", hint: "Es la parte de la boca que usamos para hablar"},
    {word:"IKIÑA", hint: "Es lo que hacemos por la noche para descansar"},
    {word:"ULLAÑA", hint: "Podemos leer cuentos, poemas o información interesante"},
    {word:"AMPARA", hint: "La usamos para agarrar, sostener y tocar cosas"},
    {word:"ILLAPA", hint: "Puedes verlo y oírlo durante una tormenta"},
    {word:"AYCHA", hint: "Puede ser de vaca, pollo o cerdo"},
    {word:"ACHILA", hint: "Es el papá de tu papá o mamá"},
    {word:"AWICHA", hint: "Es la mamá de tu papá o mamá"}
];

let automata;
let remainingAttempts;
let correctWords=0;
let wrongWords=0;
let palabraActualIndex=0;
let ultimaPalabraIndex=-1;
let palabrasJugadas=1; 

var palabrasAcertadas=0;
var vecesJugadas=1
var contenedorDiv = document.querySelector("#contenedor");
var despedidaDiv = document.getElementById("despedida");

var totalPalabras = 10;


function obtenerNuevaPalabra(){
    let newIndex = ultimaPalabraIndex + 1;
    if(newIndex >=words.length){
        newIndex=0;
    }
    ultimaPalabraIndex = newIndex;
    return words[newIndex];
}

function initGame() {
    /*const randomIndex = Math.floor(Math.random() * words.length);
    const wordData = words[randomIndex];*/
    const wordData=obtenerNuevaPalabra();
    automata = new Automata(wordData.word);
    remainingAttempts = 5;
    
    document.getElementById("hint").innerText = " " + wordData.hint;
/* document.getElementById("word").innerHTML= getDisplayedWord();*/
    document.getElementById("attempts").innerText = remainingAttempts;
    document.getElementById("message").innerText = "";

    document.getElementById("letterInput").focus();

    displayWord();    
}

const letterInput = document.getElementById("letterInput");
letterInput.addEventListener("input", function(){
    checkLetter();
});

function checkLetter() {
    const letter=letterInput.value;
    const mensaje="Letra incorrecta " +letter;

    if (!letter || letter.length !== 1 || !letter.match(/[KkKHkhK\'k\'QqQHqh\'Q\'q\'CHchCHHchhCH\'ch\'PpPHphP\'p\'TtTHthT\'t\'MmNnÑñLlLLllJjXxRrSsYyWwAaÄäUuÜüIiÏï]/)) {
        alert("La letra ingresada no es válida en el alfabeto aimara: "+letter);
        letterInput.value="";
        return;
    }

    if (!automata.transition(letter)) {
        remainingAttempts--;
        document.getElementById("message").innerText = mensaje;
        document.getElementById("message").style.color="red";
    }else{
        document.getElementById("message").innerText = ""
    }

    letterInput.value="";

    if (automata.isAccepted()){
        correctWords++;
        document.getElementById("correctas").innerText=correctWords;
    }

    if (remainingAttempts===0 && !automata.isAccepted()){
        wrongWords++;
        document.getElementById("equivocadas").innerText=wrongWords;    
    }


    document.getElementById("word").innerText = getDisplayedWord();
    document.getElementById("attempts").innerText = remainingAttempts;
    document.getElementById("letterInput").focus();

    if (automata.isAccepted()) {

        document.getElementById("message").innerText = "¡Felicidades, has adivinado la palabra!";
        document.getElementById("message").style.color="green";
        palabrasAcertadas++;
        document.getElementById("palabrasAcertadasInput").value=palabrasAcertadas;
        

        document.getElementById("letterInput").blur();
    } else if (remainingAttempts === 0) {
        document.getElementById("message").innerText = "¡Has agotado tus intentos! La palabra era: " + automata.word;
        document.getElementById("message").style.color="blue";
        document.getElementById("letterInput").blur();
    }

    displayWord();
    logTransitions();
}


function getDisplayedWord() {
    let displayedWord = "";
    for (let i = 0; i < automata.word.length; i++) {
        if (i <automata.currentState ) {
            displayedWord +=`<div class="letter-box">${automata.word[i]}</div>`;
        } else {
            displayedWord += `<div class="letter-box"></div>`;
        }
    }
    return displayedWord;
}
function displayWord() {
    const wordContainer = document.getElementById("word");
    wordContainer.innerHTML = ""; 
    
    for (let i = 0; i < automata.word.length; i++) {
        const letterBox = document.createElement("div");
        letterBox.classList.add("letter-box");
        if (i < automata.currentState) {
            letterBox.textContent = automata.word[i];
        }
        wordContainer.appendChild(letterBox);
    }
}

/*funcion para generar una nueva palabra*/

function newWord(){

    const wordData = obtenerNuevaPalabra();

    automata = new Automata(wordData.word);
    palabrasJugadas++;
    /*console.log("PALABRAS JUGADAS: "+palabrasJugadas);*/

    /*console.log("ultima posicion del array: "+ultimaPalabraIndex);*/

    /*palabraActualIndex = randomIndex;
    console.log(palabraActualIndex);*/
    var cantidad=document.getElementById('cantidad');
    cantidad.textContent=(palabrasJugadas) +' / ' + words.length;

    /*console.log("Cantidad de palabras: "+cantidad.text);*/

    document.getElementById("hint").innerText=" "+wordData.hint;
    document.getElementById("message").innerText="";
    remainingAttempts=5;
    document.getElementById("attempts").innerText=remainingAttempts;
    document.getElementById("letterInput").focus();

    displayWord();

    if (palabrasJugadas === words.length+1){
        /*console.log("CANTIDAD DE VECES QUE JUGO EL JUEGO: "+vecesJ);*/
        mostrarMensajeJuegoTerminado();
        actualizarInsignia();
    }
}

function logTransitions() {
    const transitionsLog = automata.getTransitionsLog();
    console.clear(); // Limpiar la consola para cada nuevo log
    console.log("Transiciones realizadas:");
    transitionsLog.forEach(transition => {
        console.log(`De estado ${transition.from} a ${transition.to} con letra '${transition.letter}'`);
    });
}

function mostrarMensajeJuegoTerminado(){
    var despedida=document.getElementById('despedida')
    var contenedor=document.getElementById('contenedor');
    contenedor.style.display="none";
    despedida.style.display="block";
    console.log("PALABRAS CORRECTAS "+correctWords);
    var correctas= document.getElementById('correctasF');
    var cant = document.getElementById('cantidadArray');
    correctas.textContent=correctWords;
    cant.textContent = words.length;
    actualizarInsignia();
}

function restartGame() {
    /*console.log('boton presionado');*/
    vecesJugadas++;
    /*console.log("veces Jugadas: "+vecesJ);*/
    document.getElementById("vecesJugadasInput").value=vecesJugadas;
    localStorage.setItem("vecesJ",vecesJugadas);
    automata;
    remainingAttempts;
    correctWords=0;
    wrongWords=0;
    palabraActualIndex=0;

    palabrasJugadas=1;
    palabrasAcertadas=0;

    contenedorDiv.style.display = "block";
    despedidaDiv.style.display = "none";
    
    cantidad=document.getElementById('cantidad');
    cantidad.textContent=(palabrasJugadas) +'/' + words.length;

    document.getElementById("letterInput").focus();

    /*CONTADORES*/
    document.getElementById("correctas").innerText=correctWords;
    document.getElementById("equivocadas").innerText=wrongWords;
    document.getElementById("palabrasAcertadasInput").value=palabrasAcertadas;

}

function actualizarInsignia() {
    let insignia = 'ninguna'; // Por defecto, no hay insignia

    var med = document.getElementById('medalla');
    // Determinar qué insignia mostrar
    if (correctWords === totalPalabras) {
        insignia = 'oro';
        console.log("Oro: "+correctWords);
        med.textContent=insignia;
    } else if (correctWords >= totalPalabras * 0.8) {
        insignia = 'plata';
        console.log("plata: "+correctWords);
        med.textContent=insignia;
    } else if (correctWords >= totalPalabras * 0.5) {
        insignia = 'bronce';
        console.log("bronce: "+correctWords);
        med.textContent=insignia;
    }
    
    // Almacenar la información de la insignia en localStorage
    localStorage.setItem("insignia", insignia);
    console.log("insignia: "+insignia);
    

    // Obtener el contenedor de la insignia
    const insigniaContainer = document.querySelector('.insignia-container');
    
    // Limpiar el contenedor
    insigniaContainer.innerHTML = '';
    
    // Crear la imagen de la insignia y añadirla al contenedor
    if(insignia != 'ninguna'){
        const insigniaImg = document.createElement('img');
        insigniaImg.src = `../image/insignia_${insignia}.png`;
        insigniaImg.alt = `${insignia}`;
        insigniaImg.classList.add('insignia');
        insigniaContainer.appendChild(insigniaImg);
    }
}

window.onload = function() {
    const estadoInsignia = localStorage.getItem("insignia");
    if (estadoInsignia) {
        actualizarInsignia(estadoInsignia);
    }
};

initGame();

