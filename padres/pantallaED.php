<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <link rel="stylesheet" href="../css/editarDatosP.css">
    <title>Edición de datos Personales</title>
</head>

<body>
    <div class="editP">
        <h1>Edición de datos personales</h1>
        <form action="../padres/editarDatosP.php" method="POST" class="forMEP">
            <input type="hidden" id="IDE" name = "padre_id">
            <label for="ci">Cédula de Identidad:</label>
            <input type="text" id="ci" name="ci"/><br><br>

            <label for="nombre">Nombres:</label>
            <input type="text" id="nombre" name="nombre"><br><br>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" /><br><br>

            <label for="telefono">Celular:</label>
            <input type="tel" id="telefono" name="telefono"  /><br><br>

            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" /><br><br>

            <label for="residencia">Lugar de residencia:</label>
            <input type="text" id="residencia" name="residencia"/><br><br>
            <div class="opciones">
                <input type="submit" value="Guardar Cambios" id="editarDP">
                <a href="../padres/mostrarDP.html">Cancelar</a>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            fetch('../padres/verDatosP.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('IDE').value=data.Id_padres;
                    document.getElementById('ci').value = data.cedula;
                    document.getElementById('nombre').value=data.nombre_p;
                    document.getElementById('apellidos').value=data.apellidos_p;
                    document.getElementById('telefono').value = data.celular;
                    document.getElementById('correo').value = data.correo_p;
                    document.getElementById('residencia').value = data.lugar_res;
                })
                .catch(error => alert.error('Error al obtener los datos:', error));
        });
    </script>
</body>

</html>