<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navb.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Cuarto</title>
</head>
<body>
<!--<h1>CURSO CUARTO DE PRIMARIA</h1>-->  
<!--DISEÑO DEL NAVBAR-->

<header class="header">
    <div class="logo"><?php include('../datosE/datosE.php'); ?></div>
    <input type="checkbox" id="toggle">
    <label for="toggle"><img class="menu" src="../image/menu.svg" alt="menu"></label>

    <nav class="navigation">
        <ul>
            <li><a href="#">Uta</a></li>
            <li><a href="javascript:void(0);" onclick="cargarContenido('../gramatica/grama4to.php')">Gramatica</a></li>
            <li><a href="#">Entretenimiento</a>
                <ul>
                    <li href="#"><a>Adivinanzas</a></li>
                    <li><a href="#">Trabalenguas</a></li>
                    <li><a href="#">Cuentos</a></li>
                    <li><a href="#">Canciones</a></li>
                </ul>
            </li>
            <li><a href="../entretenimiento/verbos.html">Verbos</a>
            <li><a href="#">Datos</a>
                <ul>
                    <li><a href="#">Ver perfil</a></li>
                    <li><a href="#">Editar</a></li>
                    </li>
                </ul>
            </li>
            
            </li>
            <li><a href="../datosE/cerrarE.php"><i class='bx bxs-left-arrow-square bx-sd bx-fade-left-hover'></i>Salir</a></li>
        </ul>
    </nav>
</header>

<div id="contenido" class="contenido">
    <div class="contenedor">
        <div class="mensaje">S</div>
        <div class="mensaje">Ä</div>
        <div class="mensaje">W</div>
        <div class="mensaje">I</div>
        <div class="mensaje">N</div>
        <div class="mensaje">A</div>
        <div class="mensaje">K</div>
        <div class="mensaje">A</div>
        
    </div>
    <div class="frases">
        <h1 id="frase" class="frases">HOLA</h1>
        <hr>
        <h2 id="traduccion">mensaje</h2>
    </div>
</div>


<script src="../js/cuarto.js"></script>

<script>
    /*FRASES DE LA PANTANTALLA PRINCIPAL*/
    const frasesYAutores = {
        "Jisk’a laq’unakaxa janiwa usuchjañäkiti, t’iwkhasiriwa, siwa":"A los animales pequeños no hay que lastimar porque te hara sufrir en la vida",
        "Achuxa janiwa warnaqañäkiti, ukatawa mach’amarasa jutiri, siwa":"Los frutos no se echa a perder, por eso viene los malos tiempos",
        "Urukamaxa janiwa ikiñäkiti, walja wawaniñawa, siwa":"Hasta tarde no se duerme, te puedes cargar de familia",
        "Ch’ankharaxa janiwa maq’añäkiti, llajllañawa sapxiwa":"Los páncreas no se comen, puedes ser temeroso",
        "Ch’uqi pataruxa janiwa q’arakayuki sarxañäkiti, itäwisiriwa, siwa":"A la papa no se pisa con pie descalzo, te dolerá por siempre la plantilla del pie",
        "Uywa jiphillaxa janiwa phusañäkiti, uywa illawa phusanukuña, siwa":"Las tripas de los animales muertos no se soplan , se despacha las bendiciones para tener más animales",
        "Laxra tukuyaxa janiwa manq’añäkiti, laka ch’akhañawa, siwa":"La punta de la lengua no se come, porque puedes hablar malas palabras",
        "Tumayku tawaqumpi, tumayku waynampIxa janiwa sarnaqañäkiti, ukhamaraki tukqhasma":"Con hombres y mujeres vagabundos no se camina, puedes ser como ellos",
        "Uywanakaruxa janiwa uñisiñäkiti, uywaxa jachjasiriwa, siwa":"A los animales no se odia, suelen llorar maldiciendo"
        };

            // Función para seleccionar aleatoriamente una frase y traduccion
            const seleccionarFraseYAutorAleatoriamente = () => {
                // Extrae las claves (frases) del objeto frasesYAutores en un array
                const frases = Object.keys(frasesYAutores);
                // Selecciona aleatoriamente una frase del array de frases
                const fraseAleatoria = frases[Math.floor(Math.random() * frases.length)];
                const autorCorrespondiente = frasesYAutores[fraseAleatoria];
                return {
                    frase: fraseAleatoria,
                    autor: autorCorrespondiente
                };
            };

            // Función para actualizar el contenido de los elementos <h1> y <h2> con una frase y su autor correspondiente
            const actualizarFraseYAutor = () => {

                const { frase, autor } = seleccionarFraseYAutorAleatoriamente();

                document.getElementById("frase").textContent = frase;
                document.getElementById("traduccion").textContent = autor;
            };

            actualizarFraseYAutor();

    /*CARGAR LA INFORMACION DE LO QUE ESCOGE EL ESTUDIANTE*/
    function cargarContenido(url) {
    console.log('Cargando contenido desde:', url);
    var contenido = document.getElementById('contenido');

    // Realizar una solicitud AJAX para cargar el contenido de la página
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            contenido.innerHTML = xhr.responseText;
        }
    };
    xhr.send();
    return false; // Evita que el enlace cambie la URL
}

document.querySelectorAll('.header .navigation ul li a').forEach(item => {
        item.addEventListener('click', () => {
            document.getElementById('toggle').checked = false;
        });
    });
</script>
</body>
</html>