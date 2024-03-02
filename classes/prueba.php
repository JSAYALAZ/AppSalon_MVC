<html>
    <p><strong>Hola. $this->nombre </strong> has creado 
    tu cuenta en App salon, solo deber confirmarlo pulsando 
    el siguiente enlace</p>
    <br>
    <p>Presiona aqui: <a class="boton" href='http://localhost:8000/confirmar-cuenta?token="'.$this->token.'"'>Confirmar Cuenta</a></p>

    <br>
    <p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>
</html>