<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/styleLogin.css" />

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Inicio de sesion Docente</title>
</head>

<body>
    <div class="message">
        <p>Si aún no tienes cuenta, haz clic aquí para registrarte.</< /p><br>
            <button class="sign-up-btn" onclick="window.location.href='../home/crearD.php'">Registrarse</button>
    </div>
    <!--REGISTRO-->
    <form class="formulario" action="../datosD/validarD.php" method="POST">
        <!--opciones de los botones outputs-->
        <h2 class="create-account">Yatichiri : Profesor</h2>
        <input type="text" placeholder="Cédula de identidad" id="username" name="carnet" required />
        <div class="pass">
            <input type="password" placeholder="Contraseña" id="password" name="password" autocomplete="current-password" required />
            <i class='bx bxs-face-mask bx-sm bx-border'></i>
        </div>
        <button class="botonI" id="entrar">Mantaña : Entrar</button>
        <div class="volver">
            <a href="../index.html" class="volver1"> Mistuña : Salir </a>
        </div>
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo "
                            
                            <p class='error'>Error en la autenticacion de datos</p>
                            
                        ";
        }
        if (isset($_GET['sesion']) && $_GET['sesion'] == 1) {
            echo "
                        <p class='sesion'>Sesion Cerrada correctamente</p>
                    ";
        }
        ?>

    </form>

    <script src="../js/log.js"></script>
</body>

</html>