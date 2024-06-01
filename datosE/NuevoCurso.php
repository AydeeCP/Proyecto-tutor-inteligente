<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(isset($_POST['estudiantes'])&& isset($_POST['Id_est']) && isset($_POST['curso'])&&isset($_POST['paralelo'])&&isset($_POST['materia'])&&isset($_POST['Id'])){

        $est=$_POST['estudiantes'];
        $idEs=$_POST['Id_est'];
        $curso=$_POST['curso'];
        $paralelo=$_POST['paralelo'];
        $materia=$_POST['materia'];
        $idDocente=$_POST['Id'];

        include('../conexion/bd.php');

        $sql="INSERT INTO curso_est (Id_est,nivel_curso,paralelo,materia,Id) VALUES(?,?,?,?,?)";

        $stmt = $conexion->prepare($sql);
        
        if($stmt){
            $stmt->bind_param("isssi",$idEs,$curso,$paralelo,$materia,$idDocente);
            if ($stmt->execute()) {
                echo '<script>alert("Datos registrados correctamente"); window.location.href="../home/crearEst.php";</script>';
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
