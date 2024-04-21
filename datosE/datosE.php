<?php
    session_start();

    if(!isset($_SESSION['contrasena'])){
        header("location: ../login/logEst.php");
        exit();
    }

    include('../conexion/bd.php');

    $contrasena=$_SESSION['contrasena'];

    
    $nombre_estudiante = ''; 

    // Consulta SQL para obtener los datos del estudiante y el curso
    $consulta = "SELECT estudiante.nombre_est, estudiante.apellidos_est,estudiante.genero, curso_est.nivel_curso AS nombre_curso 
            FROM estudiantes AS estudiante 
            INNER JOIN curso_est ON estudiante.Id_est = curso_est.Id_est 
            WHERE estudiante.cedula_est = ?";
    
    $statement = mysqli_prepare($conexion, $consulta);
    
    if ($statement) {

        mysqli_stmt_bind_param($statement, "s", $contrasena);
        

        mysqli_stmt_execute($statement);
        

        mysqli_stmt_bind_result($statement, $nombre_estudiante, $apellidos_estudiante, $genero,$nombre_curso);
        

        mysqli_stmt_fetch($statement);

        if ($nombre_estudiante !== null) {
            if ($genero === 'Femenino') {
                $saludo = "Bienvenida";
            } else {
                $saludo = "Bienvenido";
            }
            echo  $nombre_estudiante . " " . $apellidos_estudiante .": " ;
            echo $nombre_curso ; 
        } else {
            echo "No se encontraron datos de usuario";
        }
        

        mysqli_stmt_close($statement);
    } else {
        // Manejar el caso en que la preparación de la consulta falló
        echo "Error al preparar la consulta";
    }
    
    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
?>