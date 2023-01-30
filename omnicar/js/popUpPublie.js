
var modalBg = document.querySelector('.modal-bg2');
var modalClose = document.querySelector('.btnFermer')

modalClose.addEventListener('click',function(){
    modalBg.classList.remove('bg-active2');
});

function lostFocus() {
    modalBg.classList.remove('bg-active2');
}

var boutons = document.getElementsByClassName('modal-btn2');
for (var i=0; i<boutons.length; i++) {
    boutons[i].onclick = function() { modalBg.classList.add('bg-active2'); };
}

