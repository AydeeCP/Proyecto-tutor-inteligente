<?php
session_start();


include('../conexion/bd.php');
$Id_est = $_GET['Id_est'];
$fecha_entrada = $_GET['fecha_entrada'];
$sql = "
SELECT 
    fecha_entrada, 
    hora_entrada, 
    fecha_salida,
    hora_salida, 
    TIMESTAMPDIFF(MINUTE, CONCAT(fecha_entrada, ' ', hora_entrada), CONCAT(fecha_salida, ' ', hora_salida)) AS minutos_en_sistema
FROM 
    registro_entradas_salidas
WHERE 
    Id_est = ? AND fecha_entrada = ?
";

$statement = mysqli_prepare($conexion, $sql);

// Verificar si la preparación de la consulta fue exitosa
if ($statement) {
    mysqli_stmt_bind_param($statement, "is", $Id_est, $fecha_entrada);

    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);
    
    // array para almacenar los datos
    $data = [];
    
    // Recorrer el resultado y almacenar cada fila en $data
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    
    // Devolver los datos en formato JSON
    echo json_encode($data);
} else {
    // Si la preparación de la consulta falló, manejar el error aquí
    echo json_encode(['error' => 'Error en la consulta']);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
