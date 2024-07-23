<?php
session_start();

if (isset($_SESSION['nombre_de_usuario'])) {
    $ci = $_SESSION['nombre_de_usuario'];

    include("../conexion/bd.php");

    // Obtener nombres completos de los estudiantes
    $sql = "SELECT e.Id_est AS id, CONCAT(e.nombre_est, ' ', e.apellidos_est) AS nombre_completo
            FROM estudiantes e
            JOIN curso_est ce ON e.Id_est = ce.Id_est
            JOIN docente d ON ce.Id = d.Id
            WHERE d.ci = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $ci);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $estudiantes = array();

    while ($row = $resultado->fetch_assoc()) {
        $estudiantes[] = $row;
    }

    echo json_encode(array('success' => true, 'estudiantes' => $estudiantes));
    $conexion->close();
}
?>
