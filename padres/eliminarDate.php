<?php
// Verificar que el método es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar el ID del estudiante desde la solicitud POST
    $idEstudiante = $_POST['Id_est'];

    // Incluir archivo de conexión a la base de datos
    include('../conexion/bd.php');

    // Iniciar una transacción para asegurar que las eliminaciones se hagan correctamente
    mysqli_begin_transaction($conexion);

    try {
        // Eliminar registros de las tablas dependientes
        $sqlDeleteRegistros = "DELETE FROM registro_entradas_salidas WHERE Id_est = ?";
        $stmt = mysqli_prepare($conexion, $sqlDeleteRegistros);
        mysqli_stmt_bind_param($stmt, "i", $idEstudiante);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sqlDeleteRespuestas = "DELETE FROM respuestas WHERE Id_est = ?";
        $stmt = mysqli_prepare($conexion, $sqlDeleteRespuestas);
        mysqli_stmt_bind_param($stmt, "i", $idEstudiante);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sqlDeleteActividades = "DELETE FROM actividad_estudiante WHERE Id_est = ?";
        $stmt = mysqli_prepare($conexion, $sqlDeleteActividades);
        mysqli_stmt_bind_param($stmt, "i", $idEstudiante);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sqlDeleteCursos = "DELETE FROM curso_est WHERE Id_est = ?";
        $stmt = mysqli_prepare($conexion, $sqlDeleteCursos);
        mysqli_stmt_bind_param($stmt, "i", $idEstudiante);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Finalmente, eliminar el estudiante
        $sqlDeleteEstudiante = "DELETE FROM estudiantes WHERE Id_est = ?";
        $stmt = mysqli_prepare($conexion, $sqlDeleteEstudiante);
        mysqli_stmt_bind_param($stmt, "i", $idEstudiante);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Si todo salió bien, confirmar la transacción
        mysqli_commit($conexion);

        // Responder éxito
        echo json_encode(array('status' => 'success'));
    } catch (Exception $e) {
        // Si algo sale mal, revertir la transacción
        mysqli_rollback($conexion);

        // Responder error
        echo json_encode(array('status' => 'error', 'message' => 'Error al eliminar datos: ' . $e->getMessage()));
    }

    // Cerrar la conexión
    mysqli_close($conexion);
} else {
    // Responder error si no es una solicitud POST
    echo json_encode(array('status' => 'error', 'message' => 'Método de solicitud no válido'));
}
?>
