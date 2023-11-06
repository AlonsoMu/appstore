<?php

require_once '../models/Nacionalidad.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])){

  $nacionalidad = new Nacionalidad();

  switch ($_POST['operacion']) {
    case 'listar':
      enviarJson($nacionalidad->listar());
      break;
  }

}