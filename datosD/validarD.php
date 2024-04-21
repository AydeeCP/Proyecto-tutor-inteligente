<?php
session_start();

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Verificar si se han excedido los intentos de inicio de sesión
if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 3) {
    // Verificar si ya ha pasado el tiempo de espera
    if (isset($_SESSION['login_wait_time']) && $_SESSION['login_wait_time'] > time()) {
        // Si el tiempo de espera aún no ha pasado, redirigir de nuevo al formulario de inicio de sesión con un mensaje de espera
        header("location: ../login/pantallaDR.php");
        exit(); // Terminar el script


    } else {
        // Si el tiempo de espera ha pasado, restablecer los intentos de inicio de sesión
        $_SESSION['login_attempts'] = 0;
        unset($_SESSION['login_wait_time']);
    }
}

$carnet = $_POST['carnet'];
$password = $_POST['password'];

$_SESSION['carnet'] = $carnet;

include('../conexion/bd.php');

//USO DE BINARY PARA DISTINGUIR ENTRE MAY Y MIN CASE-SENSITIVE
// consulta
$consulta = "SELECT ci FROM docente WHERE ci=? AND BINARY password=?";
$statement = mysqli_prepare($conexion, $consulta);

// Verificar si la preparación de la consulta fue exitosa
if ($statement) {
    // Vincular los parámetros de la consulta
    mysqli_stmt_bind_param($statement, "ss", $carnet, $password);
    
    // Ejecutar la consulta
    mysqli_stmt_execute($statement);
    
    mysqli_stmt_store_result($statement);

    $filas = mysqli_stmt_num_rows($statement);
    

    mysqli_stmt_close($statement);

    // Verificar 
    if ($filas > 0) {
        // Restablecer los intentos de inicio de sesión exitosos
        $_SESSION['login_attempts'] = 0;
        unset($_SESSION['login_wait_time']);
        
        //POSIBLE SOLUCION
        $nombre_usuario = $carnet;

    // Establecer $_SESSION['nombre_de_usuario'] con el nombre de usuario del docente
        $_SESSION['nombre_de_usuario'] = $nombre_usuario;

        header("location: ../home/homeD.php");
        exit();
    } else {
        // Credenciales incorrectas, incrementar los intentos de inicio de sesión
        $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
        


        // Si se han excedido los intentos máximos, establecer un tiempo de espera de 1 minuto
        if ($_SESSION['login_attempts'] >= 3) {
            $_SESSION['login_wait_time'] = time() + 60;
        }

        // Redirigir de nuevo al formulario de inicio de sesión con un mensaje de error
        header("location: ../login/logDocente.php?error=1");
        exit(); // Terminar el script
        
    } 
} else {
    // Si la preparación de la consulta falló, redirigir al usuario de vuelta al formulario con un mensaje de error
    header("location: ../login/logDocente.php?error=2");
    exit(); // Terminar el script
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
