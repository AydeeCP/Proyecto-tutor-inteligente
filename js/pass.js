
document.addEventListener("DOMContentLoaded", function() {

const pass = document.getElementById("password"),
    icon = document.querySelector(".bx");

    icon.addEventListener("click", e => {
        if (pass.type === "password") {
            pass.type = "text";
            /*mostrar nuevo icono contraseña*/
            icon.classList.remove('bxs-face-mask');
            icon.classList.add('bxs-face');
            console.log('contraseña mostrada');
        } else {
            pass.type = "password";
            icon.classList.add('bxs-face-mask');
            icon.classList.remove('bxs-face');
        }
    })    
});