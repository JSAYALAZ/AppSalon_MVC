

let paso =1;
const pasoInicial =1;
const pasoFinal = 3;
const cita ={
    id: '',
    nombre: '',
    fecha: '',
    hora:'',
    servicios:[]
}

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
    idCliente();
    nombreCliente();
    seleccionarFecha();
    seleccionarHora();

    mostrarResumen();
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
            e.preventDefault();

            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();

            botonesPaginador();
            if(paso ===3){
                mostrarResumen();
            }
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
        mostrarResumen();
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
        const url = 'http://127.0.0.1:8000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}
function mostrarServicios (servicios){
    servicios.forEach(servicio=>{//bucle for each
        const {id, nombre, precio}= servicio;
        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent= nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent= `$ ${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function(){
            seleccionarServicio(servicio);
        };

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);
    })
}
function seleccionarServicio(servicio){
    const {id}=servicio;
    const {servicios}=cita;
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
    //COMPROBAR SI YA ESTA SELECCIONADO
    if(servicios.some(agregado => agregado.id===id)){
        cita.servicios = servicios.filter(agregado=> agregado.id !==id);
        divServicio.classList.remove('seleccionado');
    }else{
        cita.servicios=[...servicios, servicio];
        divServicio.classList.add('seleccionado');
    }

}

function nombreCliente(){
    cita.nombre = document.querySelector('#nombre').value;
}
function idCliente(){
    cita.id = document.querySelector('#id').value;
}

function seleccionarFecha(){
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e){
        const dia = new Date(e.target.value).getUTCDay();
        if([6,0].includes(dia)){
            e.target.value = '';
            mostrarAlerta('Fines de semana no permitido', 'error', '.formulario');
        }else{
            cita.fecha = e.target.value
        }
    })
}
function seleccionarHora(){
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e){
        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        if(hora<7 || hora >19){
            e.target.value='';
            mostrarAlerta('Hora de la cita no valida', 'error', '.formulario');
        }else{
            cita.hora = e.target.value;
        }
    })
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){
    //no doble mensaje
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia) {
        alertaPrevia.remove();
    }


    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const formulario = document.querySelector(elemento);
    formulario.appendChild(alerta);

    if(desaparece){
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
    
}

function mostrarResumen(){
    const resumen = document.querySelector('.contenido-resumen');
    // LIMPIAR RESUMEN DIV

    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }

    if(Object.values(cita).includes('') || cita.servicios.length == 0 ){
        mostrarAlerta('Falta datos del servicio', 'error', '.contenido-resumen',false);
        return;
    }

    // FORMATEAR EL DIV DEL RESUMEN

    const {nombre, fecha, hora, servicios}=cita;

    const headingCita = document.createElement('H3');
    headingCita.textContent='Resumen de Cita';
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML= `<span>Nombre: </span> ${nombre}`

    //FORMATEAR FECHA PARA UI
    const fechaObj = new Date(fecha);
    const opcionesDay = 
    {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate()+2;
    const year = fechaObj.getFullYear();
    const fechaUTC = new Date(Date.UTC(year, mes, dia));
    const fechaFormateado = fechaUTC.toLocaleDateString('es-MX', opcionesDay);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML= `<span>Fecha: </span> ${fechaFormateado}`;

    const horaCliente = document.createElement('P');
    horaCliente.innerHTML= `<span>Hora: </span> ${hora}`

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCliente);


    //heading para servicios
    const headingServicios = document.createElement('H3');
    headingServicios.textContent='Resumen de servicios';
    resumen.appendChild(headingServicios);

    //mostrar los servicios seleccionados
    servicios.forEach(servicio => {
        const {id, precio, nombre}= servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicios');

        const textoServicio = document.createElement('P');
        textoServicio.textContent= nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio: </span> $${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    });
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent= 'Reservar cita';
    botonReservar.onclick= reservarCita;

    resumen.appendChild(botonReservar);
}


//funcion asincrona
async function reservarCita(){
    //ASIGNACION DE DATOS A ENVIAR
    const {nombre, fecha, hora, servicios, id} = cita;
    const idServicios = servicios.map(servicio => servicio.id);

    const datos = new FormData();
    datos.append('usuarioId', id);
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('servicios', idServicios);


    try {
        // PETICION A LA API 
        const url = 'http://127.0.0.1:8000/api/citas';
        const respuesta = await fetch(url,{
            method: 'POST',
            body: datos
        });
        
        const resultado = await respuesta.json();
        if(resultado.resultado){
            Swal.fire({
                icon: "success",
                title: "Cita creada",
                text: "Tu cita a sido creada correctamente",
                button: 'OK'
            }).then(()=>{
                window.location.reload();
            })
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Something went wrong!"
          });
    }
    
}