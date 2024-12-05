<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleLogin.css">
    <title>Iniciar sesión Padre/Tutor</title>
</head>
<body>
    <form action="../padres/validarPad.php" method="POST" class="formulario">
        <h2>Número de cédula de identidad</h2>
        <input type="text" id="cedula" name="cedula" required>
        <button type="submit" class="botonE" id="entrar" name="entrar">Mantaña : Entrar</button>
        <div class="volver">
            <a href="../index.html" class="volver1"> Mistuña : Salir </a>
        </div>
        <?php
                    if(isset($_GET['error']) && $_GET['error']==1){
                        echo"
                            
                            <p class='error'>Error en la autenticacion de datos</p>
                            
                        ";
                    }
                    if(isset($_GET['sesion']) && $_GET['sesion']==1){
                    echo"
                        <p class='sesion'>Sesion Cerrada correctamente</p>
                    ";
                    }
                ?>
    </form>
</body>
</html>