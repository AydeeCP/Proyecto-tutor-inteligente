<?php
    session_start();
    include('../conexion/bd.php');

    $sql="SELECT Id_padres,cedula,nombre_p,apellidos_p,celular,correo_p,lugar_res FROM padres;";
    $resultado=$conexion->query($sql);

    if($resultado->num_rows>0){
        $padres=array();
        while($row=$resultado->fetch_assoc()){
            $padres[]=array(
            'Id_padres'=>$row['Id_padres'],
            'cedula'=>$row['cedula'],
            'nombre_p'=>$row['nombre_p'],
            'apellidos_p'=>$row['apellidos_p']
            );
        }
        echo json_encode(array('success'=>true,'padres'=>$padres));
    } else{
        echo json_encode(array('success'=>false, 'error'=>'No se encontraron docentes registrado'));
    }
    
$conexion->close();
?>
