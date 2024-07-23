<?php
    session_start();
    if (!isset($_SESSION['padre_id'])) {
        header("Location: ../login/logPad.php");
        exit();
    }
    // Obtener el nombre y apellidos del padre/tutor de la sesión
    $idEstudiante = $_SESSION['id_estudiante'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/HomePad.css">
    <link rel="stylesheet" href="../css/introJs.css">
    <!-- Incluir Intro.js desde un CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/introjs.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/intro.min.js"></script>
    <title>Pantalla principal Padre/Tutor</title>
</head>

<body>
    <div class="principal">
        <h1>Bienvenid@ <?php echo htmlspecialchars($_SESSION['padre_nombre'] . " " . $_SESSION['padre_apellidos']); ?></h1>
    </div>
    <div class="inform">
        <a href="#" id="startTour"><i class='bx bxs-info-circle bx-sm bx-flashing-hover'></i> Iniciar</a>
    </div>
    <div class="salir">
        <a href="../padres/cerrarSesion.php"><i class='bx bx-log-out bx-sm bx-fade-left-hover'></i>Cerrar sesión</a></li>
    </div>
    <div class="contenedorP">
        <div class="datos">
            <img src="../image/datos.jpg" alt="image" width="250" height="240">
            <div class="enlace">
                <a href="../padres/mostrarDP.html">Datos personales <br>padre o tutor</a>
            </div>
        </div>
        <div class="padresL">
            <img src="../image/niños.png" alt="image" width="250" height="240">
            <div class="enlace">
                <a href="../padres/mostrarDE.html">Datos personales <br> de <br> estudiante registrado</a>
            </div>
        </div>
        <div class="estudianteL">
            <img src="../image/estudiantes.jpg" alt="image" width="270" height="250">
            <div class="enlace">
                <a href="../padres/actividad.html?id_estudiante=<?php echo $idEstudiante; ?>">Seguimiento de actividades <br> realizadas del <br> estudiante</a>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#startTour').click(function() {
                introJs().setOptions({
                    steps: [{
                            intro: "Bienvenido al portal de padres. Vamos a guiarte a través de las principales funcionalidades de esta página."
                        },
                        {
                            element: document.querySelector('.principal'),
                            intro: "Este es tu saludo personalizado. Te damos la bienvenida con tu nombre completo.",
                            position: 'bottom'
                        },
                        {
                            element: document.querySelector('.salir a'),
                            intro: "Puedes hacer clic aquí para cerrar sesión y salir del portal.",
                            position: 'right'
                        },
                        {
                            element: document.querySelector('.datos'),
                            intro: "Aquí puedes ver y actualizar los datos personales del padre o tutor.",
                            position: 'right'
                        },
                        {
                            element: document.querySelector('.padresL'),
                            intro: "Aquí puedes ver los datos personales de los estudiantes registrados.",
                            position: 'right'
                        },
                        {
                            element: document.querySelector('.estudianteL'),
                            intro: "Aquí puedes hacer seguimiento de las actividades realizadas por los estudiantes.",
                            position: 'right'
                        }
                    ],
                    tooltipClass: 'customTooltip', // Aplica la clase personalizada para el tooltip
                    highlightClass: 'customHighlight', // Aplica la clase personalizada para el enfoque
                    showStepNumbers: true, // Mostrar números de pasos en el tour
                    scrollToElement: true // Desplazar automáticamente al elemento en el tour
                }).start();
            });
        });
    </script>
</body>

</html>