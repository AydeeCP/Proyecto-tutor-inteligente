
<?php
// Verifica si se pasó el ID del docente como parámetro de consulta en la URL
if(isset($_GET['Id'])) {
    $idDocente = $_GET['Id'];
    /*echo $idDocente;*/
} else {
    // Si no se pasó el ID del docente, muestra un mensaje de error o redirige a otra página
    echo "Error: No se ha proporcionado el ID del docente";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <link href='../css/editarC.css' rel='stylesheet'>
    <title>Editar datos curso</title>
</head>
<body>
<div class="co">
        <h1>Edicion de asignatura</h1>
        <form action="../datosD/editarCurso.php" method="POST">
            <label for="nombre">Nombre materia: </label>
            <input type="text" placeholder="Asignatura" id="materia" class="asig" name="materia" value=""><br><br>

            <label for="curso">Curso: </label>
            <select name="curso" id="curso" class="let" >
                <option value="">--</option>
                <option value="Tercero">3ro Tercero</option>
                <option value="Cuarto">4to Cuarto</option>
                <option value="Quinto">5to Quinto</option>
                <option value="Sexto">6to Sexto</option>
            </select><br><br>

            <label for="paralelo">Paralelo: </label>
            <select name="paralelo" id="paralelo" class="let" >
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select><br><br>
            <label for="cantidad">Cantidad de alumnos</label>
            <input type="number" name="cantidad" id="cantidad" min="1" step="0"><br><br>

            <label for="turno">Turno: </label>
            <select name="turno" id="turno" class="let">
                <option value="Mañana">Mañana</option>
                <option value="Tarde">Tarde</option>
                <option value="Noche">Noche</option>
            </select><br><br>

            <label for="codigo">Codigo asignatura: </label>
            <input type="text" placeholder="codigo materia" name="cod_materia" id="cod_materia" value=""><br><br>

            <br>
            <div class="opc">
                <input type="hidden" name="id_docente" value="<?php echo $idDocente; ?>">
                <input type="submit" value="Guardar Cambios" id="gCurso">
                <a href="../DocentePP/verDatos.php">Cancelar</a>
            </div>
        </form>

    </div>
    <script>
        // Cuando el documento esté listo
        document.addEventListener('DOMContentLoaded', function() {
            // Realiza una petición AJAX para obtener los datos del docente
            fetch('../datosD/datosG.php')
                .then(response => response.json())
                .then(data => {
                    // Rellena el formulario con los datos obtenidos
                    document.getElementById('materia').value = data.datos.asignatura.materia;
                    document.getElementById('cantidad').value=data.datos.asignatura.cantidad;
                    document.getElementById('cod_materia').value=data.datos.asignatura.codigo;
                    var curso = data.datos.asignatura.curso;
                    if (curso === "SEXTO") {
                        curso = "Sexto";
                    } else if (curso === "QUINTO") {
                        curso = "Quinto";
                    }else if (curso === "CUARTO"){
                        curso ="Cuarto";
                    }else if (curso === "TERCERO"){
                        curso="Tercero";
                    }
                    var selectCurso = document.getElementById('curso');
                    for (var i = 0; i < selectCurso.options.length; i++) {
                        if (selectCurso.options[i].value === curso) {
                            selectCurso.selectedIndex = i;
                            break;
                        }
                    }
                    /*PARALELO */
                    var paralelo = data.datos.asignatura.paralelo;
                    var selectParalelo = document.getElementById('paralelo');
                    for (var i = 0; i < selectParalelo.options.length; i++) {
                        if (selectParalelo.options[i].value === paralelo) {
                            selectParalelo.selectedIndex = i;
                            break;
                        }
                    }

                    //'turno'
                    var turno = data.datos.asignatura.turno;
                    var selectTurno = document.getElementById('turno');
                    for (var i = 0; i < selectTurno.options.length; i++) {
                        if (selectTurno.options[i].value === turno) {
                            selectTurno.selectedIndex = i;
                            break;
                        }
                    }
                })
                .catch(error => console.error('Error al obtener los datos:', error));
        });


    </script>
</body>
</html>