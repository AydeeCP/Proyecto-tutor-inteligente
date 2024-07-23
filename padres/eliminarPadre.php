<?php
session_start();

include ('../conexion/bd.php');

if (!isset($_SESSION['padre_id'])) {
    header("Location: ../login/logPad.php");
    exit();
}

$padre_id = $_SESSION['padre_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el padre tiene estudiantes asociados
    $sql_check = "SELECT * FROM estudiantes WHERE Id_padres=?";
    $stmt_check = mysqli_prepare($conexion, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "i", $padre_id);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo json_encode(['success' => false, 'message' => 'No se puede eliminar la cuenta debido a que está asociada con la cuenta de su hij@']);
    } else {
        // Eliminar la cuenta del padre
        $sql_delete = "DELETE FROM padres WHERE Id_padres=?";
        $stmt_delete = mysqli_prepare($conexion, $sql_delete);
        mysqli_stmt_bind_param($stmt_delete, "i", $padre_id);

        if (mysqli_stmt_execute($stmt_delete)) {
            echo json_encode(['success' => true, 'message' => 'Cuenta eliminada correctamente.']);
            session_destroy(); // Cerrar la sesión
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar la cuenta.']);
        }

        mysqli_stmt_close($stmt_delete);
    }

    mysqli_stmt_close($stmt_check);
}

mysqli_close($conexion);
?>
