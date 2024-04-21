/*icono de contraseña */
const pass=document.getElementById("password");
const icon=document.querySelector(".pass .bx");

icon.addEventListener("click", e =>{
    if(pass.type==="password"){
        pass.type= "text";

        /*mostrar nuevo icono contraseña*/
        icon.classList.remove('bxs-face-mask');
        icon.classList.add('bxs-face');

    }else{
        pass.type="password";
        icon.classList.add('bxs-face-mask');
        icon.classList.remove('bx-face');
    }
})

/*barra de progreso */

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

// Manejador de eventos para el botón "adelante"
document.getElementById('adelante').addEventListener('click', function() {
    // Ocultar el primer formulario
    document.getElementById('miFormulario').style.display = 'none';
    // Mostrar el segundo formulario
    document.getElementById('formAsig').style.display = 'block';
    // Actualizar la barra de progreso al segundo paso

    actualizarBarraProgreso(2);
    actualizarCirculos(2);

});

// Manejador de eventos para el botón "adelante2"
document.getElementById('Adelante2').addEventListener('click', function() {
    // Ocultar el segundo formulario
    document.getElementById('formAsig').style.display = 'none';
    // Mostrar el tercer formulario
    document.getElementById('form3').style.display = 'block';
    // Actualizar la barra de progreso al tercer paso
    actualizarBarraProgreso(3);
    actualizarCirculos(3);

    pasos[pasos.length - 1].classList.add('active');
});

document.getElementById('back1').addEventListener('click',function(){
    document.getElementById('formAsig').style.display = 'none';
    // Mostrar el formulario 1
    document.getElementById('miFormulario').style.display = 'block';
    // Actualizar la barra de progreso al primer paso
    actualizarBarraProgreso(1);
    // Actualizar los círculos de pasos al primer paso
    actualizarCirculos(1);
});

document.getElementById('back2').addEventListener('click',function(){
    document.getElementById('form3').style.display='none';
    document.getElementById('formAsig').style.display='block';

    actualizarBarraProgreso(2);
    actualizarCirculos(2)
});



/*cargar los nombres de los docentes */
$(document).ready(function() {
  // Al cargar la página, obtenemos los nombres y apellidos de los docentes
$.ajax({
    url: '../datosD/nombresD.php',
    type: 'GET',
    dataType: 'json',
    success: function(response) {
        if (response.success) {
            var selectDocente = $('#docente');
            selectDocente.empty(); 
            
            $.each(response.docente, function(index, docente) {
                selectDocente.append($('<option>', {
                    value: docente.Id,
                    text: docente.nombre + ' ' + docente.apellido
                }));
            });
        } else {
            console.error('Error al obtener los docentes:', response.error);
        }
    },
        error: function(xhr, status, error) {
            console.error('Error al obtener los docentes:', error);
        }
    });
    /**obtencion del id */
    $('#docente').on('change', function(){
        var selectedDocenteId = $(this).val();
            //console.log(selectedDocenteId);

            $('#id_docente').val(selectedDocenteId); 
    });

});

