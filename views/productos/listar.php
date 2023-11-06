<!doctype html>
<html lang="es">

<head>
  <title>Productos</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-light bg-light">
      <div class="container">
      <a class="navbar-brand" href="#"><strong>AppStore</strong></a>
      <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos</a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
              <a class="dropdown-item" href="./listar.php">Listar</a>
              <a class="dropdown-item" href="./registrar.php">Registrar</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuarios</a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
              <a class="dropdown-item" href="../usuarios/listar.php">Listar</a>
              <a class="dropdown-item" href="../usuarios/registrar.php">Registrar</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
  <div class="container mt-3">
    <div class="alert alert-info" role="alert">
      <h4>APP STORE</h4>
      <div>Lista de productos</div>
    </div>
    
    <table class="table table-sm table-striped" id="tabla-productos">
      <colgroup>
        <col width="5%">  <!-- # -->
        <col width="20%"> <!-- Categoria -->
        <col width="30%"> <!-- Descripción -->
        <col width="10%"> <!-- Precio -->
        <col width="10%"> <!-- Garantía -->
        <col width="10%"> <!-- Fotografía -->
        <col width="15%"> <!-- Comandos -->
      </colgroup>
      <thead>
        <tr>
          <th>#</th>
          <th>Categoria</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th>Garantía</th>
          <th>Fotografía</th>
          <th>Comandos</th>
        </tr>
      </thead>
      <tbody>
          <!-- DATOS CARGADOS DE FORMA ASINCRONA -->
      </tbody>
    </table>
  </div> <!-- Cierre del container -->

  <!-- ZONA DE MODALES -->
  <div class="modal fade" id="modal-visor" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-light">
          <h5 class="modal-title" id="modalTitleId">Imagen del producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img style="width: 100%;" src="" id="visor" alt="">
          <div class="row"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN ZONA MODALES -->


  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script>
    // VanillaJS (JS Puro)
    document.addEventListener("DOMContentLoaded", () => {
      const modalVisor = new bootstrap.Modal(document.getElementById('modal-visor'));
      function $(id){
        return document.querySelector(id);
      }
      

      // Comunicación Controlador
      // Renderizar los datos en la Tabla > tbody
      function listarProductos(){
        // Preparar los parametros a enviar
        const parametros = new FormData();
        parametros.append("operacion", "listar")

        fetch(`../../controllers/producto.controller.php`, {
          method: 'POST', 
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datosRecibidos => {
            // Recorrer cada fila del arreglo
            let numFila = 1;
            $("#tabla-productos tbody").innerHTML = '';
            datosRecibidos.forEach(registro => {
              let nuevafila = ``;
              // Enviar los valores obtenidos en celdas <td></td>
              nuevafila = `
              <tr>
                <td>${numFila}</td>
                <td>${registro.categoria}</td>
                <td>${registro.descripcion}</td>
                <td>${registro.precio}</td>
                <td>${registro.garantia}</td>
                <td>
                  <a href='#' class="linkFoto" data-url="${registro.fotografia}" data-nombre="${registro.categoria}">Ver</a>
                </td>
                
                <td>
                  <button data-idproducto="${registro.idproducto}" class='btn btn-danger btn-sm eliminar' type='button'>Eliminar</button>
                  <button data-idproducto="${registro.idproducto}" class='btn btn-warning btn-sm editar' type='button'>Editar</button>
                </td>
              </tr>
              
              `;

              $("#tabla-productos tbody").innerHTML += nuevafila;
              numFila++;
            });
          })
          .catch(e => {
            console.error(e)
          })
      }

      // DETECTANDO click sobre un elemento asíncrono
      // Creado en tiempo de ejecución (VER - ELIMINAR - EDITAR)
      $("#tabla-productos tbody").addEventListener("click", (event) =>{
        // console.log(event)
        if(event.target.classList.contains("linkFoto")){
          //console.log(event)
          const fotografia = event.target.dataset.url;
          const nombre = event.target.dataset.nombre;
          $("#visor").setAttribute("src", `../../images/${fotografia}`);
          $("#modalTitleId").innerHTML = nombre;
          modalVisor.toggle();

        }
        if(event.target.classList.contains("eliminar")){
          const idproducto = event.target.dataset.idproducto;
          const parametros = new FormData();
          parametros.append("operacion", "eliminar");
          parametros.append("idproducto", idproducto);

          if(confirm("¿Está seguro de eliminar?")){
            fetch(`../../controllers/producto.controller.php`,{
              method: "POST",
              body: parametros
            })
              .then(respuesta => respuesta.text())
              .then(datos =>{
                console.log(datos)
                listarProductos();
              })
              .catch(e => {
                console.error(e)
              });
          }
        }
        if(event.target.classList.contains("editar")){
          console.log("Proceso de edición")
        }
      })

      listarProductos();

    });



  </script>

</body>

</html>
