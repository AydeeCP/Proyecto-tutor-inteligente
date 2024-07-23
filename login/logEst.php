<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleLogEst.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <title>Inicio sesion Estudiante</title>
</head>
<body>
    
    <form class="formulario" action="../datosE/validarE.php" method="POST">
        <!--formulario letra de arriba-->
        <h2 class="cuenta">Yatiqiri : Estudiante</h2>
        <input type="text" placeholder="Suti : Nombre" id="user" name="user" required >
        <div class="pass">
            <input type="password" placeholder="Cedula de identidad" id="contrasena" name="contrasena" required>
            <!--icono de mostrar contraseña-->
            <i class='bx bxs-face-mask bx-border'></i>
        </div>
        <button class="botonE" id="entrar" name="entrar">Mantaña : Entrar</button>
            <div class="volver">
                <a href="../index.html" class="volver1">Mistuña : Salir</a>
            </div>
        <!--validacion del usuario no tocar PHP-->
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

    <div class="message">
            <p>Si aún no tienes cuenta, haz clic aquí para registrarte.</p>
            <button class="sign-up-btn" onclick="window.location.href='../home/crearEst.php'">Registrarse</button>
    </div>
    <script src="../js/logE.js"></script>

</body>
</html>