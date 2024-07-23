<?php
session_start();

// Verificar si la sesión de usuario está iniciada
if(isset($_SESSION['nombre_de_usuario'])) {

    $ci = $_SESSION['nombre_de_usuario'];

    include('../conexion/bd.php');

    $sql = "SELECT pf.*,e.nombre_est,e.apellidos_est
            FROM padres pf
            JOIN estudiantes e ON pf.Id_padres = e.Id_padres
            JOIN curso_est ce ON e.Id_est = ce.Id_est
            JOIN docente d ON ce.Id = d.Id
            WHERE d.ci = '$ci'";

    $resultado = $conexion->query($sql);
    $contador = 0;

    $padres = array();

    if ($resultado->num_rows > 0) {
        // Recorrer los resultados y almacenar los datos de los padres en el array
        while ($row = $resultado->fetch_assoc()) {
            $padres[] = array(
                'cantidad' => $contador++,
                'cedula' => $row['cedula'],
                'nombre_p' => $row['nombre_p'],
                'apellidos_p' => $row['apellidos_p'],
                'celular' => $row['celular'],
                'correo_p' => $row['correo_p'],
                'lugar_res' => $row['lugar_res'],
                'nombre_est'=> $row['nombre_est'],
                'apellidos_est'=> $row['apellidos_est']
            );
        }
        echo json_encode(array('success' => true, 'padres' => $padres));
    }else {
        echo json_encode(array('success' => false, 'error' => 'Por el momento no existe ningún Padre o tutor registrado'));    
    }
    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {

    echo json_encode(array('success' => false, 'error' => 'La sesión de usuario no está iniciada.'));
}
?>
