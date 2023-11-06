<?php

session_start();  //Crear o heredar la sesion

require_once '../models/User.php';
require_once '../models/Mail.php';


if(isset($_POST['operacion'])){

  $usuario = new User(); //se dispara __CONSTRUCT()

  //Traigo el email mediante el array

  if($_POST['operacion'] == 'login'){
    //Preparamos el dato a enviar (arreglo asociativo)
    $datosEnviar = ["email" => $_POST['email']];

    //Guardamos el registro de acceso (correcto), FALSE (incorrecto)
    $registro = $usuario->login($datosEnviar);

    //JSON conteniendo el estado del LOGIN >>> Usuario(view)
    $statusLogin = [
      "acceso" => false,
      "mensaje" => ""
    ];

    if($registro == false){
      $_SESSION["status"] = false; //Variable de sesiones (asociativo) necesitan una clave (status)
      $statusLogin["mensaje"] = "El correo no existe";
    }else{
      //Si el correo existe, tenemos que evalidar la clave enviada ($_POST)
      //contra la clave encriptada almacenada en la BD
      $claveEncriptada = $registro["claveacceso"];
      $_SESSION["idusuario"] = $registro["idusuario"];
      $_SESSION["nombres"] = $registro["nombres"];
      $_SESSION["apellidos"] = $registro["apellidos"];
      $_SESSION["rol"] = $registro["rol"];

      //$_SESSION["avatar"] = $registro["avatar"]; <img src="//<?=$_SESSION["avatar"]">   

      if(password_verify($_POST['claveacceso'], $claveEncriptada)){
        $_SESSION["status"] = true;
        $statusLogin["acceso"] = true;
        $statusLogin["mensaje"] = "Acceso correcto";
        
      }else{
        $_SESSION["status"] = false;
        $statusLogin["mensaje"] = "Error en la contraseña";
      }
    }

    echo json_encode($statusLogin);

  }//Fin login
  

  if($_POST['operacion'] == 'enviarCorreo') {
    // Obtener el email del formulario

    
    // Validar que el email no esté vacío
    
        // Crear un valor aleatorio de 4 dígitos
        $valorAleatorio = random_int(100000, 999999);
        
        $mensaje = "
          <h3>SENATI</h3>
          <strong>Recuperación de cuenta</strong>
          <hr>
          <p>Estimado {$_POST['emailsecu']}, para recuperar el acceso, utilice la siguiente código:</p>
          <h3>{$valorAleatorio}</h3>
        ";

        // Arreglo con datos a guardar en la tabla de recuperación
        $datos = [
          'idusuario'         => $_POST['idusuario'],
          'emailsecu'         => $_POST['emailsecu'],
          'clavegenerada'     => $valorAleatorio
        ];

        // Creando registro
        $usuario->registrarDesbloqueo($datos);
        
        // Enviando correo
        enviarCorreo($_POST['emailsecu'], 'Código de Restauración', $mensaje);
        //$retornoDatos["mensaje"] = "Se ha generado y enviado la clave al email indicado";
  
  } // Fin generar clave

  

  if($_POST['operacion'] == 'validarClave'){

    $datos = [
      "idusuario"     => $_POST['idusuario'],
      "clavegenerada" => $_POST['clavegenerada'] //modal
    ];
    $resultado = $usuario->validarClave($datos);
    echo json_encode($resultado);
  
  } //Fin validar clave

  if ($_POST['operacion'] == 'actualizarClave'){
   
    $claveEncriptada = password_hash($_POST['claveacceso'],PASSWORD_BCRYPT);
    $idusuario = $_POST['idusuario'];
    $datos = [
      "idusuario"     => $idusuario,
      "claveacceso"   => $claveEncriptada
    ];
    echo json_encode($usuario->actualizarClave($datos));
}

 


}

if(isset($_GET['operacion'])){
  if($_GET['operacion'] == 'destroy'){
    session_destroy();
    session_unset();
    header("location:../index.php");
  }
}