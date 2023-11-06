<?php

function enviarJson($datos){
  if($datos){
    echo json_encode($datos);
  }
}