<?php
session_start();

if (!isset($_SESSION['nombre_de_usuario'])) {
    header("location: ../login/logDocente.php");
    exit();
}

include('../conexion/bd.php');

$docente_id = $_SESSION['docente_id'];

$sql = "
SELECT e.Id_est, e.nombre_est,e.apellidos_est,r.fecha_entrada, COUNT(*) AS numero_de_inicios
FROM registro_entradas_salidas r
JOIN estudiantes e ON r.Id_est = e.Id_est
JOIN curso_est c ON e.Id_est = c.Id_est
WHERE c.Id = ?
GROUP BY e.Id_est, r.fecha_entrada
ORDER BY r.fecha_entrada DESC";

$statement = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($statement, "i", $docente_id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>