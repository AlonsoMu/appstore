<?php

// function enviarMail($emailDestino = "", $asunto = "", $mensaje = ""){

// }
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

function enviarCorreo($datos = [])
{
  $mail = new PHPMailer(true);

  $estado = ["enviado" => false];

  try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'alonsomunoz263@gmail.com';          //SMTP username
    // NO OLVIDAR EL TOKEN DEL EMAIL (CLAVE PARA ENVIAR CORREOS)
    $mail->Password   = 'dbeksojqbvlyhsbg';                     //SMTP password
    $mail->CharSet    = 'UTF-8';                                //Codificación
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('alonsomunoz263@gmail.com', 'Proyecto de Prueba');
    // $mail->addAddress('1399488@senati.pe');                     //Destino  //Name is optional
    $mail->addAddress($datos['emailDestino']);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $datos['asunto'];                             //Asunto
    $mail->Body    = $datos['mensaje'];                            //Soporta HTML
    $mail->AltBody = 'El mensaje requiere soporte HTML';  //No soporta HTML

    $mail->send();
    $estado["enviado"] = true;
  } catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $estado["enviado"] = false;
  }
  echo json_encode($estado);
}
// $estado = ["enviado" => false];
// echo json_encode($estado);