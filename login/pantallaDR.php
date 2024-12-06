
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/contador.css"/>
    <title>Pantalla de espera</title>
</head>


<body>
    <div class="fondo">
        <div class="contenido">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        </div> 
        <?php
        session_start();
                    
        if (isset($_SESSION['login_wait_time']) && $_SESSION['login_wait_time'] > time()) {
             // Calcular el tiempo restante en segundos
            $time_left = $_SESSION['login_wait_time'] - time();

            // Convertir el tiempo restante a minutos y segundos
            $minutes = floor($time_left / 60);
            $seconds = $time_left % 60;

            // Mostrar el tiempo restante en el formulario de inicio de sesión
            echo '<div class="countdown-container">';
            echo '    <div id="countdown" class="countdown">Intentalo en<span id="timer" class="time">' . $time_left . '</span> segundos</div>';
            echo '</div>';
        }
    ?>
    </div>


    <script>
        // Cuenta regresiva en JavaScript
        var countdownElement = document.getElementById("countdown");
        var timeLeft = <?php echo $_SESSION['login_wait_time'] - time(); ?>;
        var interval = setInterval(function() {
            if (timeLeft <= 0) {
                clearInterval(interval);
                window.location.href = "logDocente.php"; 
            } else {
                countdownElement.textContent = "Inténtalo en "+timeLeft + " segundos";
                timeLeft--;
            }
        }, 1000);
    </script>
</body>
</html>