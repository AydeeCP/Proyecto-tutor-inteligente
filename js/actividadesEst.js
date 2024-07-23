$(document).ready(function () {
    // Cargar los nombres completos en el campo de selección
    function cargarNombresCompleto() {
        $.ajax({
            url: "../gramatica/obtenerNombres.php",
            type: "GET",
            dataType: "json",
            success: function(response) {
                var selectNombreCompleto = $('#nombreCompleto');
                selectNombreCompleto.empty();
                selectNombreCompleto.append('<option value="">Seleccione un estudiante</option>');
                if (response.success) {
                    response.estudiantes.forEach(function(estudiante) {
                        selectNombreCompleto.append('<option value="' + estudiante.id + '">' + estudiante.nombre_completo + '</option>');
                    });
                }
            },
            error: function(xhr, status, error) {
                $("#errorMessage").text("Error al cargar los nombres de los estudiantes: " + error);
            }
        });
    }

    window.filtrarPorTema = function() {
        var temaSeleccionado = $('#tema').val();
        var idEstudiante = $('#nombreCompleto').val();

        $.ajax({
            url: "../gramatica/actividadAlm.php",
            type: "GET",
            dataType: "json",
            data: {
                tema: temaSeleccionado,
                idEstudiante: idEstudiante
            }, // Enviar el ID del estudiante al servidor
                success: function(response) {
                var actividadesTableContainer = $("#actividadesTableContainer");
                
                // Limpiar el contenedor de la tabla antes de agregar nuevos datos
                actividadesTableContainer.empty();
                
                if (response.success) {
                    if (response.actividades.length === 0) {
                        if (temaSeleccionado === 'todos') {
                            $("#mensajeError").html("<i class='bx bxs-error bx-md'></i> No se encontraron actividades realizadas.");
                        } else {
                            $("#mensajeAct").html("Aún ningún estudiante ha realizado actividades en el tema seleccionado.");
                        }
                        $("#descargar").hide();
                        
                    } else {
                        mostrarActividadesTabla(response.actividades);
                        if (response.actividades.length > 0) {
                            $("#mensajeError").empty();
                            $("#btnDescargar").show();
                        } else {
                            $("#btnDescargar").hide();
                        } 
                    }
                } else {
                    $("#mensajeError").html("<i class='bx bxs-error bx-md'></i> " + response.error);
                    $("#btnDescargar").hide();
                }
            },
            error: function(xhr, status, error) {
                $("#errorMessage").text("Error al obtener los datos: " + error);
            }
        });
    }

    // Llamar a la función para cargar los nombres completos
    cargarNombresCompleto();
    
    // Función para mostrar actividades en la tabla
    function mostrarActividadesTabla(actividades) {
        var actividadesTableContainer = $("#actividadesTableContainer");
        actividadesTableContainer.empty(); // Limpiar el contenedor antes de agregar nuevos datos

        var actividadesTable = $('<table id="actividadesTable" class="table">');
        var thead = $("<thead>").append("<tr><th>#</th><th>Nombres</th><th>Apellidos</th><th>Sección</th><th>Tema</th><th>Juego practicado</th><th>Cantidad de aciertos</th><th>Intentos</th><th>Día realizado</th>");
        var tbody = $("<tbody>");

        $.each(actividades, function(index, actividad) {
            var fila = $("<tr>");
            fila.append("<td>"+(index+1)+"</td>");
            fila.append("<td>"+actividad.nombre_est+"</td>");
            fila.append("<td>"+actividad.apellidos_est+"</td>");
            fila.append("<td>"+actividad.opcion_navbar+"</td>");
            fila.append("<td>"+actividad.tema_practicado+"</td>");
            fila.append("<td>"+actividad.juego_seleccionado+"</td>");
            fila.append("<td>"+actividad.palabrasAcertadas+"</td>");
            fila.append("<td>"+actividad.vecesJugadas+"</td>");
            fila.append("<td>"+actividad.fecha_actividad+"</td>");
            tbody.append(fila);
        });

        actividadesTable.append(thead, tbody);
        actividadesTableContainer.append(actividadesTable);
        actividadesTableContainer.addClass("table-responsive");
    }
    $("#btnDescargar").hide();
    // Manejar el cambio en el select
    $("#tema").change(filtrarPorTema);

    $("#btnDescargar").on("click", function () {
    // Crear un nuevo objeto jsPDF con orientación 'p' (vertical), unidades en puntos (pt) y tamaño A4
    var doc = new jsPDF("p", "pt", "a4");
    var table = $("#actividadesTable")[0];
    var title = "Lista de actividades realizadas";

    var textWidth = doc.getTextDimensions(title).w;
    var pageWidth = doc.internal.pageSize.width;
    var titleX = (pageWidth - textWidth) / 2;
    // Establecer los estilos para el texto del título
    doc.setFont("times"); // Tipo de fuente
    doc.setFontStyle("bold"); // Estilo de la fuente (negrita)
    doc.setFontSize(18); // Tamaño de fuente
    doc.setTextColor(0, 0, 0);

    // Escribir el texto con alineación centrada
    doc.text(title, titleX, 50, { overflow: "linebreak", align: "center" });

    doc.autoTable({
      html: table,
      startY: 80,
      theme: "grid",
      headStyles: {
        fillColor: [20, 40, 52],
        textColor: [255, 255, 255],
        align: "center",
        halign: "center",
      },
      styles: {
        cellPadding: 5,
        fontSize: 12,
        textColor: [0, 0, 0],
        align: "center",
        halign: "center",
        lineColor: [68, 80, 136],
        lineWidth: 1,
      },
    });

    // Guardar el PDF
    doc.save("actividades_realizadas.pdf");
    });
});
