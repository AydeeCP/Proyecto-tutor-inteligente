<?php
session_start();

include('../conexion/bd.php');


$sql="SELECT Id,ci, 
CONCAT(UCASE(LEFT(nombre, 1)), LCASE(SUBSTRING(nombre, 2))) AS nombre, 
CONCAT(UCASE(LEFT(apellido, 1)), LCASE(SUBSTRING(apellido, 2))) AS apellido 
FROM 
docente;";

$resultado=$conexion->query($sql);

if($resultado->num_rows>0){
    $docentes=array();

    while($row=$resultado->fetch_assoc()){

        $docentes[]=array(
        'Id'=>$row['Id'],
        'ci'=>$row['ci'], 
        'nombre'=>$row['nombre'],
        'apellido'=>$row['apellido']);
    }
//mostrar datos
    echo json_encode(array('success'=>true, 'docente'=>$docentes));
} else{
    echo json_encode(array('success'=>false, 'error'=>'No se encontraron docentes registrado'));
}

$conexion->close();
?>