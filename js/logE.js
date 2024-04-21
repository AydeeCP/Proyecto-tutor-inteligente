/*icono de contraseña */

const pass=document.getElementById("contrasena");
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
});