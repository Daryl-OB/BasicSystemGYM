<?php

include "../includes/cargar_clases.php";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../includes/phpmailer/Exception.php';
require '../includes/phpmailer/PHPMailer.php';
require '../includes/phpmailer/SMTP.php';

if (isset($_POST["btn_recuperar_cuenta"])) {
    $codcli = $_POST["txt_user"];
    $mailCliente = $_POST["txt_mail"];

    $crudcliente = new CRUDCliente();

    $rs_cli = $crudcliente->BuscarClientePorCodigo($codcli);

    $nombre = $rs_cli->nombre;
    $codcliente = $rs_cli->codigo_cliente;
    $clave = $rs_cli->clave;

    if ($rs_cli != null) {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();    
            $mail->CharSet    = "UTF-8";                                        //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'daryloscco27@gmail.com';                     //SMTP username
            $mail->Password   = 'ldkm gubf pyjn dvzz';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('daryloscco27@gmail.com', 'Daryl Oscco');
            $mail->addAddress($mailCliente, $nombre);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'RECUPERAR CONTRASEÑA HK GYM';
            $mail->Body    = '<p>¡Hola <b>' . $nombre . '</b>! te saludamos de HK GYM. <br> 
                        <i>Recibimos una solicitud para recuperar tu cuenta...</i>
                    </p> 
                    <br>
                    <h3>Datos de la cuenta a recuperar</h3>
                    <p><b>Nombre del cliente: </b>' . $nombre . '</p>
                    <p><b>Codigo de usuario: </b>' . $codcliente . ' </p>
                    <p><b>Contraseña: </b>' . $clave . '</p>
                    <br><br>
                    <p><i>Esperamos haberte ayudado, que tengas buen dia</i></p>';

            $mail->AltBody = '¡Hola! te saludamos de HK GYM.
                    Hemos recibido tu solitud para recuperar tu cuenta...
                    ';

            $mail->send();
            echo "<script>window.location.replace('http://localhost/appgym_ds501/')</script>";
        } catch (Exception $e) {
            echo "<script>window.location.replace('http://localhost/appgym_ds501/')</script>";
        }
    } else {
        echo "<script>window.location.replace('http://localhost/appgym_ds501/')</script>";
    }
}