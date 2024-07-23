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
    {word:"PHUKHU", hint: "En mi vientre cuezo guisos, sopas y caldos. Soy redonda y con tapa, ¿quién soy?"},
    {word:"Q'UNCHA", hint: "Lugar en la casa donde hay hornos y fogones, allí se preparan deliciosos manjares y condimentos."},
    {word:"PUNKU", hint: "De madera o de hierro, te abro paso al entrar y al salir, me cierras para privacidad."},
    {word:"CHUWA", hint: "Redondo como el sol, en la mesa tiene su lugar, sostiene la comida para que la puedas disfrutar."},
    {word:"PICHAÑA", hint: "Tengo cerdas en mi cabeza y un palo como cuerpo, limpio el suelo con destreza, dejando todo perfecto."},
    {word:"LIRPHU", hint: "Siempre te digo la verdad, aunque a veces no te guste, me miras cada mañana, ¿quién soy?"},
    {word:"PIQAÑA", hint: "Piedra con piedra, así se muele, ajíes y condimentos, mi fuerza deshace."},
    {word:"IKIÑA", hint: "Lugar donde sueñas y descansas sin cesar, entre sábanas y almohadas, te gusta descansar."},
    {word:"JARUCHINAKA", hint: "De cerámica o porcelana, a veces con asas, en mi cuerpo llevas bebidas, café o té en las mañanas."},
    {word:"TARWA", hint: "De las ovejas me obtienen, suave y caliente soy. En invierno te abrigo, ¿quién soy yo?"}
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
    //console.log("veces Jugadas: "+vecesJugadas);
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

