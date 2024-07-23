<?php
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Verificar si se han excedido los intentos de inicio de sesión
if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 3) {
    if (isset($_SESSION['login_wait_time']) && $_SESSION['login_wait_time'] > time()) {
        header("location: ../login/pantallaDR.php");
        exit(); 
    } else {
        $_SESSION['login_attempts'] = 0;
        unset($_SESSION['login_wait_time']);
    }
}

$carnet = $_POST['carnet'];
$password = $_POST['password'];

$_SESSION['carnet'] = $carnet;

include('../conexion/bd.php');

$consulta = "SELECT Id, ci FROM docente WHERE ci=? AND BINARY password=?";
$statement = mysqli_prepare($conexion, $consulta);

if ($statement) {
    mysqli_stmt_bind_param($statement, "ss", $carnet, $password);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);

    $filas = mysqli_stmt_num_rows($statement);

    if ($filas > 0) {
        $_SESSION['login_attempts'] = 0;
        unset($_SESSION['login_wait_time']);

        mysqli_stmt_bind_result($statement, $docente_id, $ci);
        mysqli_stmt_fetch($statement);

        $_SESSION['nombre_de_usuario'] = $ci;
        $_SESSION['docente_id'] = $docente_id;

        header("location: ../home/homeD.php");
        exit();
    } else {
        $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
        if ($_SESSION['login_attempts'] >= 3) {
            $_SESSION['login_wait_time'] = time() + 60;
        }
        header("location: ../login/logDocente.php?error=1");
        exit();
    }
} else {
    header("location: ../login/logDocente.php?error=2");
    exit();
}

mysqli_stmt_close($statement);
mysqli_close($conexion);
?>
