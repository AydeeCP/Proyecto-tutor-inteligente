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
    $cedula = $_POST['cedula_est'];
    $nacimiento = $_POST['nacimiento_est'];
    $genero = $_POST['genero'];
    $nombre = $_POST['nombre_est'];
    $apellidos = $_POST['apellidos_est'];
    $lenguaMaterna = $_POST['lengua_materna'];

    // Sentencia SQL para actualizar datos del estudiante
    $sql = "UPDATE estudiantes SET cedula_est=?, nacimiento_est=?, genero=?, nombre_est=?, apellidos_est=?, lengua_materna=? WHERE Id_est=?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssi", $cedula, $nacimiento, $genero, $nombre, $apellidos, $lenguaMaterna, $id_est);
    
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
