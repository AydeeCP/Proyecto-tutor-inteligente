<?php

session_start();

/*llamar a nuestro documento de conexion de la base de datos*/

include('../conexion/bd.php');
/*primero se verificara si el numero de cedula de identidad ya se encuentra registrado en nuestra base de datos */

$ci=$_POST['ci'];

$sql_verificacion="SELECT *  FROM docente WHERE ci='$ci'";
$resultado_verificacion=$conexion->query($sql_verificacion);

/*if */
if($resultado_verificacion->num_rows>0){
    echo '<script>alert("Ya existe un registro con el número de cedula de identidad");
    window.location.href="../home/crearD.php";
    </script>';
}else{

    $ci=$_POST['ci'];
    $fecha_nacimiento =$_POST['nacimiento'];
    $sexo=$_POST['sexo'];
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $telefono=$_POST['telefono'];
    $correo=$_POST['correo'];
    $direccion=$_POST['direccion'];
    $password=$_POST['password'];

    $sql = "INSERT INTO docente (ci, fecha_nacimiento, sexo, nombre, apellido, telefono, correo, direccion, password) 
            VALUES ('$ci', '$fecha_nacimiento', '$sexo', '$nombre', '$apellidos', '$telefono', '$correo', '$direccion', '$password')";

    if ($conexion->query($sql) === TRUE) {    
        echo '<script>alert("Datos guardados correctamente"); window.location.href="../home/crearD.php";</script>';
        exit();
    } else {
        echo '<script>alert("Error al guardar los datos");</script>';
    }
}
// Cerrar la conexión
$conexion->close();

?>


