<?php
// Iniciar la sesión si no está iniciada
session_start();

// Verificar la sesión del usuario
if (!isset($_SESSION['nombre_de_usuario'])) {
    header("location: ../login/logDocente.php");
    exit();
}

// Incluir archivo de conexión a la base de datos
include('../conexion/bd.php');

// Obtener el ID del docente de la sesión
$docente_id = $_SESSION['docente_id'];

// Consulta SQL para obtener las respuestas de los estudiantes asociados al docente
$sql = "
SELECT r.IdRespuesta,r.Id_est,r.QSocial1,r.QSocial2,r.QSocial3,r.QSocial4,r.fecha_respuesta,e.nombre_est,e.apellidos_est
FROM respuestas r
JOIN estudiantes e ON r.Id_est = e.Id_est
JOIN curso_est c ON e.Id_est = c.Id_est
WHERE c.Id = ?
ORDER BY e.apellidos_est, e.nombre_est, r.fecha_respuesta;
";

// Preparar la consulta
$statement = mysqli_prepare($conexion, $sql);
if ($statement === false) {
    die('Error al preparar la consulta: ' . mysqli_error($conexion));
}

// Vincular parámetros
mysqli_stmt_bind_param($statement, "i", $docente_id);

// Establecer la codificación de caracteres a UTF-8
mysqli_set_charset($conexion, "utf8");

// Ejecutar la consulta
mysqli_stmt_execute($statement);

// Obtener resultados
$result = mysqli_stmt_get_result($statement);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Devolver los datos como JSON
echo json_encode($data);

// Cerrar la consulta y liberar recursos
mysqli_stmt_close($statement);
mysqli_close($conexion);
?>
