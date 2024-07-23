<?php
session_start();
include('../conexion/bd.php');

if (!isset($_SESSION['padre_id'])) {
    header("Location: ../login/logPad.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y obtener datos del formulario
    $id_est = $_POST['Id_est'];
    $nivel = $_POST['nivel_curso'];
    $paralelo = $_POST['paralelo'];
    $materia = $_POST['materia'];

    // Sentencia SQL para actualizar datos del curso
    $sql = "UPDATE curso_est SET nivel_curso=?, paralelo=?, materia=? WHERE Id_est=?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $nivel, $paralelo, $materia, $id_est);
    
    if (mysqli_stmt_execute($stmt)) {
        // Éxito en la actualización
        echo json_encode(array('status' => 'success'));
    } else {
        // Error en la ejecución de la consulta
        echo json_encode(array('status' => 'error', 'message' => mysqli_error($conexion)));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
} else {
    // Método de solicitud incorrecto
    http_response_code(405);
    echo json_encode(array('status' => 'error', 'message' => 'Método no permitido'));
}
?>
