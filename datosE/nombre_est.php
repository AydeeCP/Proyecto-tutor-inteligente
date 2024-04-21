<?php

    session_start();
    include('../conexion/bd.php');

    $sql="SELECT * FROM estudiantes;";
    $resultado=$conexion->query($sql);

    if($resultado->num_rows>0){
        $estudiantes=array();
        while($row=$resultado->fetch_assoc()){
            $estudiantes[]=array(
            'Id_est'=>$row['Id_est'],
            'cedula_est'=>$row['cedula_est'],
            'nombre_est'=>$row['nombre_est'],
            'apellidos_est'=>$row['apellidos_est']
            );
        }
        echo json_encode(array('success'=>true,'estudiantes'=>$estudiantes));
    } else{
        echo json_encode(array('success'=>false, 'error'=>'No se encontraron docentes registrado'));
    }
    
$conexion->close();
?>

