<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navb.css">
    <link rel="stylesheet" href="../css/introNav.css">
    <link rel="stylesheet" href="../css/introGrama.css">
    <link rel="website icon" type="png" href="icono.png">
    <link rel="stylesheet" href="../css/diagnostico.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intro.js/minified/introjs.min.css">
    <title>Tercero</title>
</head>

<body>
    <!--<h1>CURSO TERCERO DE PRIMARIA</h1>-->
    <!--DISEÑO DEL NAVBAR-->
    <header class="header">
        <div class="logo" data-intro="Aquí está el logo de tu aplicación." data-step="1" data-position="bottom">
            <?php include('../datosE/datosE.php'); ?>
        </div>
        <div id="questionD" data-intro="Este es el ícono de información. Haz clic para obtener más detalles." data-step="2" data-position="bottom">
            <i class='bx bx-info-circle bx-sm'></i>
        </div>
        <!--pagina principal-->
        <a href="#" id="startTour">Qalltañani</a>

        <input type="checkbox" id="toggle">
        <label for="toggle" data-intro="Haz clic aquí para abrir el menú." data-step="3" data-position="bottom">
            <img class="menu" src="../image/menu.svg" alt="menu">
        </label>
        <nav class="navigation">
            <ul>
                <li data-intro="Regresa a la página principal desde aquí." data-step="4" data-position="bottom">
                    <a href="../cursos/tercero.php">Uta</a>
                </li>
                <li data-intro="Aquí puedes acceder a la sección de Gramática." data-step="5" data-position="bottom">
                    <a href="javascript:void(0);" onclick="cargarContenido('../gramatica/grama3ro.php')">Gramática</a>
                </li>
                <li class="submenu-toggle" data-intro="Explora el contenido de Entretenimiento aquí." data-step="6" data-position="bottom">
                    <a href="#">Anat'awi</a>
                    <ul class="submenu">
                        <li data-intro="Aquí puedes ver videos relacionados." data-step="7" data-position="right">
                            <a href="../varios/videos.html">Videonaka uñachtʼayaña</a>
                        </li>
                    </ul>
                </li>
                <li data-intro="Accede a la sección de Verbos desde aquí." data-step="8" data-position="bottom">
                    <a href="../varios/verbos.html">Lurayirinaka</a>
                </li>
                <li data-intro="Haz clic aquí para cerrar sesión." data-step="9" data-position="bottom">
                    <a href="../datosE/cerrarE.php" id="salirBtn">
                        <i class='bx bx-log-out bx-sm bx-fade-left-hover'></i>Mistuñani
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <!--<button id="startTour">Iniciar Tour</button>-->
    <div id="contenido" class="contenido">
        <div class="contenedor">
            <div class="mensaje">S</div>
            <div class="mensaje">A</div>
            <div class="mensaje">W</div>
            <div class="mensaje">I</div>
            <div class="mensaje">N</div>
            <div class="mensaje">A</div>
            <div class="mensaje">K</div>
            <div class="mensaje">A</div>
        </div>
        <div class="frases" id="frases">
            <h1 id="frase" class="frases"></h1>
            <hr>
            <h2 id="traduccion"></h2>
        </div>
    </div>
    <div class="recuadro" id="formulario">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Evaluación Diagnóstica: Contexto Social y Familiar en Aimara</h1>
            <?php
            if (isset($_SESSION['formulario_enviado']) && $_SESSION['formulario_enviado'] === true) {
                echo "<p style='color: #6157ab; font-weight: bold; text-align: center; background-color:#E6E1E190; padding:0.5rem;'>
                Ya has enviado el formulario. ¡Gracias!</p>";
            } else {
            ?>
                <form id="respuestaForm" action="../datosE/respuestasQ.php" method="POST">
                    <div class="question">
                        <p>1. ¿Hablas aimara en casa?</p>
                        <label><input type="radio" name="qSocial1" value="sí"> Sí</label><br>
                        <label><input type="radio" name="qSocial1" value="no"> No</label>
                    </div>
                    <div class="question">
                        <p>2. ¿Con quién hablas aimara más seguido?</p>
                        <label><input type="radio" name="qSocial2" value="familia"> Con mi familia</label><br>
                        <label><input type="radio" name="qSocial2" value="amigos"> Con mis amigos</label><br>
                        <label><input type="radio" name="qSocial2" value="escuela"> En la escuela</label><br>
                        <label><input type="radio" name="qSocial2" value="comunidad"> En la comunidad</label><br>
                        <label><input type="radio" name="qSocial2" value="otro"> Otro</label>
                    </div>
                    <div class="question">
                        <p>3. ¿Qué tan importante es para ti hablar aimara?</p>
                        <label><input type="radio" name="qSocial3" value="muy_importante"> Muy importante</label><br>
                        <label><input type="radio" name="qSocial3" value="importante"> Importante</label><br>
                        <label><input type="radio" name="qSocial3" value="poco_importante"> Poco importante</label><br>
                        <label><input type="radio" name="qSocial3" value="nada_importante"> Nada importante</label>
                    </div>
                    <div class="question">
                        <p>4. ¿Quién te enseñó a hablar aimara?</p>
                        <label><input type="radio" name="qSocial4" value="padres"> Mis padres</label><br>
                        <label><input type="radio" name="qSocial4" value="abuelos"> Mis abuelos</label><br>
                        <label><input type="radio" name="qSocial4" value="maestros"> Mis maestros</label><br>
                        <label><input type="radio" name="qSocial4" value="amigos"> Amigos</label><br>
                        <label><input type="radio" name="qSocial4" value="otro"> Otro</label>
                    </div>
                    <div class="question">
                        <p>5. ¿Qué cosas te hacen difícil aprender o hablar aimara?</p>
                        <textarea name="qSocial5"></textarea>
                    </div>
                    <button type="submit">Guardar</button>
                </form>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/intro.js/minified/intro.min.js"></script>
    <script src="../js/tercero.js"></script>
    <script src="../js/diagnostico.js"></script>
    <script>
        const frasesYAutores = {
            "Utanxa janiwa khuyusiñäkiti, jaka q’arañawa, siwa": "En la casa no se silba, con el tiempo serás pobre",
            "Sunquruxa janiwa manq’añäkiti, qhurqhuriñawa, siwa": "La laringe no se come, hace roncar mucho",
            "Ch’allaxa janiwa wayrayañäkiti, qhipüruxa jani yäniñawa, siwa": "La arena no se hace soplar con el viento, con el tiempo serás pobre",
            "Warawaraxa janiwa jakhuñäkiti, walja wawaniñawa, siwa": "Las estrellas no se cuentan, tendrás cantidades de hijos",
            "Janiwa k’arisiñäkiti, q’ixu q’ixuwa purisiri, siwa": "No hay que mentir, cuidado que el rayo esté cayendo sobre ti",
            "Kürmiruxa janiwa wikch’ukiñäkiti , puraka ususiri , siwa": "Al arco iris no se señala, sabe doler la barriga",
            "Arumaxa janiwa pit’añäkiti, nayrawa juykt’asiri sapxiwa": "De noche no se teje, podemos quedar ciegos",
            "Ch’irunxa janiwa qunuñäkiti, q’ixu q’ixuwa purisiri, siwa": "En el mojon no se sienta, sabe llegar el rayo",
            "Jamach’iruxa janiwa usuchjañäkiti, jachjarisiwa, siwa": "A los pájaros no se lastima, nos puede hacer enfermar",
            "Ch’uqi challwaxa janiwa manq’añäkiti, tixiptayiriwa, siwa": "El pescado crudo no se come, te enflaquece",
            "Qala  patanxa janiwa qunuñäkiti, jaqiwa parlasiri, siwa": "Encima de una piedra no se sienta, la gente se hablara de ti"
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

            const {
                frase,
                autor
            } = seleccionarFraseYAutorAleatoriamente();

            document.getElementById("frase").textContent = frase;
            document.getElementById("traduccion").textContent = autor;
        };
        actualizarFraseYAutor();

        /* INTRO JS A LA PÁGINA PRINCIPAL*/
        document.getElementById('startTour').addEventListener('click', function() {
            const isMobileScreen = window.innerWidth <= 1200;
            const steps = [{
                    intro: "Bienvenido al tour 👋"
                },
                {
                    element: document.querySelector('.logo'),
                    intro: "Aquí se muestra tu nombre y apellidos. Este es un área importante donde puedes ver tu información personal."
                },
                {
                    element: document.querySelector('#questionD'),
                    intro: "En esta sección puedes responder preguntas diagnósticas. Recuerda, puedes llenarlas solo una vez, así que asegúrate de completar todas las respuestas con cuidado."
                },
                {
                    element: document.querySelector('#frases'),
                    intro: "Aquí puedes ver pensamientos aleatorios en Aimara y Castellano."
                },
                ...(isMobileScreen ? [{
                    element: document.querySelector('label[for="toggle"]'),
                    intro: "Aquí puedes abrir el menú."
                }] : []),
                {
                    element: document.querySelector('.navigation ul li:nth-child(1)'),
                    intro: "Desde aquí puedes regresar a la página principal."
                },
                {
                    element: document.querySelector('.navigation ul li:nth-child(2)'),
                    intro: "Aquí puedes acceder a la sección de Gramática."
                },
                {
                    element: document.querySelector('.submenu-toggle a'),
                    intro: "Explora el contenido de Entretenimiento visual aquí."
                },
                {
                    element: document.querySelector('.navigation ul li:nth-child(4)'),
                    intro: "Accede a la sección de Verbos desde aquí."
                },
                {
                    element: document.querySelector('#salirBtn'),
                    intro: "Haz clic aquí para cerrar sesión."
                }
            ];
            const intro = introJs().setOptions({
                showStepNumbers: true,
                showBullets: true,
                showProgress: true,
                steps: steps,
                tooltipClass: 'introjs-tooltip custom-tooltip-class',
                highlightClass: 'custom-highlight-class', // Clase CSS para personalizar el elemento destacado
                tooltipPosition: 'auto', // Posición automática de la burbuja
                disableInteraction: false // Permitir interacción con la página durante el tour
            });
            intro.onchange(function(targetElement) {
                if (isMobileScreen && targetElement === document.querySelector('label[for="toggle"]')) {
                    document.getElementById('toggle').checked = true;
                }
                if (targetElement === document.querySelector('.submenu-toggle a')) {
                    document.querySelector('.submenu-toggle').classList.add('active');
                }
            });
            intro.onexit(function() {
                document.querySelector('.submenu-toggle').classList.remove('active');
            });
            intro.start();
        });
        function cargarContenido(url) {
            console.log('Cargando contenido desde:', url);
            var contenido = document.getElementById('contenido');
            // Realizar una solicitud AJAX para cargar el contenido de la página
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    contenido.innerHTML = xhr.responseText;
                    //inicializarIntroJs();
                    /*INTRO PARA EL CONTENIDO DE GRAMATICA.*/
                    var startContenidoTour = document.getElementById('startContenidoTour');
                    if (startContenidoTour) {
                        startContenidoTour.addEventListener('click', function() {
                            introJs().setOptions({
                                steps: [{element: document.querySelector('.vocales'),intro: "Aquí puedes explorar las vocales."},
                                    {element: document.querySelector('.abc'),intro: "Aquí está el abecedario."},
                                    {element: document.querySelector('.color'),intro: "Aquí puedes aprender sobre los colores."},
                                    {element: document.querySelector('.familia'),intro: "Aquí puedes aprender sobre la familia."},
                                    {element: document.querySelector('.saludo'),intro: "Aquí puedes aprender sobre los saludos."},
                                    {element: document.querySelector('.pronombres'),intro: "Aquí puedes aprender sobre los pronombres personales."},
                                    {element: document.querySelector('.objetos'), intro: "Aquí puedes aprender sobre los objetos."}
                                ],
                                showStepNumbers: true,
                                showBullets: true,
                                showProgress: true,
                                tooltipClass: 'content-tour'
                            }).start();
                        });
                    }
                }
            };
            xhr.send();
            return false; // Evita que el enlace cambie la URL
        }
        /*funciones anterior navbar*/
        document.querySelectorAll('.header .navigation ul li ul li a').forEach(item => {
            item.addEventListener('click', () => {
                setTimeout(() => {
                    document.getElementById('toggle').checked = false;
                }, 300);
            });
        });
    </script>

</body>

</html>