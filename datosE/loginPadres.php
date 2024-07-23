<?php
    session_start();

    include('../conexion/bd.php');

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        if (isset($_POST['cedula'])){
            $cedula = $_POST['cedula'];
        /*INICIO DE VERIFICACION DEL CI INGRESADO*/
        $sql =  "SELECT * FROM padres WHERE cedula =?";
        $stmt = mysqli_prepare($conexion, $sql);
        $stmt->bind_param("s",$cedula);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows>0){
            $padre = $result->fetch_assoc();
            $id_padres =$padre['Id_padres'];
            
            $sql_hijo="SELECT * FROM estudiantes WHERE Id_padres=?";
            $stmt_hijo = mysqli_prepare($conexion, $sql_hijo);
            $stmt_hijo->bind_param("i",$id_padres);
            $stmt_hijo->execute();
            $result_hijo=$stmt_hijo->get_result();

            echo "<h2>Datos del padre</h2>";
            echo "Nombre: ".$padre['nombre_p']."".$padre['apellidos_p']."<br>";
            echo "celular: ".$padre['celular']."<br>";
            echo "Correo: ".$padre['correo_p']. "<br>";
            echo "Lugar de residencia: ".$padre['lugar_res']."<br>";

            echo "<h2>Datos del hijo</h2>";
            while ($hijo = $result_hijo->fetch_assoc()){
                echo "Nombre: ".$hijo['nombre_est']."".$hijo['apellidos_est']."<br>";
                echo "CI: ".$hijo['cedula_est']."<br>";
                echo "Fecha de nacimiento: ".$hijo['nacimiento_est']."<br>";
                echo "Género: ".$hijo['genero']."<br>";
                echo "Lengua materna: ".$hijo['lengua_materna']."<br>";
                echo "<br>";
            }
        }else{
            echo "Numero de carnet de identidad no valido";
        }
    }else{
        echo"Por favor, ingrese su número de carnet de identidad";
    }
    }
mysqli_close($conexion);
?>