<?php
session_start();

include('../conexion/bd.php');

if (!isset($_SESSION['nombre_de_usuario'])) {
    header("location: ../login/logDocente.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!isset($_POST['id_docente'])){
        echo "ERROR: no se ha proporcionado el ID del docente";
        exit();
    }

    $idDocente = $_POST['id_docente'];
    $materia = $_POST['materia'];
    $curso = $_POST['curso'];
    $paralelo = $_POST['paralelo'];
    $cantidad = $_POST['cantidad'];
    $turno = $_POST['turno'];
    $cod_materia = $_POST['cod_materia'];

    $sql ="UPDATE asignatura SET nombre_materia=?, curso=?, paralelo=?, 
    cantAlumn=?, turno=?, codigo_asignatura=? WHERE Id= ?";
    $statement = mysqli_prepare($conexion, $sql);

    if($statement){
        mysqli_stmt_bind_param($statement, "sssissi" ,$materia,$curso,$paralelo,$cantidad,$turno,$cod_materia,$idDocente);
        mysqli_stmt_execute($statement);

        if(mysqli_stmt_affected_rows($statement)>0){
            echo '<script>alert("Datos actualizados correctamente"); window.location.href="../DocentePP/verDatos.php";</script>';
            exit();
        }else {
            // Si hay un error en la consulta, mostrar un mensaje de error o redirigir a otra página
            echo "Error: " . mysqli_error($conexion);
            exit();
        }
        } else {
            // Si no se recibieron datos por POST, mostrar un mensaje de error o redirigir a otra página
            echo "Error: No se recibieron datos del formulario";
            exit();
        }
    }else{
        header("location: ../DatosD/editarCurso.php?error=sql_error");
    exit();

    }
?>
