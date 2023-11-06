<?php

require_once 'Conexion.php';

class Nacionalidad extends Conexion{
  private $nacionalidad;

  public function __CONSTRUCT(){
    $this->nacionalidad = parent::getConexion();
  }

  public function listar(){
    try {
      $consulta = $this->nacionalidad->prepare("CALL spu_nacionalidades_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage()); //Desarrollo > Producción
    }
  }

}

