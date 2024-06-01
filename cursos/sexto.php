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
                <li href="#"><a>Videos</a></li>
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