<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/homeDoc.css" />
    <link rel="stylesheet" href="../css/introJs.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Incluir Intro.js desde un CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/introjs.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/intro.min.js"></script>
    <title>Pagina principal docentes</title>
</head>

<body>
    <div class="principal" data-intro="Aquí se muestra el nombre del docente y el saludo." data-step="1">
        <h1><?php include('../datosD/datosD.php'); ?></h1><br><br>
    </div>
    <div class="inform">
        <a href="#" id="startTour"><i class='bx bxs-info-circle bx-sm bx-flashing-hover'></i> Iniciar</a>
    </div>
    <div class="salir home" data-intro="Aquí puedes cerrar sesión." data-step="2">
        <a href="../datosD/cerrar.php"><i class='bx bx-log-out bx-sm bx-fade-left-hover'></i>Cerrar sesión</a>
    </div>
    <div class="contenedorD">
        <div class="datos" data-intro="Accede a tus datos personales desde aquí." data-step="3">
            <img src="../image/datos.jpg" alt="image" width="200" height="190">
            <div class="enlace">
                <a href="../DocentePP/verDatos.php">Datos personales</a>
                <!--<a href="../datosD/datosG.php">Datos</a>-->
            </div>
        </div>
        <div class="padresL" data-intro="Consulta la lista de padres aquí." data-step="4">
            <img src="../image/fam.jpg" alt="image" width="200" height="190">
            <div class="enlace">
                <a href="../DocentePP/listPadres.html">Lista de padres</a>
            </div>
        </div>
        <div class="estudianteL" data-intro="Revisa la lista de estudiantes aquí." data-step="5">
            <img src="../image/estudiantes.jpg" alt="image" width="210" height="200">
            <div class="enlace">
                <a href="../DocentePP/listaEst.html">Lista de <br> estudiantes</a>
            </div>
        </div>
        <div class="seguimiento" data-intro="Haz seguimiento de las actividades aquí." data-step="6">
            <img src="../image/seguimiento.png" alt="image" width="210" height="190">
            <div class="enlace">
                <a href="../DocentePP/actividades.html">Seguimiento <br>de actividades</a>
            </div>
        </div>
        <div class="logros" data-intro="Revisa los logros obtenidos aquí." data-step="7">
            <img src="../image/logros.png" alt="image" width="200" height="190">
            <div class="enlace">
                <a href="../DocentePP/logros.html">Logros obtenidos</a>
            </div>
        </div>
        <div class="registro" data-intro="Consulta el historial de registro de entradas aquí." data-step="8">
            <img src="../image/ingresos.jpg" alt="image" width="200" height="190">
            <div class="enlace">
                <a href="../DocentePP/cantUso.html">Historial de<br>registro de entradas</a>
            </div>
        </div>
        <div class="respuesta" data-intro="Verifica la respuesta a la evaluación diagnóstica aquí." data-step="9">
            <img src="../image/respuesta.png" alt="image" width="200" height="190">
            <div class="enlace">
                <a href="../DocentePP/ver_respuesta.html">Respuesta evaluación<br> diagnóstica</a>
            </div>
        </div>
    </div>
    <script>
        function startIntro() {
            introJs().setOptions({
                steps: [{
                        intro: "Bienvenido a la página principal del docente."
                    },
                    {
                        element: document.querySelector('.principal'),
                        intro: "Aquí se muestra el nombre del docente y el saludo.",
                        position: 'bottom'
                    },
                    {
                        element: document.querySelector('.salir'),
                        intro: "Al hacer clic aqui puedes cerrar sesión.",
                        position: 'bottom'
                    },
                    {
                        element: document.querySelector('.datos'),
                        intro: "Puedes acceder a tus datos personales desde aquí y editarlos.",
                        position: 'bottom'
                    },{
                        element: document.querySelector('.padresL'),
                        intro: "Consulta la lista de padres registrados.",
                        position: 'bottom'
                    },{
                        element: document.querySelector('.estudianteL'),
                        intro: "Revisa la lista de estudiantes aquí.",
                        position: 'bottom'
                    },
                    {
                        element: document.querySelector('.seguimiento'),
                        intro: "Haz seguimiento de las actividades realizadas aquí.",
                        position: 'bottom'
                    },
                    {
                        element: document.querySelector('.logros'),
                        intro: "Revisa los logros obtenidos en las actividades aquí.",
                        position: 'bottom'
                    },
                    {
                        element: document.querySelector('.registro'),
                        intro: "Consulta el historial de registro de entradas aquí.",
                        position: 'bottom'
                    },
                    {
                        element: document.querySelector('.respuesta'),
                        intro: "Verifica la respuesta a la evaluación diagnóstica aquí.",
                        position: 'bottom'
                    }
                ],
                tooltipClass: 'customTooltip'
            }).start();
        }

        document.getElementById('startTour').addEventListener('click', function(event) {
            event.preventDefault(); // Previene el comportamiento por defecto del enlace
            startIntro();
        });
    </script>
</body>

</html>