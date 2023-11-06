<?php




require '../vendor/autoload.php';
require_once 'Conexion.php';

class Usuario extends Conexion{
  private $usuario;

  public function __CONSTRUCT(){
    $this->usuario = parent::getConexion();
  }

  public function listar(){
    try {
      $consulta = $this->usuario->prepare("CALL spu_usuarios_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage()); //Desarrollo > Producción
    }
  }

  public function registrar($datos = []){
    try {
      $consulta = $this->usuario->prepare("CALL spu_usuarios_registrar(?,?,?,?,?,?,?)");
      $consulta->execute(
        array(
          $datos['idrol'],
          $datos['idnacionalidad'],
          $datos['avatar'],
          $datos['apellidos'],
          $datos['nombres'],
          $datos['email'],
          $datos['claveacceso']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function eliminar($datos = []){
    try {
      $consulta = $this->usuario->prepare("CALL spu_usuarios_eliminar(?)");
      $status = $consulta->execute(
        array(
          $datos['idusuario']
      )
    );
    return $status;
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
  }

  

public function registrarDesbloqueo($datos = []){
  try{
    $consulta = $this->usuario->prepare("CALL spu_desbloqueos_registrar(?,?)");
    $consulta->execute(
      array(
        $datos['idusuario'],
        $datos['clavegenerada']
      )
    );
    return $consulta->fetch(PDO::FETCH_ASSOC);
  }
  catch(Exception $e){
    die($e->getMessage());
  }
}

public function validarClave($datos = []){
  try{
    $consulta = $this->usuario->prepare("CALL spu_clavegenerada_obtener(?)");
    $consulta->execute(
        array(
            $datos['campocriterio']
        )
    );

    return $consulta->fetch(PDO::FETCH_ASSOC);
  }
  catch(Exception $e){
      die($e->getMessage());
  }
}

public function actualizarClave($datos = []){
  $resultado = ['status' => false];
  try {
    $consulta = $this->usuario->prepare("CALL spu_usuario_actualizarclave(?,?)");
    $resultado['status'] = $consulta->execute(
      array(
        $datos['idusuario'],
        $datos['claveacceso']
      )
    );
    return $resultado;
  } catch (Exception $e) {
    die($e->getMessage());
  }
}



  

}

