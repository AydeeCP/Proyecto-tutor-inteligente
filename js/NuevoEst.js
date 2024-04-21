/*funcion general*/

function cargarDatos(url,datosP,selectId,value1,text1,apellidos){
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success:function(response){
            if(response.success){
                var selectElement = $('#'+selectId);
                selectElement.empty();
                $.each(response[datosP], function(index,item){
                    /*que elementos mostrar solo nombre o apellidos mas*/
                    var apellido=apellidos ? ''+item[apellidos]:'';

                    selectElement.append($('<option>',{
                        value: item[value1],
                        text:item[text1]+ ' '+ apellido
                    }));
                });
            }else{
                console.error('Error al obtener los datos: ',response.error);
            }
        },
        error: function(xhr,status,error){
            console.error('Error al obtener los datos: ',error);
        }
    });
}

$(document).ready(function(){
    /* padre de familia*/
    cargarDatos('../datosE/nomPadres.php','padres','padres','Id_padres','nombre_p','apellidos_p');

    $('#padres').on('change', function() {
        var selectedPadresId = $(this).val();
        $('#Id_padres').val(selectedPadresId);
        console.log(selectedPadresId);
    });
    /*ESTUDIante*/
    cargarDatos('../datosE/nombre_est.php','estudiantes','estudiantes','Id_est','nombre_est','apellidos_est');

    $('#estudiantes').on('change', function(){
        var selectedEstId=$(this).val();
        $('#Id_est').val(selectedEstId);
        console.log(selectedEstId);
    });

});


/*BARRA DE PROGRESO*/

const pasos = document.querySelectorAll('.pasos .circle');
const indicador = document.querySelector('.progreso .indicador');

// Función para actualizar la barra de progreso
function actualizarBarraProgreso(pasoActual) {
    const anchoIndicador = (pasoActual - 1) / (pasos.length - 1) * 100 + '%';
    indicador.style.width = anchoIndicador;

}

function actualizarCirculos(pasoActual) {
    pasos.forEach((circulo, index) => {
        if (index < pasoActual - 1) {
            // Paso completado
            circulo.classList.add('active');
        } else {
            // Paso actual o futuro
            circulo.classList.remove('active');
        }
    });
}

// Inicializar la barra de progreso
actualizarBarraProgreso(1);
actualizarCirculos(1);

//FORMULARIO DE 1 A 2
document.getElementById('siguiente').addEventListener('click', function() {
    // Ocultar el primer formulario
    document.getElementById('formulario1').style.display = 'none';
    // Mostrar el segundo formulario
    document.getElementById('formulario2').style.display = 'block';
    // Actualizar la barra de progreso al segundo paso

    actualizarBarraProgreso(2);
    actualizarCirculos(2);

});

//FORMULARIO DE 2 A 3
document.getElementById('siguiente2').addEventListener('click', function() {
    // Ocultar el primer formulario
    document.getElementById('formulario2').style.display = 'none';
    // Mostrar el segundo formulario
    document.getElementById('formulario3').style.display = 'block';
    // Actualizar la barra de progreso al segundo paso

    actualizarBarraProgreso(3);
    actualizarCirculos(3);

});

//FORMULARIO DE 3 A 4

document.getElementById('siguiente3').addEventListener('click', function() {
    // Ocultar el segundo formulario
    document.getElementById('formulario3').style.display = 'none';
    // Mostrar el tercer formulario
    document.getElementById('formulario4').style.display = 'block';
    // Actualizar la barra de progreso al tercer paso
    actualizarBarraProgreso(4);
    actualizarCirculos(4);

    pasos[pasos.length - 1].classList.add('active');
});



document.getElementById('volver').addEventListener('click',function(){
    document.getElementById('formulario2').style.display = 'none';
    // Mostrar el formulario 1
    document.getElementById('formulario1').style.display = 'block';
    // Actualizar la barra de progreso al primer paso
    actualizarBarraProgreso(1);
    // Actualizar los círculos de pasos al primer paso
    actualizarCirculos(1);
});

document.getElementById('volver1').addEventListener('click',function(){
    document.getElementById('formulario3').style.display='none';
    document.getElementById('formulario2').style.display='block';

    actualizarBarraProgreso(2);
    actualizarCirculos(2)
});

document.getElementById('volver2').addEventListener('click',function(){
    document.getElementById('formulario4').style.display='none';
    document.getElementById('formulario3').style.display='block';

    actualizarBarraProgreso(3);
    actualizarCirculos(3)
});
