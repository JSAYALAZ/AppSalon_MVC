<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $nombre;
    public $token;

    public function __construct($email,$nombre,$token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '462eb7452807d7';
        $mail->Password = '2090c0d9aa0408';
    
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
    
        $contenido = "
    <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 600px;
                    margin: 20px auto;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                }
                h1 {
                    color: #333;
                }
                p {
                    color: #666;
                }
                a {
                    color: #007bff;
                    text-decoration: none;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>Hola, $this->nombre</h1>
                <p>Has creado tu cuenta en App salon. Solo debes confirmarlo pulsando el siguiente enlace:</p>
                <p><a href='http://localhost:8000/confirmar-cuenta?token=$this->token'>Confirmar Cuenta</a></p>
                <p>Si no solicitaste esta cuenta, puedes ignorar este mensaje.</p>
            </div>
        </body>
    </html>
";
    
        $mail->Body = $contenido;
        // Enviar email
        $mail->send();
    }
}

