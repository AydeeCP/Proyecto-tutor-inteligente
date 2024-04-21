const btnD = document.getElementById('btnD');
const btnE  = document.getElementById('btnE');
const audioD = document.getElementById('audioD');
const audioE = document.getElementById('audioE');


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
