<?php
session_start();
date_default_timezone_set('America/La_Paz');

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Verificar si se han excedido los intentos de inicio de sesión
if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 3) {
    // Verificar si ya ha pasado el tiempo de espera
    if (isset($_SESSION['login_wait_time']) && $_SESSION['login_wait_time'] > time()) {
        // Si el tiempo de espera aún no ha pasado, redirigir de nuevo al formulario de inicio de sesión con un mensaje de espera
        header("location: ../login/pantallaER.php");
        exit(); 
    } else {
        // Si el tiempo de espera ha pasado, restablecer los intentos de inicio de sesión
        $_SESSION['login_attempts'] = 0;
        unset($_SESSION['login_wait_time']);
    }
}

$user = $_POST['user'];
$pass = $_POST['contrasena'];

$_SESSION['contrasena'] = $pass;

include('../conexion/bd.php');

$consulta = "SELECT estudiante.Id_est, estudiante.cedula_est,estudiante.nombre_est, estudiante.apellidos_est, curso_est.nivel_curso AS nombre_curso 
FROM estudiantes AS estudiante 
INNER JOIN curso_est ON estudiante.Id_est = curso_est.Id_est 
WHERE estudiante.nombre_est=? AND estudiante.cedula_est=?";

$statement = mysqli_prepare($conexion, $consulta);

// Verificar si la consulta es vedad
if ($statement) {
    // Vincular los parámetros de la consulta
    mysqli_stmt_bind_param($statement, "ss", $user, $pass);
    
    // Ejecutar la consulta
    mysqli_stmt_execute($statement);
    
    mysqli_stmt_store_result($statement);

    $filas = mysqli_stmt_num_rows($statement);
    // Verificar 
    if ($filas > 0) {
        // Restablecer los intentos de inicio de sesión exitosos
        $_SESSION['login_attempts'] = 0;
        unset($_SESSION['login_wait_time']);

        mysqli_stmt_bind_result($statement,$Id_est,$cedula_est,$nombre_est,$apellidos_est,$nombre_curso);

        mysqli_stmt_fetch($statement);
        // Determinar si usar fechas aleatorias o la fecha actual
        $usarFechasAleatorias = false; // Cambia esto a true si deseas usar fechas aleatorias

        if ($usarFechasAleatorias) {
            // Generar una fecha aleatoria entre el 21 de mayo y el 21 de junio de 2024
            $start_date = strtotime("2024-06-04");
            $end_date = strtotime("2024-06-04");

            $random_timestamp = mt_rand($start_date, $end_date);
            $fecha_entrada = date("Y-m-d", $random_timestamp);
        } else {
            // Usar la fecha actual
            $fecha_entrada = date("Y-m-d");
        }

        // Siempre usar la hora actual
        $hora_entrada = date("H:i:s");

        // Insertar en la base de datos
        $sql = "INSERT INTO registro_entradas_salidas (Id_est, fecha_entrada, hora_entrada) 
                VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("iss", $Id_est, $fecha_entrada, $hora_entrada);
        $stmt->execute();

        // Configurar la sesión
        $_SESSION['Id_est'] = $Id_est;

        switch($nombre_curso) {
            case 'Tercero':
                header("location: ../cursos/Tercero.php");
                break;
            case 'Cuarto':
                header("location: ../cursos/cuarto.php");
                break;
            case 'Quinto':
                header("location: ../cursos/quinto.php");
                break;
            case 'Sexto':
                    header("location: ../cursos/sexto.php");
                    break;
                
        }exit();
    } else {

        $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
        
        // Si se han excedido los intentos máximos, establecer un tiempo de espera de 1 minuto
        if ($_SESSION['login_attempts'] >= 3) {
            $_SESSION['login_wait_time'] = time() + 60;
        }
        header("location: ../login/logEst.php?error=1");
        exit();
        
    } 
} else {
    header("location: ../login/logEst.php?error=2");
    exit(); 
}

mysqli_close($conexion);
?>
