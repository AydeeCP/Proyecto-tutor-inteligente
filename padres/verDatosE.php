<?php
session_start();
include('../conexion/bd.php');

if (!isset($_SESSION['padre_id'])) {
    header("Location: ../login/logPad.php");
    exit();
}

$padre_id = $_SESSION['padre_id'];

// Consulta SQL para obtener los datos del estudiante
$sql_estudiante = "SELECT * FROM estudiantes WHERE Id_padres = ?";
$stmt_estudiante = mysqli_prepare($conexion, $sql_estudiante);

if ($stmt_estudiante === false) {
    die('Error en la preparación de la consulta: ' . mysqli_error($conexion));
}

mysqli_stmt_bind_param($stmt_estudiante, "i", $padre_id);
mysqli_stmt_execute($stmt_estudiante);
$result_estudiante = mysqli_stmt_get_result($stmt_estudiante);

if ($result_estudiante->num_rows > 0) {
    $datos_estudiante = array();
    
    while ($row_estudiante = mysqli_fetch_assoc($result_estudiante)) {
        $estudiante = array(
            'Id_est' => $row_estudiante['Id_est'],
            'cedula_est' => $row_estudiante['cedula_est'],
            'nacimiento_est' => $row_estudiante['nacimiento_est'],
            'genero' => $row_estudiante['genero'],
            'nombre_est' => $row_estudiante['nombre_est'],
            'apellidos_est' => $row_estudiante['apellidos_est'],
            'lengua_materna' => $row_estudiante['lengua_materna']
        );

        // Obtener datos de los cursos para el estudiante
        $estudiante_id = $row_estudiante['Id_est'];
        $sql_cursos = "SELECT nivel_curso, paralelo, materia FROM curso_est WHERE Id_est = ?";
        $stmt_cursos = mysqli_prepare($conexion, $sql_cursos);

        if ($stmt_cursos === false) {
            die('Error en la preparación de la consulta: ' . mysqli_error($conexion));
        }

        mysqli_stmt_bind_param($stmt_cursos, "i", $estudiante_id);
        mysqli_stmt_execute($stmt_cursos);
        $result_cursos = mysqli_stmt_get_result($stmt_cursos);

        $cursos = array();
        while ($row_curso = mysqli_fetch_assoc($result_cursos)) {
            $cursos[] = array(
                'nivel_curso' => $row_curso['nivel_curso'],
                'paralelo' => $row_curso['paralelo'],
                'materia' => $row_curso['materia']
            );
        }

        $estudiante['cursos'] = $cursos;
        $datos_estudiante[] = $estudiante;

        mysqli_free_result($result_cursos);
    }

    header('Content-Type: application/json');
    echo json_encode($datos_estudiante);
} else {
    echo json_encode(array("message" => "No se encontraron datos de registro para este padre y sus estudiantes."));
}

mysqli_free_result($result_estudiante);
mysqli_close($conexion);
?>
