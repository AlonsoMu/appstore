<?php
// Configurar la zona local
date_default_timezone_set("America/Lima");

require_once '../models/Usuario.php';
require_once '../models/Funciones.php';
require_once '../models/Email.php';
require_once '../models/Sms.php';



if (isset($_POST['operacion'])){

  $usuario = new Usuario();
  
  

  // ¿Que operación es?
  switch ($_POST['operacion']) {
    case 'listar':
      enviarJson($usuario->listar());
      break;
    case 'registrar':
      $archivo = date('Ymdhis');
      $nombreArchivo = sha1($archivo). ".jpg";
      $datosEnviar = [
        'idrol'             => $_POST['idrol'],
        'idnacionalidad'    => $_POST['idnacionalidad'],
        'avatar'            => '',
        'apellidos'         => $_POST['apellidos'],
        'nombres'           => $_POST['nombres'],
        'email'           => $_POST['email'],
        'claveacceso'       => password_hash($_POST["claveacceso"], PASSWORD_BCRYPT)
      ];
      if (isset($_FILES['avatar'])){
        if(move_uploaded_file($_FILES['avatar']['tmp_name'], "../imagesuser/" . $nombreArchivo)){
          $datosEnviar['avatar'] = $nombreArchivo;
        }
      }
      enviarJson($usuario->registrar($datosEnviar));
      break;
    case 'eliminar':
      $datosEnviar = [
        "idusuario" => $_POST["idusuario"]
      ];
      echo $usuario->eliminar($datosEnviar);
      break;

    case 'registrarDesbloqueo':
      $datosEnviar=[
          "idusuario" => $_POST['idusuario'],
          "clavegenerada" => $_POST['clavegenerada']
      ];

      echo json_encode($usuario->registrarDesbloqueo($datosEnviar));

      break;


    case 'validarClave':

      $datosEnviar=[
          "campocriterio" => $_POST['campocriterio']
      ];

      $statusForm = [

          "status" => false,
          "mensaje" => ""
      ];

      $registro = $usuario->validarClave($datosEnviar);

      if(!$registro){

          $statusForm["mensaje"] = "Email o telefono incorrectos";
      }else{
          $statusForm["status"] = true;
          $statusForm["mensaje"] = "Coinciden";
      }

      $result = [$statusForm,$registro];

      echo json_encode($result);

      break;

      case 'sendEmail':
        $valorAleatorio = random_int(100000, 999999);
        $datosEnviar=[
          "emailDestino" => $_POST['emailDestino'],
            "asunto" => "recuperacion de contraseña",
            "mensaje" => "codigo de recuperacion: " . $valorAleatorio
        ];
        
        enviarCorreo($datosEnviar);
        break;

      case 'sendSMS':
        $valorAleatorio = random_int(100000, 999999);
        $datosEnviar=[
          "telefono" => $_POST['telefono'],
          "mensaje" => "codigo de recuperacion: " . $valorAleatorio
        ];
  
        enviarSMS($datosEnviar);
        break;

      case 'actualizarClave':
        $datosEnviar = [
          "idusuario" => $_POST["idusuario"],
          "claveacceso" => password_hash($_POST["claveacceso"], PASSWORD_BCRYPT)
        ];
        echo json_encode($usuario->actualizarClave($datosEnviar));
        break;

      
  }
}