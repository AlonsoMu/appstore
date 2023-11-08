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

    


    case 'buscarUsuario':

      $datosEnviar = $usuario->buscarUsuario
      (
        ['email' => $_POST['email']]
      );

    if ($datosEnviar) {
      echo json_encode($datosEnviar);
    }

      break;

    case 'enviarCorreo':
      $valorAleatorio = random_int(100000, 999999);
      $mensaje = "
      <h1>Recuperación de su cuenta</h1>
      <hr>
      <p>Estimado(a), para recuperar el acceso a su cuenta utilice la siguiente contraseña:</p>
      <h1 style='color:cornflowerblue;font-size:50px;'>{$valorAleatorio}</h1>
    ";

    $datosEnviar = [
      'idusuario'     => $_POST['idusuario'],
      'email'         => $_POST['email'],
      'clavegenerada' => $valorAleatorio
    ];

    enviarCorreo($_POST['email'], 'Código de restauración', $mensaje);

    $usuario->registrarDesbloqueo($datosEnviar);

    
      break;

        /*case 'enviarCorreo':
          $valorAleatorio = random_int(100000, 999999);
          $email = $_POST['email'];
          
          // Verificar si el correo electrónico existe en la base de datos
          $usuarioExistente = $usuario->buscarUsuario(['email' => $email]);
      
          if ($usuarioExistente) {
              $mensaje = "
              <h1>Recuperación de su cuenta</h1>
              <hr>
              <p>Estimado(a), para recuperar el acceso a su cuenta utilice la siguiente contraseña:</p>
              <h1 style='color:cornflowerblue;font-size:50px;'>{$valorAleatorio}</h1>
              ";
      
              $datosEnviar = [
                  'idusuario'     => $usuarioExistente['idusuario'],
                  'email'         => $email,
                  'clavegenerada' => $valorAleatorio
              ];
      
              $usuario->registrarDesbloqueo($datosEnviar);
      
              enviarCorreo($email, 'Código de restauración', $mensaje);
      
              echo json_encode(['success' => true, 'message' => 'Correo enviado con éxito.']);
          } else {
              echo json_encode(['success' => false, 'message' => 'El correo electrónico no existe en la base de datos.']);
          }
          break;*/
      
      
      

    case 'sendSms':
      $valorAleatorio = random_int(100000, 999999);
  
      // Mensaje para el SMS
      $mensajes = "Su código de restauración es: " . $valorAleatorio;
  
      $datosEnviar = [
          'idusuario'     => $_POST['idusuario'],
          'telefono'      => $_POST['telefono'],
          'clavegenerada' => $valorAleatorio
      ];
  
      // Llamada a la función para registrar el desbloqueo
      $usuario->desbloqueoSms($datosEnviar);
  
      // Llamada a la función para enviar el SMS
      enviarSMS($_POST['telefono'], $mensajes);
      break;


      
    case 'validar':
      $datos = [
        'idusuario'         => $_POST['idusuario'],
        'clavegenerada'     => $_POST['clavegenerada'] //modal
      ];
  
      echo json_encode($usuario->validarClave($datos));
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