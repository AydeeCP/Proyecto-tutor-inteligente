<?php
// Verificación básica de seguridad
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar el ID del estudiante desde la solicitud POST
    $idEstudiante = $_POST['Id_est'];

    // Incluir archivo de conexión a la base de datos
    include('../conexion/bd.php');

    // Sentencia SQL para eliminar datos de las tablas relacionadas
    $sqlDeleteCurso = "DELETE FROM curso_est WHERE Id_est = ?";
    $sqlDeleteActividades = "DELETE FROM actividad_estudiante WHERE Id_est = ?";
    $sqlDeleteRespuestas = "DELETE FROM respuestas WHERE Id_est = ?";
    $sqlDeleteInteraccion = "DELETE FROM interaccion_time WHERE Id_est = ?";
    $sqlDeleteLogros = "DELETE FROM logros_estudiantes WHERE Id_est = ?";
    
    // Sentencia SQL para eliminar el registro del estudiante
    $sqlDeleteEstudiante = "DELETE FROM estudiantes WHERE Id_est = ?";

    // Preparar y ejecutar las sentencias SQL
    $stmtDeleteCurso = mysqli_prepare($conexion, $sqlDeleteCurso);
    $stmtDeleteActividades = mysqli_prepare($conexion, $sqlDeleteActividades);
    $stmtDeleteRespuestas = mysqli_prepare($conexion, $sqlDeleteRespuestas);
    $stmtDeleteInteraccion = mysqli_prepare($conexion, $sqlDeleteInteraccion);
    $stmtDeleteEstudiante = mysqli_prepare($conexion, $sqlDeleteEstudiante);
    $sqlDeleteLogros=mysqli_prepare($conexion, $sqlDeleteLogros);
    // Verificar si las preparaciones fueron exitosas
    if ($stmtDeleteCurso && $stmtDeleteActividades && $stmtDeleteRespuestas && $stmtDeleteInteraccion && $stmtDeleteEstudiante && $stmtDeleteLogros) {
        // Iniciar una transacción para asegurar la integridad de los datos
        mysqli_begin_transaction($conexion);
        try {
            // Ejecutar las eliminaciones en orden
            mysqli_stmt_bind_param($stmtDeleteCurso, "i", $idEstudiante);
            mysqli_stmt_execute($stmtDeleteCurso);

            mysqli_stmt_bind_param($stmtDeleteActividades, "i", $idEstudiante);
            mysqli_stmt_execute($stmtDeleteActividades);

            mysqli_stmt_bind_param($stmtDeleteRespuestas, "i", $idEstudiante);
            mysqli_stmt_execute($stmtDeleteRespuestas);

            mysqli_stmt_bind_param($stmtDeleteInteraccion, "i", $idEstudiante);
            mysqli_stmt_execute($stmtDeleteInteraccion);

            mysqli_stmt_bind_param($stmtDeleteEstudiante, "i", $idEstudiante);
            mysqli_stmt_execute($stmtDeleteEstudiante);

            mysqli_stmt_bind_param($stmtDeleteLogros, "i", $idEstudiante);
            mysqli_stmt_execute($stmtDeleteLogros);

            // Confirmar la transacción si todo fue exitoso
            mysqli_commit($conexion);

            // Enviar respuesta JSON de éxito
            echo json_encode(array('status' => 'success'));
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            mysqli_rollback($conexion);
            echo json_encode(array('status' => 'error', 'message' => 'Error al eliminar datos: ' . $e->getMessage()));
        }
    } else {
        // Enviar respuesta JSON de error si hay problemas con las preparaciones
        echo json_encode(array('status' => 'error', 'message' => 'Error en la preparación de las consultas SQL'));
    }

    // Cerrar todas las declaraciones preparadas y la conexión
    mysqli_stmt_close($stmtDeleteCurso);
    mysqli_stmt_close($stmtDeleteActividades);
    mysqli_stmt_close($stmtDeleteRespuestas);
    mysqli_stmt_close($stmtDeleteInteraccion);
    mysqli_stmt_close($stmtDeleteEstudiante);
    mysqli_close($conexion);
} else {
    // Enviar respuesta JSON de error si el método de solicitud no es POST
    echo json_encode(array('status' => 'error', 'message' => 'Método de solicitud no válido'));
}
?>
