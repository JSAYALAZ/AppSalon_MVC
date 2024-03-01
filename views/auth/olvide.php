<h1 class="nombre-pagina">Olvide contraseña</h1>
<p class="descripcion-pagina">Restablecer contraseña con correo electronico</p>

<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="mail">Ingrese correo</label>
        <input 
            id="mail"
            type="mail"
            name="mail"
            placeholder="Ingrese correo"
        />
    </div>
    <input type="submit" class="boton" value="Enviar correo">
</form>

<div class="acciones">
    <p>Ya tiene una cuenta?  <a href="/">Iniciar sesion</a></p>
    <p>Aun no tienes una cuenta? <a href="/crear-cuenta">Crear una</a></p>
</div>
<!-- <a href="/"><p class="boton">Volver</p></a> -->

