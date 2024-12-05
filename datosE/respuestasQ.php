<?php
session_start();

if (!isset($_SESSION['contrasena'])) {
    header("location: ../login/logEst.php");
    exit();
}

include('../conexion/bd.php');

$contrasena = $_SESSION['contrasena'];
$cedula_est = ''; //  cédula de identidad del estudiante
$Id_est = null; //  Id_est del est. obtenido

// Consulta para obtener la cédula de identidad
$consulta_cedula = "SELECT cedula_est FROM estudiantes WHERE cedula_est = ?";
$statement_cedula = mysqli_prepare($conexion, $consulta_cedula);

if ($statement_cedula) {
    mysqli_stmt_bind_param($statement_cedula, "s", $contrasena);
    mysqli_stmt_execute($statement_cedula);
    mysqli_stmt_bind_result($statement_cedula, $cedula_est);
    mysqli_stmt_fetch($statement_cedula);
    mysqli_stmt_close($statement_cedula);
} else {
    echo "Error al preparar la consulta de cédula";
    exit();
}

// Verificar que la cédula de identidad no esté vacía
if (empty($cedula_est)) {
    echo "No se encontró la cédula de identidad para el estudiante";
    exit();
}

// Consulta para obtener el Id_est basado en la cédula de identidad
$consulta_id_est = "SELECT Id_est FROM estudiantes WHERE cedula_est = ?";
$statement_id_est = mysqli_prepare($conexion, $consulta_id_est);

if ($statement_id_est) {
    mysqli_stmt_bind_param($statement_id_est, "s", $cedula_est);
    mysqli_stmt_execute($statement_id_est);
    mysqli_stmt_bind_result($statement_id_est, $Id_est);
    mysqli_stmt_fetch($statement_id_est);
    mysqli_stmt_close($statement_id_est);
} else {
    echo "Error al preparar la consulta de Id_est";
    exit();
}

// Verificar que se haya obtenido el Id_est
if ($Id_est === null) {
    echo "No se encontró el Id_est para la cédula de identidad: $cedula_est";
    exit();
}

//echo "Id_est obtenido: $Id_est<br>";

// Aquí obtendrás los datos del formulario
$q1 = $_POST['qSocial1'] ?? '';
$q2 = $_POST['qSocial2'] ?? '';
$q3 = $_POST['qSocial3'] ?? '';
$q4 = $_POST['qSocial4'] ?? '';
$q5 = $_POST['qSocial5'] ?? '';

//echo "Datos del formulario:<br>";
//echo "qSocial1: $q1<br>";
//echo "qSocial2: $q2<br>";
//echo "qSocial3: $q3<br>";
//echo "qSocial4: $q4<br>";
//echo "qSocial5: $q5<br>";

// Inserción en la tabla respuestas
$insert_query = "INSERT INTO respuestas (Id_est, qSocial1, qSocial2, qSocial3, qSocial4, qSocial5) VALUES (?, ?, ?, ?, ?, ?)";
$insert_statement = mysqli_prepare($conexion, $insert_query);

if ($insert_statement) {
    mysqli_stmt_bind_param($insert_statement, "isssss", $Id_est, $q1, $q2, $q3, $q4, $q5);
    if (mysqli_stmt_execute($insert_statement)) {
        echo '<script>alert("Formulario completado correctamente"); window.location.href="../cursos/Tercero.php";</script>';
        $_SESSION['formulario_enviado'] = true;
    } else {
        echo "Error al ejecutar la consulta de inserción: " . mysqli_stmt_error($insert_statement);
    }
    mysqli_stmt_close($insert_statement);
} else {
    echo "Error al preparar la consulta de inserción: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
