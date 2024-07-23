const btnD = document.getElementById('btnD');
const btnE  = document.getElementById('btnE');
const btnPad  = document.getElementById('btnPad');
const audioD = document.getElementById('audioD');
const audioE = document.getElementById('audioE');
const audioP = document.getElementById('audioP');


btnD.addEventListener('mouseover', () => {
    audioD.play();
});

btnD.addEventListener('mouseout', () => {
    audioD.pause();
    audioD.currentTime = 0;
});

btnE.addEventListener('mouseover', () => {
    audioE.play();
});

btnE.addEventListener('mouseout', () => {
    audioE.pause();
    audioE.currentTime = 0;
});
btnPad.addEventListener('mouseover', () => {
    audioP.play();
});

btnPad.addEventListener('mouseout', () => {
    audioP.pause();
    audioP.currentTime = 0;
});
