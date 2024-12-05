<?php
session_start();
date_default_timezone_set('America/La_Paz');

if(isset($_SESSION['Id_est'])){
    $Id_est = $_SESSION['Id_est'];
    include('../conexion/bd.php');

    // Determinar si usar fechas aleatorias o la fecha actual
    $usarFechasAleatorias = false; // Cambia esto a true si deseas usar fechas aleatorias

    if ($usarFechasAleatorias) {
        // Generar una fecha aleatoria entre el 21 de mayo y el 21 de junio de 2024
        $start_date = strtotime("2024-06-04");
        $end_date = strtotime("2024-06-04");

        $random_timestamp = mt_rand($start_date, $end_date);
        $fecha_salida = date("Y-m-d", $random_timestamp);
    } else {
        // Usar la fecha actual
        $fecha_salida = date("Y-m-d");
    }

    // Siempre usar la hora actual
    $hora_salida = date("H:i:s");

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