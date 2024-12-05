<?php
session_start();
include('../conexion/bd.php');
if (!isset($_SESSION['padre_id'])) {
    header("Location: ../login/logPad.php");
    exit();
}

if (isset($_POST['id_estudiante'])) {

    $idEstudiante = $_POST['id_estudiante'];
    
    $sql = "SELECT e.nombre_est, e.apellidos_est, ae.*
            FROM actividad_estudiante ae
            JOIN estudiantes e ON ae.Id_est = e.Id_est
            WHERE ae.Id_est = ?";
    // Preparar la consulta
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . $conexion->error);
    }

    // Vincular parámetros y ejecutar consulta
    $stmt->bind_param("i", $idEstudiante);
    $stmt->execute();

    // Obtener resultados
    $resultado = $stmt->get_result();

    // Procesar resultados
    $contador = 0;
    $actividades = array();

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            // Formatear la fecha para que solo muestre la fecha sin la hora
            $fechaActividad = date("Y-m-d", strtotime($row['fecha_actividad']));

            $actividades[] = array(
                'cantidad' => $contador++,
                'nombre_est' => $row['nombre_est'],
                'apellidos_est' => $row['apellidos_est'],
                'opcion_navbar' => $row['opcion_navbar'],
                'tema_practicado' => $row['tema_practicado'],
                'juego_seleccionado' => $row['juego_seleccionado'],
                'palabrasAcertadas' => $row['palabrasAcertadas'],
                'vecesJugadas' => $row['vecesJugadas'],
                'fecha_actividad' =>$fechaActividad
            );
        }
        echo json_encode(array('success' => true, 'actividades' => $actividades));
    } else {
        echo json_encode(array('success' => false, 'error' => 'No se encontraron actividades asociadas al estudiante.'));
    }

    // Cerrar la conexión y liberar resultados
    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(array('success' => false, 'error' => 'No se proporcionó el ID del estudiante.'));
}
?>
