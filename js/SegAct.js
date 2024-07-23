$(document).ready(function() {
    // Función para cargar las actividades del estudiante
    function cargarActividades(idEstudiante) {
        $.ajax({
            url: "../gramatica/SegACtividad.php",
            type: "POST", // Cambiado a POST si estás enviando datos sensibles como el id_estudiante
            data: { id_estudiante: idEstudiante }, // Pasar el id_estudiante como parte de los datos
            dataType: "json",
            success: function(response) {
                if(response.success) {
                    mostrarActividadesTabla(response.actividades);
                } else {
                    $("#mensajeError").html("<i class='bx bxs-error bx-md'></i> " + response.error);
                    $("#descargar").hide();
                }
            },
            error: function(xhr, status, error) {
                $("#errorMessage").text("Error al obtener los datos: " + error);
            }
        });
    }

    // Función para mostrar las actividades en una tabla
    function mostrarActividadesTabla(actividades) {
        var actividadesTableContainer = $("#actividadesTableContainer");
        var actividadesTable = $('<table id="actividadesTable" class="table">');
        var thead = $("<thead>").append("<tr><th>#</th><th>Nombres</th><th>Apellidos</th><th>Seccion</th><th>Tema</th><th>Juego practicado</th><th>Cantidad de aciertos</th><th>Intentos</th><th>Día realizado</th>");
        var tbody = $("<tbody>");
        $.each(actividades, function (index, actividad) {
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
        
        actividadesTable.append(thead,tbody);
        actividadesTableContainer.append(actividadesTable);
        actividadesTableContainer.addClass("table-responsive");
    }

    // Llamada inicial para cargar las actividades cuando el documento está listo
    var idEstudiante = obtenerIdEstudianteDesdeUrl();
    if (idEstudiante) {
        cargarActividades(idEstudiante);
    } else {
        $("#mensajeError").html("<i class='bx bxs-error bx-md'></i> No se proporcionó el ID del estudiante.");
    }

    // Evento para descargar la lista de actividades como PDF
    $("#btnDescargar").on("click", function () {
        var doc = new jsPDF("p", "pt", "a4");
        var table = $("#actividadesTable")[0];
        var title = "Lista de actividades realizadas";
        var textWidth = doc.getTextDimensions(title).w;
        var pageWidth = doc.internal.pageSize.width;
        var titleX = (pageWidth - textWidth) / 2;
        
        doc.setFont("times");
        doc.setFontStyle("bold");
        doc.setFontSize(18);
        doc.setTextColor(0,0,0);
        doc.text(title, titleX, 50, { overflow: "linebreak", align:"center" });

        doc.autoTable({
            html: table,
            startY: 80,
            theme: 'grid',
            headStyles: { fillColor: [68, 80, 136], textColor: [255, 255, 255], align: "center", halign: "center" },
            styles: {
                cellPadding: 5,
                fontSize: 12,
                textColor: [0, 0, 0],
                align: "center",
                halign: "center",
                lineColor: [68, 80, 136],
                lineWidth: 1
            }
        });

        doc.save("actividades_realizadas.pdf");
    });
});
