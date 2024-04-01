<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administrador de servicios</p>

<div class="barra">
<p>Hola: <span><?php echo $nombre?? ''?></span></p>
<a class="boton" href="/logout">Cerrar Sesion</a>
</div>
<div class="barra-servicios">
<a class="boton" href="/admin">Ver citas</a>
<a class="boton" href="/servicios">Ver servicios</a>
<a class="boton" href="/servicios/crear">Nuevo Servicio</a>
</div>

<?php foreach ($servicios as $servicio): ?>
    
<?php endforeach ?>