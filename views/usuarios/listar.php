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
            <a class="dropdown-item" href="../productos/listar.php">Listar</a>
            <a class="dropdown-item" href="../productos/registrar.php">Registrar</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuarios</a>
          <div class="dropdown-menu" aria-labelledby="dropdownId">
            <a class="dropdown-item" href="./listar.php">Listar</a>
            <a class="dropdown-item" href="./registrar.php">Registrar</a>
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

    <table class="table table-sm table-striped" id="tabla-usuarios">
      <colgroup>
        <col width = "5%">
        <col width = "20%">
        <col width = "30%">
        <col width = "10%">
        <col width = "10%">
        <col width = "10%">
        <col width = "15%">
      </colgroup>
      <thead>
        <tr>
          <th>#</th>
          <th>Roles</th>
          <th>País</th>
          <th>Avatar</th>
          <th>Apellidos</th>
          <th>Nombres</th>
          <th>Comandos</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div> <!-- FIN DEL CONTAINER -->

  <!-- Modal trigger button
  <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modal-visor">
    Launch
  </button>
   -->
  <!-- Modal Body -->
  <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
  <div class="modal fade" id="modal-visor" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitleId">Avatar de Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img src="" style="width: 100%;" id="visor" alt="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  
  <!-- Optional: Place to the bottom of scripts -->
  <!-- <script>
    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
  
  </script> -->

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () =>{
      const modalVisor = new bootstrap.Modal(document.getElementById('modal-visor'));
      function $(id){
        return document.querySelector(id);
      }

      function listarUsuarios(){
        const parametros = new FormData();
        parametros.append("operacion","listar");

        fetch(`../../controllers/usuario.controller.php`, {
          method: "POST",
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datos =>{
            let numFila = 1;
            $("#tabla-usuarios tbody").innerHTML = '';
            datos.forEach(element => {
              let nuevaFila = ``;
              nuevaFila = `
              <tr>
                <td>${numFila}</td>
                <td>${element.rol}</td>
                <td>${element.nombrepais}</td>
                <td>
                  <a href='#' class='linkAvatar' data-url="${element.avatar}" data-nombres="${element.nombres} ${element.apellidos}">VER</a>

                </td>
                <td>${element.apellidos}</td>
                <td>${element.nombres}</td>
                <td>
                  <button data-idusuario="${element.idusuario}" class='btn btn-danger btn-sm eliminar' type='button'>Eliminar</button>
                  <button data-idusuario="${element.idusuario}" class='btn btn-info btn-sm editar' type='button'>Editar</button>
                </td>
              </tr>
              `;
              $("#tabla-usuarios tbody").innerHTML += nuevaFila;
              numFila++;
            });
          })
          .catch(e => {
            console.error(e)
          });
      }

      // TIEMPO DE EJECUCION PARA VER
      $("#tabla-usuarios tbody").addEventListener("click", (event) =>{
        // EVENTO PARA AVATAR
        if(event.target.classList.contains("linkAvatar")){
          const avatar = event.target.dataset.url;
          const nombres = event.target.dataset.nombres;
          $("#visor").setAttribute("src", `../../imagesuser/${avatar}`);
          $("#modalTitleId").innerHTML = nombres;
          modalVisor.toggle();
        }
        // EVENTO PARA ELIMINAR
        if(event.target.classList.contains("eliminar")){
          const idusuario = event.target.dataset.idusuario;
          const parametros = new FormData();
          parametros.append("operacion", "eliminar");
          parametros.append("idusuario", idusuario);

          if(confirm("¿Está seguro de eliminar?")){
            fetch(`../../controllers/usuario.controller.php`,{
              method: "POST",
              body: parametros
            })
              .then(respuesta => respuesta.text())
              .then(datos =>{
                console.log(datos)
                listarUsuarios();
              })
              .catch(e => {
                console.error(e)
              });
          }
        }
      });

      listarUsuarios();
    })
  </script>
</body>

</html>