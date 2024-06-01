$(document).ready(function () {
    $.ajax({
        url: "../datosE/listPadres.php",
        type: "GET",
        dataType: "json",
        success: function (response) {
        if (response.success) {
            mostrarPadresEnTabla(response.padres);
        } else {
            $("#mensajeError").html("<i class='bx bxs-error bx-md'></i> " + response.error);
            $("#descargar").hide();
        }
        },
        error: function (xhr, status, error) {
        $("#errorMessage").text("Error al obtener los datos: " + error);
        },
    });
    function mostrarPadresEnTabla(padres) {
        var padresTableContainer = $("#padresTableContainer");
        var padresTable = $('<table id="padresTable" class="table">'); 
        var thead = $("<thead>").append("<tr><th>#</th><th>Cedula de identidad</th><th>Nombre</th><th>Apellidos</th><th>Celular</th><th>Correo electrónico</th> <th>Lugar de residencia</th>");
        var tbody = $("<tbody>");
        $.each(padres, function (index, padre) {
            var fila = $("<tr>");
            fila.append("<td>" + (index + 1) + "</td>");
            fila.append("<td>"+padre.cedula+"</td>"),
            fila.append("<td>" + padre.nombre_p + "</td>");
            fila.append("<td>" + padre.apellidos_p + "</td>");
            fila.append("<td>" + padre.celular +"</td>");
            fila.append("<td>" + padre.correo_p + "</td>");
            fila.append("<td>" + padre.lugar_res+"</td>");
            tbody.append(fila);
        });
        padresTable.append(thead, tbody);
        padresTableContainer.append(padresTable);
        padresTableContainer.addClass("table-responsive");
    }

    $("#btnDescargar").on("click", function () {
        // Crear un nuevo objeto jsPDF con orientación 'p' (vertical), unidades en puntos (pt) y tamaño A4
        var doc = new jsPDF("p", "pt", "a4");
        var table = $("#padresTable")[0];
        var title = "Lista de padres registrados";

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
        doc.save("lista_padres.pdf");
    });
});



