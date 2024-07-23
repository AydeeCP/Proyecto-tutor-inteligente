<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <link rel="stylesheet" href="../css/crearUsuarioD.css" />

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://kit.fontawesome.com/b7d880e1e6.js" crossorigin="anonymous"></script>
    <!-- icono contraseña-->
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!--json para mostrar los datos-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Document</title>
</head>

<body> 
    <div class="container-form sign-in">
        <!--barra de progreso-->
        <div class="containerProg">
            <div class="pasos" id="pasos">
                <span class="circle active">1</span>
                <span class="circle">2</span>
                <span class="circle">3</span>
                <div class="progreso">
                    <span class="indicador"></span>
                </div>
            </div>
        </div>

        <!--FORMULARIO DE REGISTRO DATOS DOCENTE-->
        <form class="formulario-fr1" id="miFormulario" name="formulario" method="POST">
            <!--opciones de los botones outputs-->
            <h2 class="create-account">Registro de Datos del Docente</h2>
            <div class="ci">
                <input type="text" id="ci" name="ci" placeholder="Cedula de Identidad" required />
                <input type="date" id="nacimiento" name="nacimiento" placeholder="Fecha de nacimiento" required />
            </div>
            <div class="sexo-container">
                <input type="radio" id="hombre" name="sexo" value="Masculino" required>
                <label for="hombre" class="text-s">Chacha : Hombre</label>
                <input type="radio" id="mujer" name="sexo" value="Femenino">
                <label for="mujer" class="text-s">Warmi : Mujer</label>
            </div>

            <div class="datos-personales">
                <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" required />
                <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required />
            </div>

            <div class="datos-contacto">
                <input type="tel" id="telefono" name="telefono" placeholder="Número de celular" required />
                <input type="email" id="correo" name="correo" placeholder="Correo electrónico" required />

            </div>

            <div class="direccion">
                <input type="text" id="direccion" name="direccion" placeholder="Lugar de residencia" required />
            </div>

            <div class="pass">
                <input type="password" id="password" class="password" name="password"
                    placeholder="Contraseña de usuario" required />
                    <i class='bx bxs-face-mask bx-sm bx-border'></i>
            </div>

            <button class="botonG" id="guardar" name="guardar" type="submit" formaction="../datosD/CrearD.php">Imaña : Guardar</button>
            <button class="botonA" id="adelante" name="adelante" type="submit">Nairakkata : Adelante</button>
        </form>
        <!--formulario de registro asignatura-->
        <form id="formAsig" class="formAsig" method="POST">
            <h2>Verifica si tu nombre está registrado en la base de datos</h2>
            <div class="listDocente">
                <i class='bx bx-search-alt bx-md bx-tada'></i>
                <select id="docente" name="docente" required>
                    <option value="">Seleccione Docente</option>
                </select>
                <!--ID DOCENTE TIPO HIDDEN-->
                <input type="hidden" id="id_docente" name="id_docente" value="">
            </div>
            <div class="datos-aula">
                <input type="text" placeholder="codigo materia" name="cod_materia" class="codmat" required />
                <div class="maAs">
                    <input type="text" placeholder="Asignatura" class="asig" name="materia" required />
                </div>
            </div>
            <div class="curso">
                <label for="curso" class="curso" id="cont">Curso: </label>
                <div id="curso-m" class="select-cont">
                    <select name="curso" id="curso" class="let" required>
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
            <div class="paralelo">
                <label for="paralelo" class="paralelo" id="cont">Paralelo: </label>
                <div id="paralelo-m" class="select-cont">
                    <select name="paralelo" id="paralelo" class="let" required>
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
            <!--cantidad de alumnos DIV-->
            <div class="cantidad">
                <label class="letra">Cantidad de alumnos: </label>
                <input type="number" name="cantidad" id="cantidad" min="1" step="0" required>
            </div>

            <!---->
            <div class="turno">
                <label for="turno" class="turno" id="cont">Turno: </label>
                <div id="turno-m" class="select-cont">
                    <select name="turno" id="turno" class="let" required>
                        <option value="Mañana">Mañana</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noche">Noche</option>
                    </select>
                    <!--AÑADIMOS IMAGEN-->
                    <div class="select-icon">
                        <i class="fa-solid fa-circle-chevron-down"></i>
                    </div>
                </div>
            </div>
            <div class="botones2">
                <button class="botonS" id="guardar" name="guardar" type="submit"
                    formaction="../datosD/crearAsig.php">Imaña : Guardar</button>
                <button class="boton1" id="back1" type="button">Qhipäxa : Atrás</button>
                <button class="botonA" id="Adelante2" type="button">Nairakkata : Siguiente</button>
            </div>
        </form>

        <!--FORMULARIO 3-->
        <form id="form3" class="form3">
            <div class="message">
                <p>¡Registro completado con éxito! Ahora puedes iniciar sesión.</p>
                <a class="botonI" id="entrar" href="../login/logDocente.php">Mantaña : Entrar</a>
            </div>
            <div class="botones3">
                <button class="boton2" id="back2" type="button">Qhipäxa : Atrás</button>
            </div>
        </form>
        <div class="volver">
            <a href="../login/logDocente.php" class="volver1">Cancelar registro</a>
        </div>
    </div>
    <script src="../js/NuevoD.js"></script>
</body>

</html>