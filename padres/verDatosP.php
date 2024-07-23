<?php
    session_start();
    include ('../conexion/bd.php');

    if(!isset($_SESSION['padre_id'])){
        header("Location:../login/logPad.php");
        exit();
    }
    $padre_id = $_SESSION['padre_id'];
    
    $sql = "SELECT * FROM padres WHERE Id_padres=?";
    $stmt = mysqli_prepare($conexion, $sql);
    $stmt->bind_param("i", $padre_id);
    $stmt->execute();
    $result=$stmt->get_result();

    if($result->num_rows>0){
        $padre = $result->fetch_assoc();
        
        header('Content-Type: application/json');
        echo json_encode($padre);
    }else{
        echo "No se encontraron datos de registro";
        exit();
    }
    mysqli_free_result($result);
mysqli_close($conexion);

?>