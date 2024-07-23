<?php
    session_start();

    include('../conexion/bd.php');
    
    if (!isset($_SESSION['nombre_de_usuario'])) {
        header("location: ../login/logDocente.php");
        exit();
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ci = $_SESSION['nombre_de_usuario'];
        $id_docente = $_POST['Id'];
        // Imprimir el ID del docente para verificación
        //echo "ID del docente: " . $id_docente . "<br>";
        // Detener la ejecución temporalmente para verificación
        //die();
        $ci = $_POST['ci'];
        $fecha=$_POST['nacimiento'];
        $sexo=$_POST['sexo'];
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellidos'];
        $telefono=$_POST['telefono'];
        $correo=$_POST['correo'];
        $direccion=$_POST['direccion'];
        $password=$_POST['password'];

        $sql = "UPDATE docente SET ci=?, fecha_nacimiento=?, sexo=?, nombre=?, apellido=?, telefono=?, correo=?, direccion=? , password=? WHERE Id=?";
        $statement = mysqli_prepare($conexion, $sql);
    
        if ($statement) {
            mysqli_stmt_bind_param($statement, "sssssssssi", $ci, $fecha, $sexo, $nombre, $apellido, $telefono, $correo, $direccion, $password, $id_docente);
            mysqli_stmt_execute($statement);
    
            if (mysqli_stmt_affected_rows($statement) > 0) {
                // Los datos se actualizaron correctamente
                echo '<script>alert("Datos actualizados correctamente"); window.location.href="../DocentePP/verDatos.php";</script>';
                exit();
            } else {
                // No se pudo actualizar los datos
                echo '<script>alert("No se puede actualizar los datos"); window.location.href="../DatosD/editarDatosD.php";</script>';
                exit();
            }
        } else {
            // Error en la preparación de la consulta
            header("location: ../DatosD/editarDatosD.php?error=sql_error");
            exit();
        }
    }
    
    // Si se intenta acceder a esta página directamente sin enviar datos por POST, redirigir al perfil del docente
    header("location: ../login/logDocente.php");
    exit();
?>
