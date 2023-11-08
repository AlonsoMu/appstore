<?php

//1. Componente COMPOSER
require '../../vendor/autoload.php';

//2. Namespaces
use Spipu\Html2Pdf\Html2Pdf; //CORE = NUCLEO
use Spipu\Html2Pdf\Exception\Html2PdfException; //EXCEPCIONES = MANEJO DE ERRORES
use Spipu\Html2Pdf\Exception\ExceptionFormatter; // FORMATEAR

try {
  //iNTENTAR = acciones que deseamos ejecutar
  //3. Intancia
  //constructor(Orientacion[Portrait | Landscape], TipoPapel, idioma)
  $reporte = new Html2Pdf("P", "A4", "es", true, "UTF-8", array(25,15,15,15));
  $reporte->setDefaultFont("Arial");

  //Actualizacion
  //Ahora nuestro archivo de contenido recibirá datos dinámicos (variables, arreglos)
  $desarrollador = "Enrique Vásquez";
  $dataTable = [
    ["sede" => "Chincha", "carrera" =>"Ingeniería de Software"],
    ["sede" => "Pisco", "carrera" =>"Mecánica Automotriz"],
    ["sede" => "Ica", "carrera" =>"Mecatrónica Industrial"],
    ["sede" => "Ayacucho", "carrera" =>"Diseño Gráfico"],
  ];
  $carreras = ["Electricidad", "Soldadura", "Mecánica Mantenimiento", "Administración"];


  
  //Inicia la lectura del archivo
  ob_start();
  include 'estilos.html';
  include 'reporte3-contenido.php';
  
  $contenido = ob_get_clean();
  
  $reporte->writeHTML($contenido);

  $reporte->output("SENATI.pdf");

  
}
catch (Html2PdfException $e) {
  //Error = debemos realizar alguna acción
  $reporte->clean();

  $datosError = new ExceptionFormatter($e);
  
  //Mostrar error en el navegador
  echo $datosError->getHtmlMessage();
}






