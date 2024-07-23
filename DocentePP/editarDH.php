<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='../css/editarD.css' rel='stylesheet'>
    <script src="../js/pass.js"></script>
    <title>Editar datos docente</title>
</head>
<body>
    <div class="editD">
        <h1>Edición de datos</h1>
        <form action="../datosD/editarDatosD.php" method="POST" class="forMEd">
            
        <input type="hidden" id="Id" name="Id" value=""><br><br>

            <label for="ci">Cédula de Identidad:</label>
            <input type="text" id="ci" name="ci" value=""><br><br>
            <label for="naciminiento">Fecha de nacimiento: </label>
            <input type="date" id="nacimiento" name="nacimiento" value=""><br><br>
            <label for="sexo">Género: </label>
            <select id="sexo" name="sexo">
                <option value="Femenino">Femenino</option>
                <option value="Masculino">Masculino</option>
            </select><br><br>
            
            <label for="nombre">Nombres: </label>
            <input type="text" id="nombre" name="nombre" value=""><br><br>

            <label for="apellido">Apellidos:</label>                
            <input type="text" id="apellidos" name="apellidos" value=""><br><br>

            <label for="telefono">Número de celular:</label>
            <input type="tel" id="telefono" name="telefono" value=""><br><br>

            <label for="correo">Correo electrónico: </label>
            <input type="email" id="correo" name="correo" value=""><br><br>

            <label for="direccion">Direccion: </label>
            <input type="text" id="direccion" name="direccion" value=""><br><br>
            
            <label for="password">Contraseña: </label>
            <input type="password" id="password" class="password" name="password">
            <i class='bx bxs-face-mask bx-sm'></i><br><br>
            <br>
            <div class="opciones">
                <input type="submit" value="Guardar Cambios" id="Geditar">
                <a href="../DocentePP/verDatos.php">Cancelar</a>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Realiza una petición AJAX para obtener los datos del docente
            fetch('../datosD/datosG.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('Id').value = data.datos.docente.Id;
                    document.getElementById('ci').value = data.datos.docente.ci;
                    document.getElementById('nacimiento').value=data.datos.docente.fecha;
                    document.getElementById('sexo').value = data.datos.docente.sexo;
                    document.getElementById('nombre').value=data.datos.docente.nombre;
                    document.getElementById('apellidos').value=data.datos.docente.apellido;
                    document.getElementById('telefono').value=data.datos.docente.telefono;
                    document.getElementById('correo').value=data.datos.docente.correo;
                    document.getElementById('direccion').value=data.datos.docente.direccion;
                    document.getElementById('password').value=data.datos.docente.contraseña;
                    
                    var sexo = data.datos.docente.sexo;
                    var selectGenero = document.getElementById('sexo');
                    // opciones del campo de selección para encontrar la que coincide con el género
                    for (var i = 0; i < selectGenero.options.length; i++) {
                        if (selectGenero.options[i].value === sexo) {
                            selectGenero.options[i].selected = true;
                            break; 
                        }
                    }
                })
                .catch(error => console.error('Error al obtener los datos:', error));
        });
    </script>
</body>
</html>