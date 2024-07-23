<?php
session_start();
include('../conexion/bd.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cedula'])) {
        $cedula = $_POST['cedula'];

        $_SESSION['cedula'] = $cedula;
        /*INICIO DE VERIFICACION DEL CI INGRESADO*/
        $sql =  "SELECT padres.*, estudiantes.Id_est
                FROM padres
                INNER JOIN estudiantes ON padres.Id_padres = estudiantes.Id_padres
                WHERE padres.cedula = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        $stmt->bind_param("s", $cedula);
        $stmt->execute();
        $result = $stmt->get_result();

        //comprobacion si se encontraron los datos

        if (mysqli_num_rows($result) > 0) {
            $data = $result->fetch_assoc();

            $_SESSION['padre_id'] = $data['Id_padres'];
            $_SESSION['padre_nombre']=$data['nombre_p'];
            $_SESSION['padre_apellidos'] = $data['apellidos_p'];

            $_SESSION['id_estudiante'] = $data['Id_est'];
            
            if (!empty($_SESSION['id_estudiante'])) {
                header("Location: ../home/homePad.php");
                exit();
            } else {
                // Manejo de error si no se define $_SESSION['id_estudiante']
                echo '<script>alert("No se pudo obtener el ID del estudiante");window.location.href="../login/logPad.php";</script>';
            }
        }else{
            echo '<script>alert ("Número de cedula de identidad no registrado");window.location.href="../login/logPad.php";</script>';
            
        }
    }
}
mysqli_free_result($result);
mysqli_close($conexion);


?>