alert("funciona");
function cargarContenido(url) {
    console.log('Cargando contenido desde:', url);
    var contenido = document.getElementById('contenido');

    // Realizar una solicitud AJAX para cargar el contenido de la página
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            contenido.innerHTML = xhr.responseText;
        }
    };
    xhr.send();
    return false; // Evita que el enlace cambie la URL
}

document.querySelectorAll('.header .navigation ul li a').forEach(item => {
        item.addEventListener('click', () => {
            document.getElementById('toggle').checked = false;
        });
    });