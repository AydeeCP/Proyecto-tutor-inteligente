<?php
    ($_SERVER["REQUEST_METHOD"] =="POST");

    if(isset($_POST['padres']) && ($_POST['Id_padres']) && isset($_POST['ciEst']) && isset($_POST['fechEst'])&& isset($_POST['lengMat'])){

        $ci_est=$_POST['ciEst'];


        include('../conexion/bd.php');


        $sql_verificacion="SELECT * FROM estudiantes where cedula_est='$ci_est'";
        $resultado_verificacion=$conexion->query($sql_verificacion);
        if($resultado_verificacion->num_rows>0){
            echo '<script>alert("Ya existe un registro con el número de cedula de identidad");
            window.location.href="../home/crearEst.php"</script>';
        }else{
            $padre=$_POST['padres'];
            $id_padres=$_POST['Id_padres'];
            $ci_est=$_POST['ciEst'];
            $fechEst=$_POST['fechEst'];
            $genero=$_POST['genero'];
            $nombre=$_POST['nombre'];
            $apellidos=$_POST['apellidos_est'];
            $len=$_POST['lengMat'];
            
        $sql="INSERT INTO estudiantes (cedula_est,nacimiento_est,genero,nombre_est,apellidos_est,lengua_materna,Id_padres) VALUES (?,?,?,?,?,?,?)";
        $stmt=$conexion->prepare($sql);

        if($stmt){
            $stmt->bind_param("ssssssi",$ci_est,$fechEst,$genero,$nombre,$apellidos,$len,$id_padres);
            
            if ($stmt->execute()){
                echo '<script>alert("Datos registrados correctamente");
                window.location.href="../home/crearEst.php";</script>';
            }else{
                echo"error en la preparacion de la consulta: ".$conexion->error;
            }
            $conexion->close();
        }else{
            echo "No se recibieron todos los datos esperados". implode(', ', $datosFaltantes);
        exit;
        } 
    }
    }else {
        echo "El formulario no se ha enviado";
    }
?>