<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navb.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Quinto</title>
</head>
<body>
<!--<h1>CURSO TERCERO DE PRIMARIA</h1>-->  
<!--DISEÑO DEL NAVBAR-->

<header class="header">
    <div class="logo"><?php include('../datosE/datosE.php'); ?></div>
    <input type="checkbox" id="toggle">
    <label for="toggle"><img class="menu" src="../image/menu.svg" alt="menu"></label>

    <nav class="navigation">
        <ul>
            <li><a href="#">Uta</a></li>
            <li><a href="javascript:void(0);" onclick="cargarContenido('../gramatica/grama5to.php')">Gramatica</a></li>
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
    <div class="contenedor" >
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
            <h1 id="frase" class="frases">hola</h1>
            <hr>
            <h2 id="traduccion">mensaje</h2>
        </div>
    
</div>

<script src="../js/cuarto.js"></script>

<script>

    /*FRASES DE LA PANTANTALLA PRINCIPAL*/
    const frasesYAutores = {
        "Jach’a tatanakaruxa janiwa jachayañäkiti, lliphu q’arawa jiwsnaxa":"A los abuelos no hay que hacer llorar, se muere sin nada",
        "Wawa isixa janiwa wasara arumaru aparpayañäkiti, wawawa jachiri":"En la noche no se deja afuera la ropa del bebé, sabe llorar el angelito",
        "Kumiruxa janiwa jak’achasiñäkiti, silima umwa mantasiri, siwa":"Al arco iris no se debe acercar, una misteriosa agua te provocara una enfermedad",
        "Umatxa janiwa jark’asiñäkiti, yuspajarasiñäakisa, jani ukasti umawa apasiri, siwa":"Del agua no hay que atajarse, ni hay que agradecer de ella, si lo haces te llevará el agua",
        "Ch’iyara phisixa janiwa utjawiruxa uywasiñäkiti, jani ukasti yanqhampiwa aruskipiri pitthapiñataki, siwa":"En la casa  no hay que criar un gato de color negro, porqué éste habla con el demonion para destruir el hogar",
        "Jichha chhuyu jaqichasiri utaruxa janiwa anuxa uywasiñäkiti, jani ukasti malawirana sarnaqatiri, siwa":"La  pareja de recién casados no debe críar perros, porque sus vidas serán malas y conflictivas",
        "Wawanakaruxa janiwa uñisiñäkiti, khuchikiwa uñisixa wawanakaparuxa siwa":"A los hijos no hay que odiar, porque los cerdos no más odian a sus crías",
        "Wawasinxa janiwa muquxa manq’añäkiti, sapa muquru mañaniñawa":"Siendo niño no se come presas enteras de carne, porque se malcría",
        "Imilla wawanxa janiwa lluquxa manq’añäkiti, janiwa ususiña yatipxirikiti, siwa":"Las chicas no deben comer el corazón, para no tener problemas de parto",
        "Usuri warmisinxa janiwa ch’ankhaxa khiwiñäkiti, wawana kururupawa muyuntasiri, siwa":"Siendo embarazada no se debe ovillar, porque el cordón umbilical queda envuelto al feto"
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