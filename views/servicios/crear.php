<h1 class="nombre-pagina">Nuevo Servicio</h1>
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
<?php foreach ($alertas as $key => $mensajes): ?>
    <?php foreach ($mensajes as $mensaje): ?>
        <div class="alerta <?php echo $key ?>">
        <?php echo $mensaje ?>
    </div>
    <?php endforeach ?>
<?php endforeach ?>


<form action="/servicios/crear" method="POST" class="formulario">
    <?php
        include_once 'formulario.php';
    ?>
    <input type="submit" class="boton" value="Guardar Servicio">
</form>