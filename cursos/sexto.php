<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navb.css"> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Sexto</title>
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
            <li><a href="javascript:void(0);" onclick="cargarContenido('../gramatica/grama6to.php')">Gramatica</a></li>
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
    <div class="contenedor" id="contenedor">
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

const frasesYAutores = {
    "Q’ixu q’ixu purita patanakaruxa janiwa sarxatañäkiti, such’uptayiriwa, siwa":"Al rayo llegado no se pisa, hace enfermar y hace volver paralitico",
    "Jach’a sumirumpixa janiwa wawaruxa asxatañäkiti, t’ilirxiriw, siwa":"A un niño no se coloca sombrero grande, quedara por siempre enano", 
    "Wawaruxa janiwa phisixa q’ipnaqayañäkiti, k’umuñawa sapxiwa":"Los pequeños no deben cargar gato, porque se quedan jorobados",
    "Laka jalsutaruxa janiwa laxrampi jayt’uñäkiti, laka chhuqhuñawa, siwa":"Cuando sale el diente de leche no se lleva la lengua al lugar, los dientes salen chuecos",
    "Tumimpixa janiwa lakaru aykatasiñäkiti, jaqiru kulira chuririyatawa, siwa":"A la boca no hay que llevarse el cuchillo, si lo haces, a las personas les darás colera",
    "Pirula sartinaxa janiwa tumimpixa jirusiñäkiti, ukata uñisisiñaxa utji, siwa":"Con el cuchillo no hay que remover el sartén, sino existira odio entre la familia",
    "Uta punkuruxa janiwa qunuñäkiti, jaqiwa ina ch’usata parlasiristama ukhamarusa k’arintarakiristamwa, siwa":"En la puerta no hay que sentarse, sino la gente comentará mal de ti y te mentirá",
    "Jaqiruxa janiwa k’umiñäkiti, wawamaraki ukhamaskaspa, siwa":"A las personas no hay que juzgar, cuidado que tú hijo esté en la misma situación",
    "Jisk’a asu wawaruxa janiwa jachayañäkiti, jani ukasti lari lari laq’uwa apsusiwayaspa, siwa":"A los bebés no hay que hacer llorar, porque el ave ‘lari lari’ se puede llevar a esa criatura",
    "Anu q’uchampixa janiwa nayraru jawisiñäkiti, wali alarma katusnawa, siwa":"Con la lagaña del perro no hay que frotarse, porque si lo haces puedes ver los espiritus"
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