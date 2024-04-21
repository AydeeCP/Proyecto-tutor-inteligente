<?php
// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificamos si se reciben los datos esperados
    if(isset($_POST['docente']) && isset($_POST['id_docente']) && isset($_POST['cod_materia']) && isset($_POST['materia']) && isset($_POST['paralelo']) && isset($_POST['cantidad']) && isset($_POST['turno'])) {


        // Obtenemos los datos del formulario
        $docente = $_POST['docente'];
        $id_docente = $_POST['id_docente'];
        $cod_materia = $_POST['cod_materia'];
        $materia = $_POST['materia'];
        $curso = $_POST['curso'];
        $paralelo = $_POST['paralelo'];
        $cantidad = $_POST['cantidad'];
        $turno = $_POST['turno'];

    
        include('../conexion/bd.php'); // Incluir el archivo de conexión

        // Preparar la consulta SQL para insertar los datos en la tabla asignatura (ID)id del docente
        $sql = "INSERT INTO asignatura (codigo_asignatura, nombre_materia, curso,paralelo, cantAlumn, turno,Id) VALUES (?,?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        // Verificar si la preparación fue exitosa
        if ($stmt) {
            // Vincular los parámetros con los valores
            $stmt->bind_param("ssssisi", $cod_materia, $materia, $curso,$paralelo, $cantidad, $turno, $id_docente);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo '<script>alert("Datos registrados correctamente"); window.location.href="../home/crearD.php";</script>';
            } else {
                echo '<script>alert("Error al crear la asignatura: ")</script>';
            }
        } else {
            echo "Error en la preparación de la consulta: " . $conexion->error;
        }

        // Cerrar la conexión
        $conexion->close();
    } else {
        echo "No se recibieron todos los datos esperados". implode(', ', $datosFaltantes);
        exit; // Detenemos el script;
    }
} else {
    echo "El formulario no se ha enviado";
}
?>
