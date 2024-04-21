<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/homeDoc.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <title>Document</title>
</head>
<body>
    <div class="principal">
        <h1><?php include('../datosD/datosD.php');?></h1><br><br>
    </div>
    <div class="salir">
        <a href="../datosD/cerrar.php"><i class='bx bxs-left-arrow-square bx-md bx-fade-left-hover'></i>Salir</a></li>
    </div>

    <div class="contenedorD">
        <div class="datos">
            <img src="../image/datos.jpg" alt="image"  width="250" height="240">
            <div class="enlace">
            <a href="../DocentePP/verDatos.php">Datos personales</a>
            <!--<a href="../datosD/datosG.php">Datos</a>--></div>
        </div>
        <div class="padresL">
            <img src="../image/fam.jpg" alt="image"  width="250" height="240">
            <div class="enlace">
                <a href="#">Lista de padres</a>
            </div>
        </div>
        <div class="estudianteL">
            <img src="../image/estudiantes.jpg" alt="image"  width="270" height="200">
            <div class="enlace">
                <a href="">Lista de <br> estudiantes</a>
            </div>
        </div>
        <div class="seguimiento">
            <img src="../image/seguimiento.png" alt="image"  width="270" height="190">
            <div class="enlace">
                <a href="">Seguimiento de <br> actividades</a>
            </div>
        </div>
    </div>




</body>
</html> 