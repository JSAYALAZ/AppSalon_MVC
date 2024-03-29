<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuacion</p>

<?php if ($alertas != null): ?>
    <?php foreach ($alertas as $key => $mensajes): ?>
        <?php foreach ($mensajes as $mensaje): ?>
            <div class="alerta <?php echo $key ?>">
                <?php echo $mensaje ?>
            </div>
        <?php endforeach ?>
    <?php endforeach ?>
<?php endif ?>

<?php if (!$error):?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="passwd"> Password</label>
        <input 
        type="password"
        id="passwd"
        name="passwd"
        placeholder="Tu nueva contraseña"
        >
    </div>
    <input type="submit" class="boton" value="Actualizar contraseña">
</form>
<?php endif 
?>
<div class="acciones">
    <p>Aun no tienes una cuenta?  <a href="/crear-cuenta">Crear una</a></p>
    <p>Ya tiene una cuenta? <a href="/">Iniciar sesion</a></p>
</div>
