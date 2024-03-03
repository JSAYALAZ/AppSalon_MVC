<h1 class="nombre-pagina">Confirmar Cuentas</h1>

<?php foreach ($alertas as $key => $mensajes): ?>
    <?php foreach ($mensajes as $mensaje): ?>
        <div class="alerta <?php echo $key ?>">
            <?php echo $mensaje ?>
        </div>
    <?php endforeach ?>
<?php endforeach ?>

<div class="acciones">
    <p>Ya tiene una cuenta? <a href="/">Iniciar sesion</a></p>
</div>