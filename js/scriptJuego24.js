/*2DO JUEGO 3ERO DE PRIMARIA*/

var imagenes = [
  "imagen1",
  "imagen2",
  "imagen3",
  "imagen4",
  "imagen5",
  "imagen6",
  "imagen7",
  "imagen8",
  "imagen9",
  "imagen10",
];

var palabrasAcertadas = 0;
var vecesJugadas = 1;

var indiceImagenActual = 0;
var correctas = 0;
var incorrectas = 0;
var respuestaCorrecta = false;

var containerDiv = document.querySelector(".container");
var mensajeFinalDiv = document.getElementById("mensajeFinal");

var totalPalabras = 10;

function reproducirAudio(sonido) {
  var audio = new Audio("../audios/" + sonido + ".mp3");
  audio.play();
  setTimeout(function () {
    audio.pause();
    audio.currentTime = 0;
  }, 5000);
}

// Evento click del botón de ayuda
document.getElementById("btnAyuda").addEventListener("click", function () {
  var imagenActual = imagenes[indiceImagenActual];
  switch (imagenActual) {
    case "imagen1":
      reproducirAudio("raton");
      break;
    case "imagen2":
      reproducirAudio("casa");
      break;
    case "imagen3":
      reproducirAudio("imilla");
      break;
    case "imagen4":
      reproducirAudio("noche");
      break;
    case "imagen5":
      reproducirAudio("ganado");
      break;
    case "imagen6":
      reproducirAudio("ropa");
      break;
    case "imagen7":
      reproducirAudio("rostro");
      break;
    case "imagen8":
      reproducirAudio("mirar");
      break;
    case "imagen9":
      reproducirAudio("sol");
      break;
    case "imagen10":
      reproducirAudio("oveja");
      break;
    default:
      break;
  }
});

function verificarRespuesta() {
  var imagenActual = document.getElementById(imagenes[indiceImagenActual]);
  var respuestaInput = document.getElementById("respuesta").value.toLowerCase();
  var esRespuestaCorrecta = false;
  var imagenSrc = "";
  var mensaje = "";
  // Expresiones regulares para las respuestas
  var expresiones = [];
  if (imagenActual.id === "imagen1") {
    expresiones = [{ palabra: "achaku", regex: /^achaku$/i }];
  } else if (imagenActual.id === "imagen2") {
    expresiones = [{ palabra: "uta", regex: /^uta$/i }];
  } else if (imagenActual.id === "imagen3") {
    expresiones = [{ palabra: "imilla", regex: /^imilla$/i }];
  } else if (imagenActual.id === "imagen4") {
    expresiones = [{ palabra: "aruma", regex: /^aruma$/i }];
  } else if (imagenActual.id === "imagen5") {
    expresiones = [{ palabra: "uywanaka", regex: /^uywanaka$/i }];
  } else if (imagenActual.id === "imagen6") {
    expresiones = [{ palabra: "isi", regex: /^isi$/i }];
  } else if (imagenActual.id === "imagen7") {
    expresiones = [{ palabra: "ajanu", regex: /^ajanu$/i }];
  } else if (imagenActual.id === "imagen8") {
    expresiones = [{ palabra: "untaña", regex: /^untaña$/i }];
  } else if (imagenActual.id === "imagen9") {
    expresiones = [{ palabra: "inti", regex: /^inti$/i }];
  } else if (imagenActual.id === "imagen10") {
    expresiones = [{ palabra: "iwija", regex: /^iwija$/ }];
  } else {
    imagenActual.id === "gifFinal";
    vecesJugadas++;
    console.log("veces jugadas: " + vecesJugadas);
  }
  for (var i = 0; i < expresiones.length; i++) {
    //console.log(`Palabra ingresada: ${respuestaInput}, Palabra esperada: ${expresiones[i].palabra}`);
    if (expresiones[i].regex.test(respuestaInput)) {
      esRespuestaCorrecta = true;
      break;
    }
  }
  if (!esRespuestaCorrecta) {
  }

  if (esRespuestaCorrecta) {
    imagenSrc = "../image/victory.gif";
    mensaje = "¡Waliki!";
    reproducirAudio("correcto");
    correctas++;
    document.getElementById("correctas").innerHTML = correctas;
    document.getElementById("btnSiguiente").disabled = false;
    palabrasAcertadas++;
    document.getElementById("palabrasAcertadasInput").value = palabrasAcertadas;
    console.log("palabras acertadas:" + palabrasAcertadas);

    document.getElementById("respuesta").disabled = true;

    mostrarMensajeFeedback(mensaje, imagenSrc, "green", 3000);
    //siguienteImagen();
  } else {
    imagenSrc = "../image/triste.gif";
    mensaje = "¡Janiw walikiti!";
    /*REPRODUCIR AUDIO*/
    reproducirAudio("incorrecto");
    incorrectas++;
    document.getElementById("equivocadas").innerHTML = incorrectas;
    document.getElementById("btnSiguiente").disabled = false;
    mostrarMensajeFeedback(mensaje, imagenSrc, "red", 4000);
  }
  document.getElementById("respuesta").disabled = false;
  document.getElementById("respuesta").value = "";
}

