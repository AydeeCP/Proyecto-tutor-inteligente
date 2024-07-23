class Automata {
    constructor(word) {
        this.word = word.toUpperCase();
        this.currentState = 0;
        this.finalState = word.length;
    }

    transition(letter) {
        if (this.currentState < this.finalState && letter.toUpperCase() === this.word[this.currentState]) {
            this.currentState++;
            return true;
        }
        return false;
    }

    isAccepted() {
        return this.currentState === this.finalState;
    }
}

const words = [
    {word:"UQI", image:"../image/tercero/gris.png"},
    {word:"JANQ'UCH'UXÑA", image:"../image/tercero/verdeClaro.png"},
    {word:"JANQ'ULARAMA",image:"../image/tercero/celeste.png"},
    {word:"JANQ'UCH'UMPI", image:"../image/tercero/cafeClaro.png"},
    {word:"ANTI",image:"../image/tercero/rosadoClaro.png"},
    {word:"SAJUNA",image:"../image/tercero/color.png"},
    {word:"CH'IYARACH'UXÑA",image:"../image/tercero/verdeOscuro.png"},
    {word:"CH'IYARALARAMA", image:"../image/tercero/azulOscuro.png"},
    {word:"Q'ILLU", image:"../image/tercero/amarillo.png"},
    {word:"WILA", image:"../image/tercero/rojo.png"}
];

let automata;
let remainingAttempts;
let correctWords=0;
let wrongWords=0;
let palabraActualIndex=0;
let ultimaPalabraIndex=-1;
let palabrasJugadas=1; //contador de las palabras que ya jugo el estudiante

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
    document.getElementById("hint").innerHTML = `<img src="${wordData.image}" alt="Word Image" > `;

    //document.getElementById("hint").innerText = " " + wordData.hint;
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
        /*console.log("palabras acertadas: "+palabrasAc);*/

        document.getElementById("letterInput").blur();
    } else if (remainingAttempts === 0) {
        document.getElementById("message").innerText = "¡Has agotado tus intentos! El color era: " + automata.word;
        document.getElementById("message").style.color="blue";
        document.getElementById("letterInput").blur();
    }

    displayWord();
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

    document.getElementById("hint").innerHTML = `<img src="${wordData.image}" alt="Word Image">`;
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
    initGame();
    /*CONTADORES*/
    document.getElementById("correctas").innerText=correctWords;
    document.getElementById("equivocadas").innerText=wrongWords;
    document.getElementById("palabrasAcertadasInput").value=palabrasAcertadas;
}

function almacenarActividad(opcionNavbar, temaPracticado, juegoSeleccionado, palabrasAcertadas,vecesJugadas) {
    var medalla = localStorage.getItem("insignia");
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
    var params ="opcion_navbar=" + encodeURIComponent(opcionNavbar) + 
                "&tema_practicado=" + encodeURIComponent(temaPracticado) + 
                "&juego_seleccionado=" + encodeURIComponent(juegoSeleccionado)+
                "&palabrasAcertadas=" + encodeURIComponent(palabrasAcertadas) +
                "&vecesJugadas=" + encodeURIComponent(vecesJugadas)+
                "&medalla="+encodeURIComponent(medalla); 
            xhr.send(params);
}

initGame();

