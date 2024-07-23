<?php
session_start();
include('../conexion/bd.php');

if (!isset($_SESSION['padre_id'])) {
    header("Location: ../login/logPad.php");
    exit();
}

if (!isset($_GET['Id_est'])) {
    echo "ID de estudiante no especificado";
    exit();
}

$id_est = $_GET['Id_est'];

// Obtener los datos del estudiante
$sql = "SELECT * FROM estudiantes WHERE Id_est = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_est);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows == 0) {
    echo "No se encontraron datos del estudiante";
    exit();
}

$estudiante = $result->fetch_assoc();
mysqli_free_result($result);
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <link rel='stylesheet' href='../css/editarDatosP.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Editar Estudiante</title>
</head>

<body>
    <div class="editEst">
        <h1>Editar datos personales</h1>
        <form id="formEditarEstudiante" class="formEditarEstudiante">
            <input type="hidden" id="editarIdEst" value="<?php echo $estudiante['Id_est']; ?>">
            <label for="editarCedula">Cedula de identidad:</label>
            <input type="text" id="editarCedula" value="<?php echo $estudiante['cedula_est']; ?>"><br><br>
            <label for="editarNacimiento">Fecha de nacimiento:</label>
            <input type="date" id="editarNacimiento" value="<?php echo $estudiante['nacimiento_est']; ?>"><br><br>
            <label for="editarGenero">Género:</label>
            <select id="editarGenero">
                <option value="Femenino" <?php if ($estudiante['genero'] == 'Femenino') echo 'selected'; ?>>Femenino</option>
                <option value="Masculino" <?php if ($estudiante['genero'] == 'Masculino') echo 'selected'; ?>>Masculino</option>
            </select><br><br>
            <label for="editarNombre">Nombres:</label>
            <input type="text" id="editarNombre" value="<?php echo $estudiante['nombre_est']; ?>"><br><br>
            <label for="editarApellidos">Apellidos:</label>
            <input type="text" id="editarApellidos" value="<?php echo $estudiante['apellidos_est']; ?>"><br><br>
            <label for="editarLenguaMaterna">Lengua materna:</label>
            <input type="text" id="editarLenguaMaterna" value="<?php echo $estudiante['lengua_materna']; ?>"><br><br>
            <div class="opciones">
            <input type="submit" value="Guardar Cambios" id="guardarC">
                <a href="../padres/mostrarDE.html">Cancelar</a>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#formEditarEstudiante').on('submit', function(e) {
                e.preventDefault();
                var id = $('#editarIdEst').val();
                var cedula = $('#editarCedula').val();
                var nacimiento = $('#editarNacimiento').val();
                var genero = $('#editarGenero').val();
                var nombre = $('#editarNombre').val();
                var apellidos = $('#editarApellidos').val();
                var lenguaMaterna = $('#editarLenguaMaterna').val();
                $.ajax({
                    url: '../padres/editarEst.php',
                    type: 'POST',
                    data: {
                        Id_est: id,
                        cedula_est: cedula,
                        nacimiento_est: nacimiento,
                        genero: genero,
                        nombre_est: nombre,
                        apellidos_est: apellidos,
                        lengua_materna: lenguaMaterna
                    },
                    success: function(response) {
                        alert('Datos del estudiante actualizados correctamente.');
                        window.location.href = '../padres/mostrarDE.html';
                    },
                    error: function(xhr, status, error) {
                        alert('Error al actualizar los datos del estudiante.');
                    }
                });
            });
        });
    </script>
</body>

</html>