function siguienteImagen() {
  var cantidad = document.getElementById("cantidad");

  cantidad.textContent = indiceImagenActual + 1 + 1 + " / " + imagenes.length;

  indiceImagenActual++;

  if (indiceImagenActual === imagenes.length) {
    document.getElementById("resultado").style.display = "none";

    containerDiv.style.display = "none";

    // Mostrar el div de mensajeFinal
    mensajeFinalDiv.style.display = "block";
    var correc = document.getElementById("correctasF");
    var cant = document.getElementById("cantidadArray");
    correc.textContent = correctas;
    cant.textContent = imagenes.length;
    actualizarInsignia();
    // Quitar la clase "hidden" del elemento de la imagen GIF
    //document.getElementById("gifFinal").classList.remove("hidden");
    document.getElementById("verificar").style.display = "none";
    document.getElementById("respuesta").style.display = "none";
    document.getElementById("btnAyuda").style.display = "none";
    document.getElementById("btnSiguiente").style.display = "none";
    document.getElementById("cantidad").style.display = "none";
  } else {
    // Ocultar todas las imágenes
    document.querySelectorAll("img").forEach(function (img) {
      img.classList.add("hidden");
    });
    //desabilitar el boton de siguiente
    document.getElementById("btnSiguiente").disabled = true;
    document.getElementById("btnSiguiente").classList.add("btn1");
    // Mostrar la imagen actual
    document
      .getElementById(imagenes[indiceImagenActual])
      .classList.remove("hidden");

    // Limpiar el campo de respuesta y el resultado anterior
    document.getElementById("respuesta").value = "";
    document.getElementById("resultado").textContent = "";

    document.getElementById("feedbackImage").style.display = "block";
  }
}
function volverEmpezar() {
  indiceImagenActual = 0;
  palabrasAcertadas = 0;
  correctas = 0;
  incorrectas = 0;
  respuestaCorrecta = false;

  // Actualizar la visualización de los elementos necesarios
  document.getElementById("cantidad").textContent = "1/" + imagenes.length;
  containerDiv.style.display = "block";
  mensajeFinalDiv.style.display = "none";
  //document.getElementById("gifFinal").classList.add("hidden");
  document.getElementById("verificar").style.display = "flex";
  document.getElementById("respuesta").style.display = "flex";
  document.getElementById("btnAyuda").style.display = "block";
  document.getElementById("btnSiguiente").style.display = "flex";
  document.getElementById("cantidad").style.display = "block";

  document.getElementById("palabrasAcertadasInput").value = "0";

  // Mostrar la primera imagen
  document.querySelectorAll("img").forEach(function (img) {
    img.classList.add("hidden");
  });
  document.getElementById(imagenes[0]).classList.remove("hidden");

  // Limpiar el campo de respuesta y el resultado anterior
  document.getElementById("respuesta").value = "";
  document.getElementById("feedbackImage").style.display = "none";
  document.getElementById("correctas").innerHTML = "";
  document.getElementById("equivocadas").innerHTML = "";

  // Reiniciar el contador de veces jugadas
  vecesJugadas++;
  console.log("veces jugadas: " + vecesJugadas);
  document.getElementById("vecesJugadasInput").value = vecesJugadas;

  localStorage.setItem("vecesJugadas", vecesJugadas);
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

function actualizarInsignia() {
  let insignia = "ninguna";
  var med = document.getElementById("medalla");
  // Determinar qué insignia mostrar
  if (correctas === totalPalabras) {
    insignia = "oro";
    console.log("Oro: " + correctas);
    med.textContent = insignia;
  } else if (correctas >= totalPalabras * 0.8) {
    insignia = "plata";
    console.log("plata: " + correctas);
    med.textContent = insignia;
  } else if (correctas >= totalPalabras * 0.5) {
    insignia = "bronce";
    console.log("bronce: " + correctas);
    med.textContent = insignia;
  }

  // Almacenar la información de la insignia en localStorage
  localStorage.setItem("insignia", insignia);
  console.log("insignia: " + insignia);

  // Obtener el contenedor de la insignia
  const insigniaContainer = document.querySelector(".insignia-container");

  // Limpiar el contenedor
  insigniaContainer.innerHTML = "";

  // Crear la imagen de la insignia y añadirla al contenedor
  if (insignia != "ninguna") {
    const insigniaImg = document.createElement("img");
    insigniaImg.src = `../image/insignia_${insignia}.png`;
    insigniaImg.alt = `${insignia}`;
    insigniaImg.classList.add("insignia");
    insigniaContainer.appendChild(insigniaImg);
  }
}

window.onload = function () {
  const estadoInsignia = localStorage.getItem("insignia");
  if (estadoInsignia) {
    actualizarInsignia(estadoInsignia);
  }
};

function almacenarActividad(
  opcionNavbar,
  temaPracticado,
  juegoSeleccionado,
  palabrasAcertadas,
  vecesJugadas
) {
  var medalla = localStorage.getItem("insignia");

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../datosE/almacenar_actividad.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      console.log("palabras acertadas : ", palabrasAcertadas);
      console.log("actividad almacenada veces jugadas:", vecesJugadas);
      console.log("actividad almacenada", xhr.responseText);
    }
  };

  var params =
    "opcion_navbar=" +
    encodeURIComponent(opcionNavbar) +
    "&tema_practicado=" +
    encodeURIComponent(temaPracticado) +
    "&juego_seleccionado=" +
    encodeURIComponent(juegoSeleccionado) +
    "&palabrasAcertadas=" +
    encodeURIComponent(palabrasAcertadas) +
    "&vecesJugadas=" +
    encodeURIComponent(vecesJugadas) +
    "&medalla=" +
    encodeURIComponent(medalla);
  xhr.send(params);
}
