<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <link rel="stylesheet" href="../css/verDatos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    


    <title>Document</title>
</head>
<body>
    <div id="contenedor" class="contenedor">
        <div class="datos" id="datos"></div>
            <div class="editar">
                <button class="editarD" id="editarD" >Editar datos personales</button>
                <button class="editarC" id="editarC">Editar datos de curso</button>
                <a href="../home/homeD.php"><i class='bx bxs-left-arrow-square bx-md bx-fade-left-hover'></i>salir</a></li>
            </div>
    </div>
    <script>
        // Cuando el documento esté listo
        $(document).ready(function() {
            // Realiza una petición AJAX para obtener los datos de docentes y asignaturas
            $.ajax({
                url: '../datosD/datosG.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Verifica si la petición fue exitosa y si hay datos
                    if (response.success) {
                        // Construye el HTML para mostrar los datos de docentes
                        var htmlDatos = '';
                        $.each(response.datos, function(key, value) {
                            if (key === 'docente') {
                                htmlDatos += '<h2>DATOS DOCENTES</h2>';
                                htmlDatos += '<input type="hidden" name="id_docente" value="' + (value.Id !== undefined ? value.Id : '') + '">';
                                htmlDatos += '<p><span class="texto">Cedula de identidad:</span> <span class="valor">' + (value.ci !== undefined ? value.ci : '') + '</span></p>';
                                htmlDatos += '<p><span class="texto">Fecha de nacimiento:</span> <span class="valor">' + (value.fecha !== undefined ? value.fecha : '') + '</span></p>';
                                htmlDatos += '<p><span class="texto">Sexo:</span> <span class="valor">' + (value.sexo !== undefined ? value.sexo : '') + '</span></p>';
                                htmlDatos += '<p><span class="texto">Nombre:</span> <span class="valor">' + (value.nombre !== undefined ? value.nombre : '') + '</span></p>';
                                htmlDatos += '<p><span class="texto">Apellido:</span> <span class="valor">' + (value.apellido !== undefined ? value.apellido : '') + '</span></p>';
                                htmlDatos += '<p><span class="texto">Celular:</span> <span class="valor">' + (value.telefono !== undefined ? value.telefono : '') + '</span></p>';
                                htmlDatos += '<p><span class="texto">Correo electrónico:</span> <span class="valor">' + (value.correo !== undefined ? value.correo : '') + '</span></p>';
                                htmlDatos += '<p><span class="texto">Direccion: </span> <span class="valor">' + (value.direccion !== undefined ? value.direccion:'') + '</span></p>';
                                /*htmlDatos += '<p><span class="texto">Contraseña:</span> <span class="valor">' + (value.contraseña !== undefined ? value.contraseña : '') + '</span></p>';*/                                
                            } else if (key === 'asignatura') {
                                htmlDatos += '<h2>DATOS ASIGNATURA</h2>';
                                /*htmlDatos += '<div class="datos-asignatura">';*/
                                htmlDatos += '<p><span class="texto">Materia:</span> <span class="valor">' + (value.materia !== undefined ? value.materia : '') + '</span></p>';
                                htmlDatos += '<p><span class="texto">Curso:</span> <span class="valor">' + (value.curso !== undefined ? value.curso : '') + '</span></p>';
                                htmlDatos += '<p><span class="texto">Paralelo:</span> <span class="valor">' + (value.paralelo !== undefined ? value.paralelo : '') + '</span></p>';
                                htmlDatos += '<p><span class="texto"> Cantidad de alumnos: </span> <span>' + (value.cantidad !== undefined ? value.cantidad : '') + '</span></p>';
                                htmlDatos += '<p><span class="texto"> Codigo asignatura: </span> <span>'+(value.codigo !==undefined ? value.codigo : '') + '</span></p>';
                                htmlDatos += '<p><span class="texto"> Turno: </span> <span>'+(value.turno !==undefined ? value.turno:'') + '</span></p>';
                                /*htmlDatos += '</div>';*/
                                }
                            });
                        $('#datos').html(htmlDatos);
                        
                    } else {
                        // Si no hay datos, muestra un mensaje de error
                        $('#datos').html('<p>No se encontraron datos de docentes.</p>');
                    }
                },
                error: function() {
                    
                    $('#datos').html('<p>Ocurrió un error al obtener los datos de docentes, inicia sesión</p>');
                    
                }
            });

            $('#editarC').click(function() {
            var idDocente = $('input[name="id_docente"]').val();
            console.log(idDocente);
            if (idDocente) {
                window.location.href = '../DocentePP/editarAsig.php?Id=' + idDocente;
            } else {
                console.error('Error: No se proporcionó el ID del docente');
            }
        });
        });

        var editarDButton = document.getElementById('editarD');
        editarDButton.addEventListener('click', function() {
            // Redirigir al usuario a la página de edición de datos personales
            window.location.href = '../DocentePP/editarDH.php';
        });

       /* // Captura el ID del docente del botón de edición de curso
        var editarCButton = document.getElementById('editarC');
        editarCButton.addEventListener('click',function(){
            window.location.href = '../DocentePP/editarAsig.php?Id=' + (value.Id !== undefined ? value.Id : '');
        });
*/

    </script>

</body>
</html>