<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!isset($_SESSION['contrasena'])) {
    header("location: ../login/logEst.php");
    exit();
}

include("../conexion/bd.php");

$contrasena = $_SESSION['contrasena'];

$idEstudiante = '';
$idCurso = '';

$consulta = "SELECT estudiante.Id_est, curso_est.Id_curso
                FROM estudiantes AS estudiante 
                INNER JOIN curso_est ON estudiante.Id_est = curso_est.Id_est
                WHERE estudiante.cedula_est=?";

$statement = mysqli_prepare($conexion, $consulta);

if ($statement) {

    mysqli_stmt_bind_param($statement, "s", $contrasena);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement, $idEstudiante, $idCurso);
    mysqli_stmt_fetch($statement);
    mysqli_stmt_close($statement);
} else {
    echo "Error al preparar la consulta";
}

if ($idEstudiante !== '' && $idCurso !== '') {
    if (isset($_POST['opcion_navbar'], $_POST['tema_practicado'], $_POST['juego_seleccionado'])) {
        $opcionNavbar = $_POST['opcion_navbar'];
        $temaPracticado = $_POST['tema_practicado'];
        $juegosSeleccionado = $_POST['juego_seleccionado'];
        $palabrasAcertadas = isset($_POST['palabrasAcertadas']) ? intval($_POST['palabrasAcertadas']) : 0;
        $vecesJugadas = isset($_POST['vecesJugadas']) ? intval($_POST['vecesJugadas']) : 0;
        $medalla =$_POST['medalla'];
        
        // Definir una condición para elegir entre fechas aleatorias y fecha actual
        $usarFechaAleatoria = false; // Puedes cambiar esto a false para usar la fecha actual

        if ($usarFechaAleatoria) {
            // Generar una fecha aleatoria entre el 21 de mayo y el 21 de junio
            $start_date = strtotime("2024-06-04");
            $end_date = strtotime("2024-06-04");

            if ($start_date > $end_date) {
                die("Fecha de inicio está después de la fecha de fin");
            }

            $random_timestamp = mt_rand($start_date, $end_date);

            // Ajustar la fecha aleatoria para tener la hora actual
            $fechaAleatoria = date("Y-m-d", $random_timestamp);
            $horaActual = date("H:i:s");
            $fechaActividad = $fechaAleatoria . ' ' . $horaActual;
        } else {
            // Usar la fecha y hora actual
            $fechaActividad = date("Y-m-d H:i:s");
        }

        // Mostrar datos antes de insertar
            /*echo "<h3>Datos a Insertar:</h3>";
            echo "<p>Id Estudiante: " . htmlspecialchars($idEstudiante) . "</p>";
            echo "<p>Id Curso: " . htmlspecialchars($idCurso) . "</p>";
            echo "<p>Opción Navbar: " . htmlspecialchars($opcionNavbar) . "</p>";
            echo "<p>Tema Practicado: " . htmlspecialchars($temaPracticado) . "</p>";
            echo "<p>Juego Seleccionado: " . htmlspecialchars($juegosSeleccionado) . "</p>";
            echo "<p>Palabras Acertadas: " . htmlspecialchars($palabrasAcertadas) . "</p>";
            echo "<p>Veces Jugadas: " . htmlspecialchars($vecesJugadas) . "</p>";
            echo "<p>Medalla: " . htmlspecialchars($medalla) . "</p>";
            echo "<p>Fecha Actividad: " . htmlspecialchars($fechaActividad) . "</p>";*/
        
        /*ALMACENAR DATOS*/
        $consulta_insertar_actividad = "INSERT INTO actividad_estudiante(Id_est, Id_curso, opcion_navbar,tema_practicado,juego_seleccionado, palabrasAcertadas,vecesJugadas,medalla,fecha_actividad)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $statement_insertar_actividad = mysqli_prepare($conexion, $consulta_insertar_actividad);
        mysqli_stmt_bind_param($statement_insertar_actividad, "iisssiiss", $idEstudiante, $idCurso, $opcionNavbar, $temaPracticado, $juegosSeleccionado,$palabrasAcertadas,$vecesJugadas,$medalla,$fechaActividad);
        mysqli_stmt_execute($statement_insertar_actividad);
        mysqli_stmt_close($statement_insertar_actividad);

        echo "Datos almacenados correctamente";
    } else {
        echo "Error: no se recibieron los datos esperados<br>";
        echo "Datos recbidos: <br>";
        var_dump($_POST);
    }
} else {
    echo "No se encontraron datos de usuario";
}
// Cerrar la conexión a la base de datos
mysqli_close($conexion);

?>
