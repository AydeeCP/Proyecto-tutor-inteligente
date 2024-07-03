document.addEventListener('DOMContentLoaded', function() {
    var formulario = document.getElementById('formulario');
    var questionD = document.getElementById('questionD');
    var closeBtn = document.querySelector('.close');
    var contenido =document.querySelector('.contenido');

    questionD.addEventListener('click', function() {
        formulario.style.display = 'block';
        contenido.style.display='none';
    });

    closeBtn.addEventListener('click', function() {
        formulario.style.display = 'none';
        contenido.style.display = "flex";
        contenido.style.justifyContent = "center"; // Restablecer la alineación al centro
    });

    window.addEventListener('click', function(event) {
        if (event.target == formulario) {
            formulario.style.display = 'block';
            contenido.style.display='none';
        }
    });
});
