<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    
    <link rel="stylesheet" href="../css/crearEst.css" />
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://kit.fontawesome.com/b7d880e1e6.js" crossorigin="anonymous"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Registro de datos Estudiante</title>
</head>
<body>
    
    <!--CONTENEDOR DE LOS FORMULARIOS-->
    <div class="container-form">
        <!--Barra de progreso-->
        <div class="containerProg">
            <div class="pasos" id="pasos">
                <span class="circle active">1</span>
                <span class="circle">2</span>
                <span class="circle">3</span>
                <span class="circle">4</span>
                <div class="progreso">
                    <span class="indicador"></span>
                </div>
            </div>
        </div>
        <!--Formulario 1 PADRES-->
        <form class="formulario1" id="formulario1" name="formulario1" method="POST">
            <!--datos del padre-->
            <div class="datos-padres">
                <h2>Papás</h2>
                <input type="text" id="ci" name="ci" placeholder="cedulad de identidad" />
                <input type="text" id="nombre" name="nombre" placeholder="Suti">
                <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" />
                <input type="tel" id="telefono" name="telefono" placeholder="Chililirima" />
                <input type="email" id="correo" name="correo" placeholder="Correo electronico"  />
                <input type="text" id="residencia" name="residencia" placeholder="Lugar que residencia" />
            </div>
            <div class="bonton1">
                <button class="guardar" id="guardarD" name="guardarD" type="submit" formaction="../datosE/NuevoDP.php">Guardar</button>
                <button class="botonA1" id="siguiente" name="siguiente" type="button">Siguiente</button>
            </div>
        </form>
        <!--Formulario 2 ESTUDIANTE-->
        <form class="formulario2" id="formulario2" name="formulario2" method="POST">
            <!--Mostrar los nombres de los padres registrados-->
            <h2>verifica si tu nombre se encuentra en la base de datos</h2>
            <div class="listPadres">
                <i class='bx bx-search-alt bx-sm bx-tada'></i>
                <select name="padres" id="padres">
                    <option value="">Seleccione su nombre</option>
                </select>
            </div>
            <input type="hidden" name="Id_padres" id="Id_padres" value=""/>
            <!--datos del estudiante-->
            <div class="estudiante">
                <div class="cie">
                    <input type="text" id="ciEst" name="ciEst" placeholder="cedula de identidad" required/>
                    <input type="date" id="fechEst" name="fechEst">   
                </div><!--genero del estudiante-->
                <div class="genero">
                    <input type="radio" id="hombre" name="genero" value="Masculino" required >
                    <label for="hombre" class="text-s">Chacha</label>
                    <input type="radio" id="mujer" name="genero" value="Femenino" >
                    <label for="mujer" class="text-s">Warmi</label>
                </div>
                <div class="datosP">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre completo">
                    <input type="text" id="apellidos_est" name="apellidos_est" placeholder="apellidos">
                </div>   
                    <input type="text" id="lengMat" name="lengMat" placeholder="Lengua Materna"/>
                
            </div>
            <div class="bonton2">
                <button class="guardar" id="guardarEst" name="guardarEst" type="submit" formaction="../datosE/NuevoDE.php">Guardar</button>
                <button class="botonB" id="volver" type="button">atras</button>
                <button class="botonA2" id="siguiente2" name="siguiente2" type="submit">Siguiente</button>
            </div>

        </form>
        <!--Formulario 3 DATOS DEL CURSO-->
        <form class="formulario3" id="formulario3" name="formulario3" method="POST">
            <!--Mostrar los nombres del Estudiante-->
            <h1>verifica si tu nombre se encuentra en la base de datos</h1>
            <div class="listEst">
                <i class='bx bx-search-alt bx-sm bx-tada'></i>
                <select name="estudiantes" id="estudiantes">
                    <option value="">Seleccione su nombre</option>
                </select>
            </div>
            <input type="hidden" name="Id_est" id="Id_est" value=""/>
            <!--Datos del nivel de curso-->
            <div class="curso">
                <label for="curso" class="curso" id="cont">Curso: </label>
                <div id="curso-m" class="select-cont">
                    <select name="curso" id="curso" class="let">
                        <option value="">--</option>
                        <option value="Tercero">3ro Tercero</option>
                        <option value="Cuarto">4to Cuarto</option>
                        <option value="Quinto">5to Quinto</option>
                        <option value="Sexto">6to Sexto</option>
                    </select>
                    <!--AÑADIMOS IMAGEN-->
                    <div class="select-icon">
                        <i class="fa-solid fa-circle-chevron-down"></i>
                    </div>
                </div>
            </div>
            <!--datos del paralelo-->
            <div class="paralelo">
                <label for="paralelo" class="paralelo" id="cont">Paralelo: </label>
                <div id="paralelo-m" class="select-cont">
                    <select name="paralelo" id="paralelo" class="let">
                        <option value="">--</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                    <!--AÑADIMOS IMAGEN-->
                    <div class="select-icon">
                        <i class="fa-solid fa-circle-chevron-down"></i>
                    </div>
                </div>
            </div>
            <div class="materia">
                <input type="text" placeholder="Asignatura" class="asig" name="materia" />
            </div>
            <div class="bonton3">
                <button class="guardar" id="guardarCurso" name="guardarCurso" type="submit" formaction="../datosE/NuevoCurso.php">Guardar</button>
                <button class="botonB" id="volver1" type="button">atras</button>
                <button class="botonA3" id="siguiente3" name="siguiente3" type="button">Siguiente</button>
            </div>

        </form>
        <!--Formulario 4-->
        <form  class="formulario4" id="formulario4" name="formulario4">
        <img src="../image/entrar.jpg" height="75%" width="90%"/>
        <div class="boton4">
            <a class="botonI" id="entrar" href="../login/logEst.php">Mantaña</a>
            <button class="botonB1" id="volver2" type="button">atras</button>
        </div>
        </form>
        <div class="volver">
            <a href="../login/logEst.php" class="volver1">
                Salir
            </a>
        </div>
    </div>
    <script src="../js/NuevoEst.js"></script>

</body>
</html>