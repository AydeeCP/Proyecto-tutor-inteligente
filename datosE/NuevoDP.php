<?php
    session_start();
    include('../conexion/bd.php');

    /*VERIFICAR SI EXISTE UN REGISTRO*/
    $ci=$_POST['ci'];

    $sql_verificacion="SELECT * FROM padres where cedula='$ci'";
    $resultado_verificacion=$conexion->query($sql_verificacion);
    if($resultado_verificacion->num_rows>0){
        echo '<script>alert("Ya existe un registro con el número de cedula de identidad");
        window.location.href="../home/crearEst.php"</script>';
    }else{
        $ci=$_POST['ci'];
        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
        $fono=$_POST['telefono'];
        $email=$_POST['correo'];
        $residencia=$_POST['residencia'];

        $sql="INSERT INTO padres(cedula,nombre_p,apellidos_p,celular,correo_p,lugar_res) 
        VALUES('$ci','$nombre','$apellidos','$fono','$email','$residencia')";

        if($conexion->query($sql)==TRUE){
            echo '<script>alert("Datos guardados correctamente"); window.location.href="../home/crearEst.php";</script>';
            exit();
        }else{
            echo '<script>alert("Error al guardar los datos");</script>';
        }
    }
$conexion->close();
?>