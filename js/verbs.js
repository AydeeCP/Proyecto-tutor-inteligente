let button = document.getElementById('button');

button.addEventListener('click',exportPdf);
var specialElementHandlers ={
    '.no-export' : function(element,renderer){
        return true;
    }
}

function exportPdf() {
    var doc = new jsPDF('p', 'pt', 'a4');

    // Obtenemos la tabla a partir de su ID
    var table = document.getElementById('table');

    // Creamos un array de headers para la tabla
    var headers = [];
    for (var i = 0; i < table.rows[0].cells.length; i++) {
        headers[i] = table.rows[0].cells[i].innerHTML;
    }

    // Creamos un array de datos para la tabla
    var data = [];
    for (var i = 1; i < table.rows.length; i++) {
        var tableRow = table.rows[i];
        var rowData = [];
        for (var j = 0; j < tableRow.cells.length; j++) {
            rowData.push(tableRow.cells[j].innerHTML);
        }
        data.push(rowData);
    }
    // Calculamos la posición X central para el título
    var title = "LURAYIRINAKA : VERBOS";
    var textWidth = doc.getTextDimensions(title).w;
    var pageWidth = doc.internal.pageSize.width;
    var titleX = (pageWidth - textWidth) / 2;

    var styles = {
        font: "helvetica",
        fontStyle: "normal",
        fontSize: 14,
        overflow: "linebreak",
        halign: "left"
    };

    var headerStyles = {
        fillColor: [51, 56, 87] // Color azul (RGB) para el encabezado de la tabla
    };

    // Agregamos la tabla al documento PDF utilizando jsPDF AutoTable
    doc.autoTable({
        head: [headers],
        body: data,
        startY: 60, // Posición de inicio de la tabla
        styles: styles,
        headStyles: headerStyles,
        margin: { top: 60 },
        didDrawPage: function (data) {
            // Definimos la cabecera en cada página
            doc.setFontSize(18);
            doc.setTextColor(40);
            doc.setFontStyle('normal');
            doc.text(title,titleX,40); // Alineamos a la izquierda
        }
    });

    // Guardamos el PDF
    doc.save("verbos-aymara.pdf");
}
function startDownload() {
    var button = document.getElementById('button');
    button.textContent = "Descargado";
    button.classList.add('clicked'); 
    
}