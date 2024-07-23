<?php
session_start();
date_default_timezone_set('America/La_Paz');

if(isset($_SESSION['Id_est'])){
    $Id_est = $_SESSION['Id_est'];
    include('../conexion/bd.php');

    $fecha_salida = date('Y-m-d');
    $hora_salida = date('H:i:s');

    // Actualizar la hora de salida en la base de datos
    $sql = "UPDATE registro_entradas_salidas SET fecha_salida=?, hora_salida=? WHERE Id_est=? AND fecha_salida IS NULL";
    $statement = mysqli_prepare($conexion, $sql);

    if ($statement) {
        mysqli_stmt_bind_param($statement, "ssi", $fecha_salida, $hora_salida, $Id_est);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
    } else {
        echo "Error en la preparación de la consulta SQL.";
    }

    mysqli_close($conexion);
}

// Destruir la sesión y redirigir al formulario de inicio de sesión
session_destroy();
header("Location: ../login/logEst.php?sesion=1");
exit();
?>