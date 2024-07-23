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

    // Obtener los datos del curso
    $sql = "SELECT * FROM curso_est WHERE Id_est = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_est);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows == 0) {
        echo "No se encontraron datos del curso";
        exit();
    }

    $curso = $result->fetch_assoc();
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
    <title>Editar Curso</title>
</head>
<body>
    <div class="editCur">
        <h1>Editar datos del curso</h1>
        <form id="formEditarCurso" class="formEditarCurso">
            <input type="hidden" id="editarIdEst" value="<?php echo $curso['Id_est']; ?>">
            <label for="editarNivel">Nivel:</label>
            <input type="text" id="editarNivel" value="<?php echo $curso['nivel_curso']; ?>"><br><br>
            <label for="editarParalelo">Paralelo:</label>
            <input type="text" id="editarParalelo" value="<?php echo $curso['paralelo']; ?>"><br><br>
            <label for="editarMateria">Materia:</label>
            <input type="text" id="editarMateria" value="<?php echo $curso['materia']; ?>"><br><br>
            <div class="opciones">
                <input type="submit" value="Guardar Cambios" id="editarCur">
                <a href="../padres/mostrarDE.html" id="CancelE">Cancelar</a>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#formEditarCurso').on('submit', function(e) {
                e.preventDefault();
                
                var id = $('#editarIdEst').val();
                var nivel = $('#editarNivel').val();
                var paralelo = $('#editarParalelo').val();
                var materia = $('#editarMateria').val();

                $.ajax({
                    url: '../padres/editarCurso.php',
                    type: 'POST',
                    data: {
                        Id_est: id,
                        nivel_curso: nivel,
                        paralelo: paralelo,
                        materia: materia
                    },
                    success: function(response) {
                        alert('Datos del curso actualizados correctamente.');
                        window.location.href = '../padres/mostrarDE.html';
                    },
                    error: function(xhr, status, error) {
                        alert('Error al actualizar los datos del curso.');
                    }
                });
            });
        });
    </script>
</body>
</html>
