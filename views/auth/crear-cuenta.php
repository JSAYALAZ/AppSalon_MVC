<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llene el formulario para crear una cuenta</p>

<div class="alerta">
    <?php foreach($alertas as $alerta):?>
        <p><?php echo $alerta ?></p>
    <?php endforeach?>
</div>
<form action="/crear-cuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            id="nombre"
            name="nombre"
            type="text" 
            placeholder="Cual es tu nombre?"
            value="<?php echo s($usuario->nombre) ?>"
        />
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            id="apellido"
            name="apellido"
            type="text" 
            placeholder="Cual es tu apellido?"
            value="<?php echo s($usuario->apellido) ?>"
        />
    </div>
    <div class="campo">
        <label for="celular">Celular</label>
        <input 
            id="celular"
            type="tel" 
            name="celular"
            placeholder="Cual es tu contacto?"
            value="<?php echo s($usuario->celular) ?>"
        />
    </div>
    <div class="campo">
        <label for="email">Email</label>
        <input 
            id="email"
            type="mail" 
            name="email"
            placeholder="Cual es tu email?"
            value="<?php echo s($usuario->email) ?>"
        />
    </div>
    <div class="campo">
        <label for="passwd">Contraseña</label>
        <input 
            id="passwd"
            type="password" 
            name="passwd"
            placeholder="Ingrese contraseña"
            value="<?php echo s($usuario->passwd) ?>"
        />
    </div>
    <input type="submit" class="boton" value="Crear Cuenta">
</form>
<div class="acciones">
    <p>Ya tiene una cuenta?  <a href="/">Iniciar sesion</a></p>
    <p>Olvidaaste tu contraseña?  <a href="/olvide">Recordar</a></p>
</div>