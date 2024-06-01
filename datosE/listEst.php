<?php
session_start();

// Verificar si la sesión de usuario está iniciada
if(isset($_SESSION['nombre_de_usuario'])) {

    $ci = $_SESSION['nombre_de_usuario'];

    include('../conexion/bd.php');

    $sql = "SELECT e.*
        FROM estudiantes e
        JOIN curso_est ce ON e.Id_est = ce.Id_est
        JOIN docente d ON ce.Id = d.Id
        WHERE d.ci = '$ci'";

    $resultado = $conexion->query($sql);
    $contador = 0;
    $estudiantes = array();
    

    if ($resultado->num_rows > 0) {
        // Recorrer los resultados y almacenar los datos de los padres en el array
        while ($row = $resultado->fetch_assoc()) {
            $contador++; 
            $estudiantes[] = array(
                'cantidad' => $contador++,
                'cedula_est' => $row['cedula_est'],
                'nacimiento_est' => $row['nacimiento_est'],
                'nombre_est' => $row['nombre_est'],
                'apellidos_est' => $row['apellidos_est'],
                'lengua_materna' => $row['lengua_materna']
            );
        }

        echo json_encode(array('success' => true,'estudiantes' => $estudiantes));
    }else {
        echo json_encode(array('success' => false, 'error' => 'Por el momento no existe ningún estudiante registrado'));    
    }
    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {

    echo json_encode(array('success' => false, 'error' => 'La sesión de usuario no está iniciada.'));
}
?>
