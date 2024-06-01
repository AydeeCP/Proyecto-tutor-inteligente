$(document).ready(function() {
    $.ajax({
        url:"../datosE/listEst.php",
        type:"GET",
        dataType:"json",
        success:function(response){
            if(response.success){
                mostrarEstEnTabla(response.estudiantes);
            }else{
                $("#mensajeError").html("<i class='bx bxs-error bx-md'></i> " + response.error);
                $("#descargar").hide();
            }
        },
        error:function(xhr, status,error){
            $("errorMessage").text("Error al obtener los datos: " + error);
        },
    });
    function mostrarEstEnTabla(estudiantes){
        var estudiantesTableContainer = $("#estudiantesTableContainer");
        var estudiantesTable= $('<table id="estudiantesTable" class="table table">');
        var thead = $("<thead>").append("<tr><th>#</th><th>cedula de identidad</th><th>Fecha de nacimiento</th> <th>Nombre</th><th>apellidos</th><th>Lengua materna</th>");
        var tbody=$("<tbody>");
        $.each(estudiantes, function(index, estudiantes){
            var fila =$("<tr>");
            fila.append("<td>" + (index + 1) + "</td>");
            fila.append("<td>"+estudiantes.cedula_est+"</td>");
            fila.append("<td>"+estudiantes.nacimiento_est+"</td>");
            fila.append("<td>"+estudiantes.nombre_est+"</td>");
            fila.append("<td>"+estudiantes.apellidos_est+"</td>");
            fila.append("<td>"+estudiantes.lengua_materna+"</td>");
            tbody.append(fila);
        });
        estudiantesTable.append(thead,tbody);
        estudiantesTableContainer.append(estudiantesTable);
    }
    $("#btnDescargar").on("click", function() {
        var doc = new jsPDF("p", "pt", "a4");
        var table = $("#estudiantesTable")[0];
        var title = "Lista de estudiantes registrados";
    
        var textWidth = doc.getTextDimensions(title).w;
        var pageWidth = doc.internal.pageSize.width;
        var titleX = (pageWidth - textWidth) / 2;
    
        doc.setFont("times");
        doc.setFontStyle("bold");
        doc.setFontSize(18);
        doc.setTextColor(0, 0, 0);
    
        doc.text(title, titleX, 50, { overflow: "linebreak", align: "center" });
    
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
        doc.save("lista_estudiantes.pdf");
    });

});

