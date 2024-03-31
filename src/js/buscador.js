
document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp(){
    buscarXFecha();
}

function buscarXFecha(){
    const inptFecha = document.querySelector('#fecha');
    inptFecha.addEventListener('input',function(e){
        const fechaSeleccionada = e.target.value;

        window.location = `?fecha=${fechaSeleccionada}`
    });
}