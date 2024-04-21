<?php

session_start();
//verificacion si el usuario inicio sesion
if(!isset($_SESSION['carnet'])){
    header("location: ../login/logDocente.php");
    exit(); 
}

include('../conexion/bd.php');

$carnet=$_SESSION['carnet'];

$consulta = "Select * FROM docente WHERE ci='$carnet'";
$resultado = mysqli_query($conexion,$consulta);

//comprobacion si se encontraron los datos

if(mysqli_num_rows($resultado)>0){
    $usuario = mysqli_fetch_assoc($resultado);
    if($usuario['sexo']=='Femenino'){
        $saludo="Bienvenida";
    }else{
        $saludo="Bienvenido";
    }
    echo $saludo." " .$usuario['nombre']." ".$usuario['apellido'];

}else{
    echo"No se encontraron datos de usuario";
}

mysqli_free_result($resultado);
mysqli_close($conexion);


?>