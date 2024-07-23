function actualizarInsignia() {
    let insignia = 'ninguna'; 
    var med = document.getElementById('medalla');
    // Determinar qué insignia mostrar
    if (palabrasAcertadas === totalPalabras) {
        insignia = 'oro';
        console.log("Oro: "+palabrasAcertadas);
        med.textContent=insignia;
    } else if (palabrasAcertadas >= totalPalabras * 0.8) {
        insignia = 'plata';
        console.log("plata: "+palabrasAcertadas);
        med.textContent=insignia;
    } else if (palabrasAcertadas >= totalPalabras * 0.5) {
        insignia = "bronce";
        med.textContent = insignia;
    }else {
        insignia = "ninguna";
        console.log("Ninguna insignia: " + palabrasAcertadas);
        med.textContent = insignia;
    }
    
    // Almacenar la información de la insignia en localStorage
    localStorage.setItem("insignia", insignia);
    console.log("insignia: "+insignia);

    // Obtener el contenedor de la insignia
    const insigniaContainer = document.querySelector('.insignia-container');
    
    // Limpiar el contenedor
    insigniaContainer.innerHTML = '';
    
    // Crear la imagen de la insignia y añadirla al contenedor
    if(insignia != 'ninguna'){
        const insigniaImg = document.createElement('img');
        insigniaImg.src = `../image/insignia_${insignia}.png`;
        insigniaImg.alt = `${insignia}`;
        insigniaImg.classList.add('insignia');
        insigniaContainer.appendChild(insigniaImg);
    }
}

window.onload = function() {
    const estadoInsignia = localStorage.getItem("insignia");
    if (estadoInsignia) {
        actualizarInsignia(estadoInsignia);
    }
};