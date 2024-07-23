<?php
session_start();

if (isset($_SESSION['nombre_de_usuario'])) {
    $ci = $_SESSION['nombre_de_usuario'];

    include("../conexion/bd.php");

    $sql = "SELECT e.nombre_est, e.apellidos_est, ae.tema_practicado, ae.juego_seleccionado, ae.medalla
            FROM actividad_estudiante ae
            JOIN estudiantes e ON ae.Id_est = e.Id_est
            JOIN curso_est ce ON e.Id_est = ce.Id_est
            JOIN docente d ON ce.Id = d.Id
            WHERE d.ci = '$ci' AND ae.medalla IS NOT NULL";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $logros = array();

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $letra_medalla = 'E'; // Default to 'E' for none or bronze
            if ($row['medalla'] === 'oro') {
                $letra_medalla = 'A';
            } elseif ($row['medalla'] === 'plata') {
                $letra_medalla = 'O';
            }
            $logros[] = array(
                'nombre_est' => $row['nombre_est'],
                'apellidos_est' => $row['apellidos_est'],
                'tema_practicado' => $row['tema_practicado'],
                'juego_seleccionado' => $row['juego_seleccionado'],
                'medalla' => $row['medalla'],
                'letra_medalla' => $letra_medalla
            );
        }
        echo json_encode(array('success' => true, 'logros' => $logros));
    } else {
        echo json_encode(array('success' => false, 'error' => 'No se encontraron logros.'));
    }
    $conexion->close();
}
?>
