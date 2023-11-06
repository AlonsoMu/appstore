<?php
session_start();

$permisos = [
  "ADM" => ["categoria", "index", "./productos/listar", "reportes", "roles", "./usuarios/listar", "ventas"],
  "INV" => ["./productos/listar", "index"],
  "AST" => ["categoria", "index", "./productos/listar", "ventas", "reportes"],
];

if(!isset($_SESSION["status"]) || !$_SESSION["status"]){
  header("Location:../index.php");
  exit();
}

?>


<!doctype html>
<html lang="es">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

  <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-3">
      <div class="container">
        <a class="navbar-brand" href="index.php">Navbar</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav me-auto mt-2 mt-lg-0">


            <?php
            //Se obtiene la lista módulos/ vistas que temdra acceso al usuario
            $listaOpciones = $permisos[$_SESSION["rol"]];
            foreach ($listaOpciones as $opcion) {
              if($opcion!= "index"){
                echo "
                <li class='nav-item'>
                  <a class='nav-link' style='text-transform: capitalize' href='{$opcion}.php'>". 
                  str_replace('./productos/listar', 'Productos', 
                  str_replace('./usuarios/listar', 'Usuarios', $opcion)) ."</a>
                </li>
                ";
              }
            }

            //funcion global - crear sesiones - crear componentes para cada menu de ellos, puedo jalar depende de que estoy jalando, puedo colocar de forma directa
            //str_replace: 
            ?>
          </ul>
          

            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?= $_SESSION["apellidos"]; ?>  
                  <?= $_SESSION["nombres"]; ?>
                  (<?= $_SESSION["rol"]; ?>)
                  
                </a>
              <div class="dropdown-menu" aria-labelledby="dropdownId">
                <a class="dropdown-item" href="#">Soporte</a>
                <a class="dropdown-item" href="../controllers/user.controller.php?operacion=destroy">Cerrar sesión</a>
              </div>
            </li>
            
          </ul>


        </div>
      </div>
    </nav>

    <?php

    
    

    $url = $_SERVER['REQUEST_URI'];
    
    $arregloURL = explode("/", $url);
    $vistaActual = $arregloURL[count($arregloURL)-1];

    $permitido = false;
    foreach ($listaOpciones as $opcion) {
      if($opcion . ".php" == $vistaActual){
        $permitido = true;
      }
    }

    if(!$permitido){
      echo '
        <div class="container">
        <h3>Acceso no permitido</h3>
        </div>
      ';
      exit();
    }

    ?>
  
</body>

</html>