<?php
session_start();
include ('../conexion/bd.php');

if (!isset($_SESSION['padre_id'])) {
    header("Location: ../login/logPad.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $padre_id = $_SESSION['padre_id'];
    $ci = $_POST['ci'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $residencia = $_POST['residencia'];

    // Verificar los datos recibidos
    echo "Datos recibidos:<br>";
    echo "ID: " . htmlspecialchars($padre_id) . "<br>";
    echo "CI: " . htmlspecialchars($ci) . "<br>";
    echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
    echo "Apellidos: " . htmlspecialchars($apellidos) . "<br>";
    echo "Teléfono: " . htmlspecialchars($telefono) . "<br>";
    echo "Correo: " . htmlspecialchars($correo) . "<br>";
    echo "Residencia: " . htmlspecialchars($residencia) . "<br>";

    $sql = "UPDATE padres SET cedula=?, nombre_p=?, apellidos_p=?, celular=?, correo_p=?, lugar_res=? WHERE Id_padres=?";
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssssi", $ci, $nombre, $apellidos, $telefono, $correo, $residencia, $padre_id);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Datos actualizados correctamente"); window.location.href="../padres/mostrarDP.html";</script>';
        } else {
            echo '<script>alert("No se puede actualizar los datos: ' . mysqli_stmt_error($stmt) . '"); window.location.href="../padres/pantallaED.html";</script>';
            exit();
        }
        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Error al preparar la consulta: ' . mysqli_error($conexion) . '"); window.location.href="../padres/pantallaED.html";</script>';
        exit();
    }

    mysqli_close($conexion);
}
?>
