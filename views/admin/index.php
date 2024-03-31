<h1 class="nombre-pagina">Pagina de administracion</h1>
<p class="descripcion-pagina"></p>

<div class="barra">
    <p>Hola: <span><?php echo $nombre?? ''?></span></p>
    <a class="boton" href="/logout">Cerrar Sesion</a>
</div>

<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
            type="date"
            id="fecha"
            name="fecha"
            value="<?php echo $fecha ?>"
            >
        </div>
    </form>
</div>

<?php
    if(count($citas) === 0){
        echo "<h2> No hay citas </h2>";
    }
?>


<div class="citas-admin">
    <ul class="citas">
    <?php foreach ($citas as $key => $cita): ?>
        <?php if ($idCita !== $cita->id): ?>
            <li>
            <?php $total = 0 ?>
            <p>ID: <span><?php echo $cita->id?></span></p>
            <p>Hora: <span><?php echo $cita->hora?></span></p>
            <p>Cliente: <span><?php echo $cita->cliente?></span></p>
            <p>Email: <span><?php echo $cita->email?></span></p>
            <p>Celular: <span><?php echo $cita->celular?></span></p>
            
            <h3>Servicios</h3>
            <?php $idCita = $cita->id ?>
        <?php endif ?>
        

        <?php $total+= $cita->precio ?>

        <p class="servicio"><?php echo $cita->servicio!=null?($cita->servicio.'  $'. $cita->precio ):  'No se establecieron servicios' ?></p>

        <?php 
        if($cita->servicio!=null)
        {
            $actual = $cita->id??0;
            $proximo = $citas[$key+1]->id??0;
            if(esUltimo($actual, $proximo)){?>
                <p class="total">Total: <span>$ <?php echo $total ?></span></p>
            <?php
            }
        }
        ?>
    <?php endforeach ?>
    </ul>
</div>


<?php
    $script ="<script src='build/js/buscador.js'></script>"
?>