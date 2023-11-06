<!doctype html>
<html lang="es">

<head>
  <title>Registro Usuario</title>
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
    <form action="" autocomplete="off" id="form-usuario">
      <div class="card">
        <div class="card-header">
          <div>Registro de Usuarios</div>
        </div>
        <div class="card-body">
          <!-- CAMPO ROL -->
          <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select name="" id="rol" class="form-select" required autofocus>
              <option value="">Seleccione:</option>
            </select>
          </div>
          <!-- CAMPO PAÍS -->
          <div class="mb-3">
            <label for="nombrepais" class="form-label">Nombre país</label>
            <select name="" id="nombrepais" class="form-select" required>
              <option value="">Seleccione:</option>
            </select>
          </div>
          <!-- CAMPO AVATAR -->
          <div class="mb-3">
            <label for="avatar" class="form-label">Avatar</label>
            <input type="file" class="form-control" id="avatar" accept=".jpg">
          </div>
          <!-- CAMPO APELLIDOS -->
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" required>
              </div>
            </div>
            <div class="col-md-6">
              <!-- NOMBRES -->
              <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombres" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
              </div>
            </div>
            <div class="col-md-6">
              <!-- CLAVE -->
              <div class="mb-3">
                <label for="claveacceso" class="form-label">Clave Acceso</label>
                <input type="password" class="form-control" id="claveacceso" required>
              </div>
            </div>
          </div>
        </div> <!-- FIN DEL CARD - BODY-->
        <div class="card-footer text-end">
          <button class="btn btn-sm btn-primary" type="submit" id="guardar">Guardar registro</button>
        </div>
      </div> <!-- FIN DEL CARD -->
    </form> <!-- FIN DEL FORMULARIO-->
  </div> <!-- FIN DEL CONTAINER -->
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      function $(id){
        return document.querySelector(id);
      }

      function getRol(){
        const parametros = new FormData();
        parametros.append("operacion", "listar");

        fetch(`../../controllers/rol.controller.php`, {
          method: "POST",
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datos => {
            // console.log(datos)
            datos.forEach(element => {
              const etiqueta = document.createElement("option");
              etiqueta.value = element.idrol;
              etiqueta.innerHTML = element.rol;

              $("#rol").appendChild(etiqueta);
            });
          })
          .catch(e => {
            console.error(e)
          });
      }

      function getNacionalidad(){
        const parametros = new FormData();
        parametros.append("operacion", "listar");

        fetch(`../../controllers/nacionalidad.controller.php`,{
          method: "POST",
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datos => {
            // console.log(datos)
            datos.forEach(element => {
              const etiqueta1 = document.createElement("option");
              etiqueta1.value = element.idnacionalidad;
              etiqueta1.innerHTML = element.nombrepais;

              $("#nombrepais").appendChild(etiqueta1);
            });
          })
          .catch(e =>{
            console.error(e)
          });
      }

      function userRegister(){
        const parametros = new FormData();
        parametros.append("operacion","registrar");
        parametros.append("idrol",$("#rol").value);
        parametros.append("idnacionalidad",$("#nombrepais").value);
        parametros.append("avatar", $("#avatar").files[0]);
        parametros.append("apellidos",$("#apellidos").value);
        parametros.append("nombres",$("#nombres").value);
        parametros.append("email",$("#email").value);
        parametros.append("claveacceso",$("#claveacceso").value);

        fetch(`../../controllers/usuario.controller.php`, {
          method: "POST",
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datos =>{
            if(datos.idusuario > 0){
              alert(`Usuario registrado con el ID: ${datos.idusuario}`)
              $("#form-usuario").reset();
            }
          })
          .catch(e => {
            console.error(e)
          });
      }

      // EVENTOS
      $("#form-usuario").addEventListener("submit", (event) => {
        event.preventDefault();

        if(confirm("¿Está seguro de registrar?")){
          userRegister();
        }
      });

      getNacionalidad();
      getRol();
    });
  </script>
</body>

</html>