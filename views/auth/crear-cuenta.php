<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llene el formulario para crear una cuenta</p>

<form action="/crear-cuenta" class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            id="nombre"
            name="nombre"
            type="text" 
            placeholder="Cual es tu nombre?"
        />
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            id="apellido"
            name="apellido"
            type="text" 
            placeholder="Cual es tu apellido?"
        />
    </div>
    <div class="campo">
        <label for="celular">Celular</label>
        <input 
            id="celular"
            type="tel" 
            name="celular"
            placeholder="Cual es tu contacto?"
        />
    </div>
    <div class="campo">
        <label for="emial">Email</label>
        <input 
            id="emial"
            type="mail" 
            name="emial"
            placeholder="Cual es tu email?"
        />
    </div>
    <div class="campo">
        <label for="passwd">Contraseña</label>
        <input 
            id="passwd"
            type="password" 
            name="passwd"
            placeholder="Ingrese contraseña"
        />
    </div>
    <input type="submit" class="boton" value="Crear Cuenta">
</form>
<div class="acciones">
    <p>Ya tiene una cuenta?  <a href="/">Iniciar sesion</a></p>
    <p>Olvidaaste tu contraseña?  <a href="/olvide">Recordar</a></p>
</div>