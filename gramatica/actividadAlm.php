<?php
session_start();

if (isset($_SESSION['nombre_de_usuario'])) {
    $ci = $_SESSION['nombre_de_usuario'];
    $tema = isset($_GET['tema']) ? $_GET['tema'] : 'todos';
    $idEstudiante = isset($_GET['idEstudiante']) ? $_GET['idEstudiante'] : '';

    include("../conexion/bd.php");

    // Construir la consulta SQL basada en el tema seleccionado
    $sql = "SELECT e.nombre_est, e.apellidos_est, ae.*
            FROM actividad_estudiante ae
            JOIN estudiantes e ON ae.Id_est = e.Id_est
            JOIN curso_est ce ON e.Id_est = ce.Id_est
            JOIN docente d ON ce.Id = d.Id
            WHERE d.ci = ?";

    // Añadir filtros adicionales a la consulta
    $params = [$ci];
    $types = 's';

    if ($tema !== 'todos') {
        $sql .= " AND ae.tema_practicado = ?";
        $params[] = $tema;
        $types .= 's';
    }

    if (!empty($idEstudiante)) {
        $sql .= " AND e.Id_est = ?";
        $params[] = $idEstudiante;
        $types .= 'i';
    }

    // Preparar y ejecutar la consulta
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $resultado = $stmt->get_result();
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
                'fecha_actividad' => $fechaActividad
            );
        }
        echo json_encode(array('success' => true, 'actividades' => $actividades));
    } else {
        if ($tema === 'todos') {
            echo json_encode(array('success' => false, 'error' => 'No se encontraron actividades realizadas.'));
        } else {
            echo json_encode(array('success' => false, 'error' => 'Aún ningún estudiante ha realizado actividades en el tema seleccionado.'));
        }
    }
    $conexion->close();
}
?>
