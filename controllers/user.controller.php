<?php

session_start();  //Crear o heredar la sesion

require_once '../models/User.php';


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
  


}

if(isset($_GET['operacion'])){
  if($_GET['operacion'] == 'destroy'){
    session_destroy();
    session_unset();
    header("location:../index.php");
  }
}