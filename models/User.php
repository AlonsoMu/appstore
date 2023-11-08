<?php

require_once 'Conexion.php';

class User extends Conexion{
  private $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  public function login($datos = []){
    try {
      $consulta = $this->pdo->prepare("CALL spu_usuarios_login(?)");
      $consulta->execute(
        array(
          $datos['email']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
      
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

}



