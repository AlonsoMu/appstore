<?php
// Configurar la zona local
date_default_timezone_set("America/Lima");

require_once '../models/Producto.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])){

  $producto = new Producto();

  // ¿Que operación es?
  switch ($_POST['operacion']) {
    case 'listar':
      // EL método listar retorna un array PHP asociativo, esto no lo entiende el navegador
      // Entonces convertimos el arreglo en un objeto JSON y lo enviamos a la vista.
      enviarJson($producto->listar());
      // render... ENVIAR ETIQUETAS / DATOS NAVEGADOR
      break;
    case 'registrar':
      // Generar un nombre a partir del momento exacto
      $archivo = date('Ymdhis');
      $nombreArchivo = sha1($archivo). ".jpg";
      // Recolectar / recibir los valores enviados desde la vista
      $datosEnviar = [
        'idcategoria'   => $_POST['idcategoria'],
        'descripcion'   => $_POST['descripcion'],
        'precio'        => $_POST['precio'],
        'garantia'      => $_POST['garantia'],
        'fotografia'    => ''
      ];

      // Solo movemos la imagen si esta existe (uploaded)
      if (isset($_FILES['fotografia'])){
        if(move_uploaded_file($_FILES['fotografia']['tmp_name'], "../images/" . $nombreArchivo)){
          // Enviamos el aareglo al método
          $datosEnviar['fotografia'] = $nombreArchivo;
          // var_dump($_FILES['fotografia']); // BINARIO (JPG, PDF, MP3, MP4, DOCX)
        }
      }
      enviarJson($producto->registrar($datosEnviar));
      break;
    
    case 'eliminar':
      $datosEnviar = [
        "idproducto" => $_POST["idproducto"]
      ];
      echo $producto->eliminar($datosEnviar);
      break;

    case 'filtrarCategoria':
      $datosEnviar = ["idcategoria" => $_POST["idcategoria"]];
      echo json_encode($producto->filtrarCategoria($datosEnviar));
      break;

    case 'especificarProducto':
      $datosEnviar = ["idproducto" => $_POST["idproducto"]];
      echo json_encode($producto->especificarProducto($datosEnviar));
      break;

      case 'registrarEspecificacion':
        $archivo = date('Ymdhis');
        $nombreArchivo = sha1($archivo). ".jpg";
        // Recolectar / recibir los valores enviados desde la vista
        $datosEnviar = [
          'idproducto'    => $_POST['idproducto'],
          'clave'         => $_POST['clave'],
          'valor'         => $_POST['valor'],
          'rutafoto'      => ''
        ];

        // Solo movemos la imagen si esta existe (uploaded)
      if (isset($_FILES['rutafoto'])){
        if(move_uploaded_file($_FILES['rutafoto']['tmp_name'], "../images/" . $nombreArchivo)){
          // Enviamos el aareglo al método
          $datosEnviar['rutafoto'] = $nombreArchivo;
          // var_dump($_FILES['fotografia']); // BINARIO (JPG, PDF, MP3, MP4, DOCX)
        }
      }
  
        enviarJson($producto->registrarEspecificacion($datosEnviar));
        break;
  }


  
}
