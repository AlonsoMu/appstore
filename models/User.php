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

  //--------------------------------------------------------------------------------------------------

  public function registrarDesbloqueo($datos = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_desbloqueos_registrar(?,?,?)");
      $consulta->execute(
        array(
          $datos['idusuario'],
          $datos['emailsecu'],
          $datos['clavegenerada']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }


  //--------------------------------------------------------------------------------------------------
  public function desbloqueosms($datos = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_desbloqueosms_registrar(?,?,?)");
      $consulta->execute(
        array(
          $datos['idusuario'],
          $datos['telefono'],
          $datos['clavegenerada']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  //--------------------------------------------------------------------------------------------------

  public function validarClave($datos = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_usuario_validarclave(?,?)");
      $consulta->execute(
        array(
          $datos['idusuario'],
          $datos ['clavegenerada']
      ));

      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  //--------------------------------------------------------------------------------------------------

  public function actualizarClave($datos = []){
    $resultado = ['status' => false];
    try{
      $consulta = $this->pdo->prepare("CALL spu_usuario_actualizarclave(?,?)");
      $resultado['status'] = $consulta->execute(
        array(
          $datos['idusuario'],
          $datos['claveacceso']
      ));
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }
}



