let paso =1;
const pasoInicial =1;
const pasoFinal = 3;
document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
})

function iniciarApp(){
    mostrarSeccion();
    tabs();//cambia la seccion cuando se presionen los tabs
    botonesPaginador();
    paginaSiguiente();
    paginaAnterior();

    consultarApi();//Consulta la api en el backend
}
function mostrarSeccion(){

    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }

    // seleccionar la seccion con el paso
    const seccion = document.querySelector(`#paso-${paso}`);
    seccion.classList.add('mostrar');


    //resalta el tab actual
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}
function tabs(){
const botones = document.querySelectorAll('.tabs button');
    botones.forEach(boton => {
        boton.addEventListener('click',function(e){
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
        })
    });
}

function botonesPaginador(){
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso===1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }else if (paso ===3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    }else{
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }
    mostrarSeccion();
}
function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){
        if(paso >= pasoFinal)return;
        paso++;
        
        botonesPaginador();
    });
}
function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){
        if(paso <= pasoInicial)return;
        paso--;
        
        botonesPaginador();
    });
}


async function consultarApi(){
    try {
        const url = 'http://localhost:8000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios (servicios){
    servicios.forEach(servicio=>{
        const {id, nombre, precio}= servicio;
        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent= nombre;

        const precioServicio = document.createElement('P');
        nombreServicio.classList.add('precio-servicio');
        nombreServicio.textContent= `$ ${precio}`;

    })
}