const saludos = [
    { pregunta: "Aski urukipana : Buenos días", respuesta: "Aski urukipanaya" },
    {pregunta: "Kamiraraki? : ¿como estás?", respuesta: ["Waliki", "Janiwa Waliki"]},
    {pregunta: "Jichhuru anatana arum tanaka: hoy practicaremos los saludos", respuesta:["bien", "esta bien","por supuesto","claro"]},
    {pregunta: "Como dirias buenos días mamá?", respuesta:"Aski urukipana mama"},
    {pregunta: "Ahora como responderias a un saludo de buenas tardes en aimara", respuesta:"Aski jayp'ukipanaya"},
    {pregunta: "Son las 20:00 como saludarias a esa hora?", respuesta:"Aski arumakipana"},
    {pregunta: "Como dirias buenas tardes amig@", respuesta:"aski jayp'ukipana masi"},
    {pregunta: "traduce las siguientes oraciones"},
    {pregunta: "buenas noches abuelo", respuesta:"aski arumakipana achachila"},
    {pregunta: "Aski jayp'ukipana kullaka", respuesta:"buenas tardes hermana"},
];

let indicePreguntaActual = 0;
let palabrasAcertadas = 0;

let respuestaIncorrectaMostrada = false; // Variable para rastrear si se ha mostrado una respuesta incorrecta

let ultimaRespuestaCorrecta = '';

let vecesJugadas = 1;

function procesarRespuesta(respuestaUsuario) {
    const preguntaActual = saludos[indicePreguntaActual];
    const respuestaUsuarioLimpia = respuestaUsuario.trim().toLowerCase();

    console.log("Pregunta actual:", preguntaActual);
    console.log("Respuesta del usuario:", respuestaUsuarioLimpia);

    if (preguntaActual) {
        // Verificar si la respuesta del usuario coincide con alguna de las opciones de respuesta
        if (Array.isArray(preguntaActual.respuesta)) {
            const respuestaCorrecta = preguntaActual.respuesta.map(r => r.toLowerCase());
            if (respuestaCorrecta.includes(respuestaUsuarioLimpia)) {
                // Respuesta correcta
                if (respuestaUsuarioLimpia !== ultimaRespuestaCorrecta) {
                    palabrasAcertadas++;
                    document.getElementById("palabrasAcertadasInput").value = palabrasAcertadas;
                    agregarMensaje("", "✔️");
                    ultimaRespuestaCorrecta = respuestaUsuarioLimpia;
                    // Mostrar la siguiente pregunta
                    indicePreguntaActual++;
                    if (indicePreguntaActual < saludos.length) {
                        const siguientePregunta = saludos[indicePreguntaActual];
                        agregarMensaje("Sistema", siguientePregunta.pregunta, "sist");
                    } else {
                        agregarMensaje("Sistema", "¡Fin del juego!", "sist");
                    }
                } else {
                    agregarMensaje("", "Revisa tu respuesta por favor", "bubble-error");
                }
            } else {
                // Respuesta incorrecta
                agregarMensaje("", "Revisa tu respuesta por favor", "bubble-error");
            }
        } else {
            // Respuesta única
            const respuestaCorrecta = preguntaActual.respuesta.toLowerCase();
            if (respuestaUsuarioLimpia === respuestaCorrecta) {
                // Respuesta correcta
                if (respuestaUsuarioLimpia !== ultimaRespuestaCorrecta) {
                    palabrasAcertadas++;
                    document.getElementById("palabrasAcertadasInput").value = palabrasAcertadas;
                    agregarMensaje("", "✔️");
                    ultimaRespuestaCorrecta = respuestaUsuarioLimpia;
                    // Mostrar la siguiente pregunta
                    indicePreguntaActual++;
                    if (indicePreguntaActual < saludos.length) {
                        const siguientePregunta = saludos[indicePreguntaActual];
                        agregarMensaje("Sistema", siguientePregunta.pregunta, "sist");
                    } else {
                        agregarMensaje("Sistema", "¡Fin del juego!", "sist");
                    }
                } else {
                    agregarMensaje("", "Revisa tu respuesta por favor", "bubble-error");
                }
            } else {
                // Respuesta incorrecta
                agregarMensaje("", "Revisa tu respuesta por favor", "bubble-error");
            }
        }
    } else {
        console.error("La pregunta actual está indefinida.");
    }
}



// Función para enviar la respuesta del usuario
function enviarRespuesta() {
    const userInput = document.getElementById("user-input").value.trim();
    if (userInput !== "") {
        // Agregar el mensaje del usuario al chat
        agregarMensaje("Tú", userInput);
        // Limpiar el campo de entrada
        document.getElementById("user-input").value = "";
        // Procesar la respuesta del usuario
        procesarRespuesta(userInput);
    }
}

function agregarMensaje(usuario, mensaje, clase) {
    const chatMessages = document.getElementById("chat-messages");
    const messageDiv = document.createElement("div");
    messageDiv.innerHTML = mensaje;
    
    // Si el mensaje es del usuario o es la confirmación, alinea a la derecha
    if (usuario === "Tú" || usuario === "") {
        messageDiv.classList.add("align-right");
    }
    
    if (usuario) { // Verificar si se proporcionó un usuario
        messageDiv.innerHTML = `<strong>${usuario}:</strong> ${mensaje}`;
    }
    if (clase) { // Verificar si se proporcionó una clase
        messageDiv.classList.add(clase); // Agregar la clase al mensaje
    }
     // Agregar la clase de fondo de respuesta si corresponde
    if (usuario === "Tú") {
        messageDiv.classList.add("response-background");
    }

    chatMessages.appendChild(messageDiv);
    // Hacer scroll hacia abajo para mostrar el último mensaje
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function confirmarSalir() {
    if (confirm("¿Estás seguro de salir del chat?")) {
        mostrarRespuestasCorrectas();
        almacenarActividad('Gramatica', 'Saludos', 'Responde a los saludos', palabrasAcertadas, vecesJugadas);
        alert("Jikisinkama : Hasta pronto");
    }
}

// Función para mostrar la cantidad de respuestas correctas
function mostrarRespuestasCorrectas() {
    console.log(palabrasAcertadas);
}
// Ejemplo: Agregar la primera pregunta al chat
agregarMensaje("Sistema", saludos[indicePreguntaActual].pregunta, "sist");

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