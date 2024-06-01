<?php
session_start();

if(isset($_SESSION['nombre_de_usuario'])){
    
    $ci = $_SESSION['nombre_de_usuario'];
    
    include("../conexion/bd.php");

    $sql = "SELECT e.nombre_est, e.apellidos_est,ae.*
            FROM actividad_estudiante ae
            JOIN estudiantes e ON ae.Id_est = e.Id_est
            JOIN curso_est ce ON e.Id_est = ce.Id_est
            JOIN docente d ON ce.Id = d.Id
            WHERE d.ci = '$ci'";
    $resultado = $conexion -> query($sql);
    $contador=0;
    $actividades = array();

    if($resultado->num_rows > 0){
        while($row = $resultado->fetch_assoc()){
            $actividades[]=array(
                'cantidad' => $contador++,
                'nombre_est'=>$row['nombre_est'],
                'apellidos_est'=>$row['apellidos_est'],
                'opcion_navbar' => $row['opcion_navbar'],
                'tema_practicado'=>$row['tema_practicado'],
                'juego_seleccionado'=>$row['juego_seleccionado'],
                'palabrasAcertadas'=>$row['palabrasAcertadas'],
                'vecesJugadas'=>$row['vecesJugadas'],
                'fecha_actividad'=>$row['fecha_actividad']
            );
        }
        echo json_encode(array('success'=>true,'actividades'=>$actividades));
    }else{
        echo json_encode(array('success'=>false,'error' => 'No se encontraron actividades asociadas al docente.'));
    }
    $conexion->close();
}else{
    echo json_encode(array('success'=>false,'error' => 'La sesión de usuario no está iniciada.'));
}
?>