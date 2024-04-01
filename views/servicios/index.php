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

<ul class="servicios">
    <?php foreach($servicios as $servicio): ?>
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre ?></span></p>
            <p>Precio: <span>$ <?php echo $servicio->precio ?></span></p>
            <div class="acciones">
                <a href="/servicios/actualizar?id=<?php echo $servicio->id ?>" class="boton">Actualizar</a>
                <form action="/servicios/eliminar" method="post">
                    <input 
                    type="hidden"
                    name="id"
                    value="<?php echo $servicio->id ?>"
                    >

                    <input 
                    type="submit"
                    value="Eliminar"
                    class="boton-eliminar"
                    >
                </form>
            </div>
        </li>
    <?php endforeach ?>
</ul>