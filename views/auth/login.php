<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesion con tus datos</p>
<?php foreach ($alertas as $key => $mensajes): ?>
    <?php foreach ($mensajes as $mensaje): ?>
        <div class="alerta <?php echo $key ?>">
        <?php echo $mensaje ?>
    </div>
    <?php endforeach ?>
<?php endforeach ?>
<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            id="email"
            type="email"
            name="email"
            placeholder="Ejem: correo@correo.com"
            value="<?php echo s($usuario->email) ?>"
        />
    </div>
    <div class="campo">
        <label for="passwd">Contraseña</label>
        <input 
            id="passwd"
            type="password"
            name="passwd"
            placeholder="Tu contraseña"
        />
    </div>
    <input type="submit" class="boton" value="iniciar Sesion">
</form>
<div class="acciones">
    <p>Aun no tienes una cuenta?  <a href="/crear-cuenta">Crear una</a></p>
    <p>Olvidaaste tu contraseña?  <a href="/olvide">Recordar</a></p>
</div>