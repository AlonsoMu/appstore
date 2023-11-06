<?php

function enviarSMS($datos = []){
  $token = "MjA0NzIzMDgwNTpEOEM3QkZBRjNFRDA=";
  $autorization = "Authorization: Bearer ".$token;
  $fields_string = "";
  $smsnumber = $datos['telefono'];
  $smstext = $datos['mensaje'];
  $smstype = "1"; // 0: remitente largo, 1: remitente corto
  $shorturl = "0"; // acortador URL

  //Preparamos las variables que queremos enviar
  $url = 'https://api3.gamanet.pe/token/smssend';
  $fields = array(
    'smsnumber'=>urlencode($smsnumber),
    'smstext'=>urlencode($smstext),
    'smstype'=>urlencode($smstype),
    'shorturl'=>urlencode($shorturl)
  );

  //Preparamos el string para hacer POST (formato querystring)
  foreach($fields as $key=>$value) { 
        $fields_string .= $key.'='.$value.'&'; 
  }
  $fields_string = rtrim($fields_string,'&');


  //abrimos la conexion
  $ch = curl_init();

  //configuramos la URL, numero de variables POST y los datos POST
  curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/x-www-form-urlencoded', $autorization));
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false); //Descomentarlo si usa HTTPS
  curl_setopt($ch,CURLOPT_POST,count($fields));
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

  //ejecutamos POST
  $result = curl_exec($ch); //result es un JSON

  //cerramos la conexion
  curl_close($ch);

  //Resultado
  // json_encode() : objeto > json
  // json_decode() : json > objeto
  // $array = json_decode($result,true);
  // return $array;
  return $result; 
}

// $resultado = enviarSMS("922634773", "Cada día mas hacker");
// echo "<pre>";
// var_dump($resultado);
// echo "</pre>";
          
          
          