<?php

require_once '../models/Categoria.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])){

  $categoria = new Categoria();

  switch ($_POST['operacion']) {
    case 'listar':
      enviarJson($categoria->listar());
      break;
    case 'registrar':
      $datosEnviar = [
        'categoria'   => $_POST['categoria'],
      ];
      $categoria->registrar($datosEnviar);
      break;
  }

}