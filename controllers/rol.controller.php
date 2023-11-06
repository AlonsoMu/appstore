<?php

require_once '../models/Rol.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])){

  $rol = new Rol();

  switch ($_POST['operacion']) {
    case 'listar':
      enviarJson($rol->listar());
      break;
  }

}