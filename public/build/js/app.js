let paso=1;const pasoInicial=1,pasoFinal=3;function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarApi()}function mostrarSeccion(){const t=document.querySelector(".mostrar");t&&t.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");const o=document.querySelector(".actual");o&&o.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach(t=>{t.addEventListener("click",(function(t){paso=parseInt(t.target.dataset.paso),mostrarSeccion()}))})}function botonesPaginador(){const t=document.querySelector("#anterior"),o=document.querySelector("#siguiente");1===paso?(t.classList.add("ocultar"),o.classList.remove("ocultar")):3===paso?(t.classList.remove("ocultar"),o.classList.add("ocultar")):(t.classList.remove("ocultar"),o.classList.remove("ocultar")),mostrarSeccion()}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=3||(paso++,botonesPaginador())}))}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,botonesPaginador())}))}async function consultarApi(){try{const t="http://localhost:8000/api/servicios",o=await fetch(t);mostrarServicios(await o.json())}catch(t){console.log(t)}}function mostrarServicios(t){t.forEach(t=>{const{id:o,nombre:e,precio:a}=t,c=document.createElement("P");c.classList.add("nombre-servicio"),c.textContent=e;document.createElement("P");c.classList.add("precio-servicio"),c.textContent="$ "+a})}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));