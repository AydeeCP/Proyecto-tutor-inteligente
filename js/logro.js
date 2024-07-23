$(document).ready(function() {
    var logrosData = []; // Para almacenar los logros obtenidos
    var logrosChart = null; // Variable para almacenar el gráfico

    $.ajax({
        url: '../gramatica/logros.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                logrosData = response.logros;
                //mostrarLogrosTabla(logrosData);
                llenarSelectores(logrosData);
            } else {
                $("#mensajeErrorMedallas").html("<i class='bx bxs-error bx-md'></i> " + response.error).show();
            }
        },
        error: function(xhr, status, error) {
            $("#mensajeErrorMedallas").text("Error al obtener los datos: " + error).show();
        }
    });

    function llenarSelectores(logros) {
        var estudianteSelect = $("#estudianteSelect");
        estudianteSelect.empty();
        estudianteSelect.append("<option value='todos'>Todos</option>");

        var estudiantes = [];
        $.each(logros, function(index, logro) {
            var nombreCompleto = logro.nombre_est + " " + logro.apellidos_est;
            if (!estudiantes.includes(nombreCompleto)) {
                estudiantes.push(nombreCompleto);
                estudianteSelect.append("<option value='" + nombreCompleto + "'>" + nombreCompleto + "</option>");
            }
        });
    }

    window.cambiarVista = function() {
        var vista = $("#vistaSelect").val();
        if (vista === "individual") {
            $("#estudianteSelect").prop("disabled", false);
        } else {
            $("#estudianteSelect").prop("disabled", true);
            filtrarLogros();
        }
    }

    window.filtrarLogros = function() {
        var equivalente = $("#equivalenteSelect").val();
        var estudiante = $("#estudianteSelect").val();
        var tema = $("#temaSelect").val();
        var logrosFiltrados = logrosData.filter(function(logro) {
            var coincideEquivalente = (equivalente === 'todos') || (logro.letra_medalla === equivalente);
            var coincideEstudiante = (estudiante === 'todos') || (logro.nombre_est + " " + logro.apellidos_est === estudiante);
            var coincideTema = (tema === 'todos') || (logro.tema_practicado === tema);
            return coincideEquivalente && coincideEstudiante && coincideTema;
        });

        mostrarLogrosTabla(logrosFiltrados);
    };

    function mostrarLogrosTabla(logros) {
        var medallasTableContainer = $("#medallasTableContainer");
        medallasTableContainer.empty(); // Limpiar contenedor antes de agregar la tabla

        if (logros.length === 0) {
            $("#mensajeErrorMedallas").html("<div class='text-center-custom'><i class='bx bxs-error bx-md'></i></i> No se encontraron logros.</div>").show();
            return;
        }

        $("#mensajeErrorMedallas").hide(); // Ocultar mensaje de error si hay datos

        var medallasTable = $('<table id="medallasTable" class="table">');
        var thead = $("<thead>").append("<tr><th>#</th><th>Nombres</th><th>Apellidos</th><th>Tema</th><th>Actividad</th><th>Medalla</th><th>Equivalente</th></tr>");
        var tbody = $("<tbody>");

        $.each(logros, function(index, logro) {
            var fila = $("<tr>");
            fila.append("<td>" + (index + 1) + "</td>");
            fila.append("<td>" + logro.nombre_est + "</td>");
            fila.append("<td>" + logro.apellidos_est + "</td>");
            fila.append("<td>" + logro.tema_practicado + "</td>");
            fila.append("<td>" + logro.juego_seleccionado + "</td>");
            fila.append("<td>" + logro.medalla + "</td>");
            fila.append("<td>" + logro.letra_medalla + "</td>");
            tbody.append(fila);
        });

        medallasTable.append(thead).append(tbody);
        medallasTableContainer.append(medallasTable);
        // Mostrar el contenedor de la tabla después de agregar la tabla
        medallasTableContainer.show();
    }

    $('#logrosModal').on('show.bs.modal', function (e) {
        var vista = $("#vistaSelect").val();
        var estudiante = $("#estudianteSelect").val();
        var tema = $("#temaSelect").val();
        var logrosFiltrados = logrosData;

        if (vista === "individual" && estudiante !== "todos") {
            logrosFiltrados = logrosData.filter(function(logro) {
                return (logro.nombre_est + " " + logro.apellidos_est === estudiante);
            });
        } else if (tema !== "todos") {
            logrosFiltrados = logrosData.filter(function(logro) {
                return (logro.tema_practicado === tema);
            });
        }

        generarGrafico(logrosFiltrados);
    });

    function generarGrafico(logros) {
        var equivalentes = { A: 0, O: 0, E: 0 };
        $.each(logros, function(index, logro) {
            equivalentes[logro.letra_medalla]++;
        });

        var ctx = document.getElementById('logrosChart').getContext('2d');
        if (logrosChart) {
            logrosChart.destroy(); // Destruir gráfico anterior si existe
        }

        logrosChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['A', 'O', 'E'],
                datasets: [{
                    label: 'Cantidad de Medallas',
                    data: [equivalentes.A, equivalentes.O, equivalentes.E],
                    backgroundColor: ['#FFD700', '#C0C0C0', '#CD7F32'],
                    borderColor: ['#FFD700', '#C0C0C0', '#CD7F32'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});
