<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/contadorEst.css"/>
    <title>Pantalla de espera</title>
</head>

<body>

        <div class="gato">
            <!--oreja en ingles ear-->
            <div class="ear ear-l">  </div>
            <div class="ear ear-r"> </div>
            <div class="ojos ojo-l">
                <div class="circle"></div>
            </div>
            <div class="ojos ojo-r">
                <div class="circle"></div>
            </div>
            <div class="nariz"></div>
            <div class="boca"></div>

            <div class="bigote bigote-l">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="bigote bigote-2">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="path">
            <div class="raton">
                <div class="cola"></div>
            </div>
        </div>  

    <div class="form">
        <?php
        session_start();

            if(isset($_SESSION['login_wait_time']) && $_SESSION['login_wait_time'] >time()){
            
                $time_left = $_SESSION['login_wait_time'] - time();

                $minutes = floor($time_left / 60);
                $seconds = $time_left % 60;

                echo'<div class="countdown-container">';
                echo ' <div id="countdown" class="countdown">Intentalo en <span id="timer" class="time">'.$time_left. '</span> segundos</div>';
                echo '</div>';

            }
        ?>  
    </div>
    
    <script>
        var countdownElement =document.getElementById("countdown");
        var timeLeft = <?php echo $_SESSION['login_wait_time'] - time(); ?>;
        var interval=setInterval(function(){
            if(timeLeft<= 0){
                clearInterval(interval);
                window.location.href="logEst.php";
            }else{
                countdownElement.textContent = "Intentalo en "+timeLeft + " segundos";
                timeLeft--;
            }
        },1000);
    </script>
</body>
</html>