var audio;
function playSound(audioURL) {
    audio = new Audio(audioURL);
    //console.log("Sonido activado");
    audio.play();
}

function stopSound() {
    if(audio) {
        audio.pause();
        audio.currentTime = 0;
        console.log("Sonido detenido");
    }
}

