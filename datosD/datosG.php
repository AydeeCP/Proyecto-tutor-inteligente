<?php
session_start();

include('../conexion/bd.php');

// Verificar si se ha iniciado sesión y obtener el nombre de usuario del docente
if (!isset($_SESSION['nombre_de_usuario'])) {
    // Si no se ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("location: ../login/logDocente.php");
    exit();
}

$nombre_usuario = $_SESSION['nombre_de_usuario'];

// Consulta SQL para obtener los datos del docente
$sql_docente = "SELECT * FROM docente WHERE ci = '$nombre_usuario'";

$resultado_docente = $conexion->query($sql_docente);

// Consulta SQL para obtener los datos de la asignatura
$sql_asignatura = "SELECT a.*
                FROM asignatura a
                INNER JOIN docente d ON a.Id = d.Id
                WHERE d.ci = '$nombre_usuario'";

$resultado_asignatura = $conexion->query($sql_asignatura);

if ($resultado_docente->num_rows > 0 && $resultado_asignatura->num_rows > 0) {
    // Obtener los datos del docente
    $row_docente = $resultado_docente->fetch_assoc();
    $docente = array(
        'Id' => $row_docente['Id'],
        'ci' => $row_docente['ci'],
        'fecha' => $row_docente['fecha_nacimiento'],
        'sexo' => $row_docente['sexo'],
        'nombre' => $row_docente['nombre'],
        'apellido' => $row_docente['apellido'],
        'telefono' => $row_docente['telefono'],
        'correo' => $row_docente['correo'],
        'direccion' => $row_docente['direccion'],
        'contraseña' => $row_docente['password']
    );
    // Obtener los datos de la asignatura
    $row_asignatura = $resultado_asignatura->fetch_assoc();
    $asignatura = array(
        'materia' => $row_asignatura['nombre_materia'],
        'curso' => $row_asignatura['curso'],
        'paralelo' => $row_asignatura['paralelo'],
        'cantidad' => $row_asignatura['cantAlumn'],
        'codigo' => $row_asignatura['codigo_asignatura'],
        'turno' =>$row_asignatura['turno']
    );

    // Combinar los datos del docente y la asignatura en un solo arreglo
    $datos = array(
        'docente' => $docente,
        'asignatura' => $asignatura
    );

    // Mostrar datos
    echo json_encode(array('success' => true, 'datos' => $datos));
} else {
    echo json_encode(array('success' => false, 'error' => 'No se encontraron datos de docente y asignatura'));
}

$conexion->close();
?>