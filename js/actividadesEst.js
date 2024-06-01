$(document).ready(function() {
    $.ajax({
    url: "../gramatica/actividadAlm.php",
    type: "GET",
    dataType: "json",
    success: function(response) {
        if(response.success) {
            mostrarActividadesTabla(response.actividades);
        }else{
            $("#mensajeError").html("<i class='bx bxs-error bx-md'></i> " + response.error);
            $("#descargar").hide();
        }
    },
    error: function (xhr, status, error) {
        $("#errorMessage").text("Error al obtener los datos: " + error);
    }
    });
    function mostrarActividadesTabla(actividades){
        var actividadesTableContainer = $("#actividadesTableContainer");
        var actividadesTable = $('<table id="actividadesTable" class="table">');
        var thead = $("<thead>").append("<tr><th>#</th><th>Nombres</th><th>Apellidos</th><th>Seccion</th><th>Tema</th><th>Juego practicado</th><th>Cantidad de aciertos</th><th>Intentos</th><th>Día realizado</th>");
        var tbody = $("<tbody>");
        $.each(actividades, function (index, actividades){
            var fila = $("<tr>");
            fila.append("<td>"+(index+1)+"</td>");
            fila.append("<td>"+actividades.nombre_est+"</td>");
            fila.append("<td>"+actividades.apellidos_est+"</td>");
            fila.append("<td>"+actividades.opcion_navbar+"</td>");
            fila.append("<td>"+actividades.tema_practicado+"</td>");
            fila.append("<td>"+actividades.juego_seleccionado+"</td>");
            fila.append("<td>"+actividades.palabrasAcertadas+"</td>");
            fila.append("<td>"+actividades.vecesJugadas+"</td>");
            fila.append("<td>"+actividades.fecha_actividad+"</td>");
            tbody.append(fila);
        });
        
        actividadesTable.append(thead,tbody);
        actividadesTableContainer.append(actividadesTable);
        actividadesTableContainer.addClass("table-responsive");
    }
    
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
        doc.setTextColor(0,0,0); 
        
          // Escribir el texto con alineación centrada
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

          // Guardar el PDF
        doc.save("actividades_realizadas.pdf");
    });
});


