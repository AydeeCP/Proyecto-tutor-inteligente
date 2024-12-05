<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/grama3.css" />
    <title>Tercero de primaria</title>
</head>
<body>
    <div class="contenido">
        <a href="#" id="startContenidoTour">Iniciar Tour del Contenido</a>
        <!--vocales-->
        <div class="vocales" onmouseover="playSound('../audios/vocales.mp3')" onmouseout="stopSound()" id="tema-vocales">
            <img src="../image/vocales.jpg" alt="image" width="250">
            <a href="#">SALLANAKA : Vocales</a>
            <ul>
                <li><a href="../juegos3ro/vocal.html">* Adivina la palabra</a></li>
                <li><a href="../juegos3ro/vocal2.html">* Adivina la imagen</a></li>
            </ul>
        </div>
        <div class="abc">
            <img src="../image/abc.jpg" alt="image" width="250">
            <a href="#">ABECEDARIO</a>
            <div class="game-abc">
                <ul>
                    <li><a href="../juegos3ro/abecedario.html">* Ordena la palabra</a></li>
                    <li><a href="../juegos3ro/abecedario1.html">* Adivina la imagen</a></li>
                </ul>
            </div>
        </div>
        <div class="color" onmouseover="playSound('../audios/colores.mp3')" onmouseout="stopSound()">
            <img src="../image/colores.jpg" alt="image" width="250">
            <a href="#">SAMINAKA : Colores</a>
            <div class="game-abc">
                <ul>
                    <li><a href="../juegos3ro/colores.html">* Adivina el color</a></li>
                    <li><a href="../juegos3ro/colores1.html">* Forma la palabra</a></li>
                </ul>
            </div>
        </div>
        <div class="familia" onmouseover="playSound('../audios/familia.mp3')" onmouseout="stopSound()">
            <img src="../image/familia.jpg" alt="image" width="250">
            <a href="#">WILA MASI : Familia</a>
            <div class="game-familia">
                <ul>
                    <li><a href="../juegos3ro/familia.html">* Identifica a la familia</a></li>
                    <li><a href="../juegos3ro/familia1.html">* Arma la Familia</a></li>
                </ul>
            </div>
        </div>
        <div class="saludo" onmouseover="playSound('../audios/saludos.mp3')" onmouseout="stopSound()">
            <img src="../image/saludo.jpg" alt="image" width="250">
            <a href="#">ARUM TANAKA : Saludos</a>
            <div class="game-saludo">
                <ul>
                    <li><a href="../juegos3ro/saludos.html">* Traduce los saludos</a></li>
                    <li><a href="../juegos3ro/saludo1.html">* Responde a los saludos</a></li>
                </ul>
            </div>
        </div>
        <div class="pronombres" onmouseover="playSound('../audios/pronombres.mp3')" onmouseout="stopSound()">
            <img src="../image/pr.jpg" alt="image" width="250">
            <a href="#">SUTILANTINAKA <br> Pronombres personales</a>
            <div class="game-pronombres">
                <ul>
                    <li><a href="../juegos3ro/pronombre.html">* Completa con el pronombre correcto</a></li>
                    <li><a href="../juegos3ro/pronombre1.html">* Ordena la oracion</a></li>
                </ul>
            </div>
        </div>
        <div class="objetos" onmouseover="playSound('../audios/objetos.mp3')" onmouseout="stopSound()">
            <img src="../image/objetos.jpg" alt="image" width="250">
            <a href="#">YÄNAKA : Objetos</a>
            <div class="game-objetos">
                <ul>
                    <li><a href="../juegos3ro/objetos.html">* ¿Qué objeto ves?</a></li>
                    <li><a href="../juegos3ro/objetos2.html">* Adivina la palabra</a></li>
                </ul>
            </div>
        </div>
    </div>

    <script src="../js/tercero.js"></script>
</body>

</html>