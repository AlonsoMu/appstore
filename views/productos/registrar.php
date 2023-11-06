<!doctype html>
<html lang="es">

<head>
  <title>Registro</title>
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
    <form action="" autocomplete="off" id="form-producto">
      <div class="card">
        <div class="card-header">
          <div>Registrar productos</div>
        </div>
        <div class="card-body">
          <!-- CAMPO CATEGORIA -->
          <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <select name="" id="categoria" class="form-select" required>
              <option value="">Seleccione:</option>
              <option value="1">Equipo de sonido</option>
            </select>
          </div>
          <!-- CAMPO DESCRIPCION -->
          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" required>
          </div>
          <div class="row">
            <!-- CAMPO PRECIO -->
            <div class="col-md-6 mb-3">
              <label for="precio" class="form-label">Precio</label>
              <input type="tel" class="form-control text-end" min="1" MAX="5000" id="precio" required>
            </div>
            <!-- CAMPO GARANTÍA -->
            <div class="col-md-6 mb-3">
              <label for="garantia" class="form-label">Garantía</label>
              <input type="number" class="form-control text-end" min="0" max="36" placeholder="Indicar en meses" id="garantia">
            </div>
          </div> <!-- FIN DEL ROW -->
          <!-- CAMPO FOTOGRAFÍA -->
          <div class="mb-3">
            <label for="fotografia" class="form-label">Fotografía</label>
            <input type="file" class="form-control" id="fotografia" accept=".jpg">
          </div>
        </div>
        <div class="card-footer text-end">
          <button class="btn btn-sm btn-primary" type="submit" id="guardar">Guardar</button>
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
  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      function $(id){
        return document.querySelector(id);
      }

      function getCategorias(){
        // Creando datos que enviaremos al controlador
        const parametros = new FormData();
        parametros.append("operacion", "listar");

        
        fetch(`../../controllers/categoria.controller.php`, {
          method: "POST",
          body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos =>{
          // Operaciones, proceso...
          // Conexión, el valor obtenido, el proceso, el error (render option en <select>)
          console.log(datos);
          datos.forEach(element => {
            const etiqueta = document.createElement("option");
            etiqueta.value = element.idcategoria;
            etiqueta.innerText = element.categoria;

            $("#categoria").appendChild(etiqueta);
          });
          })
          .catch(e => {
            console.error(e)
          });
      }


      function productRegister(){
        const parametros = new FormData();
        parametros.append("operacion", "registrar");
        parametros.append("idcategoria", $("#categoria").value);
        parametros.append("descripcion", $("#descripcion").value);
        parametros.append("precio", $("#precio").value);
        parametros.append("garantia", $("#garantia").value);
        parametros.append("fotografia", $("#fotografia").files[0]);

        fetch(`../../controllers/producto.controller.php`,{
          method: "POST",
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datos => {
            if(datos.idproducto > 0){
              alert(`Producto registrado con ID: ${datos.idproducto}`)
              $("#form-producto").reset();
            }
          })
          .catch(e => {
            console.error(e)
          });
      }

      // Detener el submit => es un evento del formulario
      // Clase      : Plantilla
      // Método     : Acción
      // Atributo   : Propiedad
      // Evento     : Es una respuesta
      $("#form-producto").addEventListener("submit", (event) =>{
        event.preventDefault(); // Stop al evento
        
        if(confirm("¿Está seguro de guardar?")){
          productRegister();
        }
      });


      // Funciones de carga automática
      getCategorias();
    });
  </script>
</body>  

</html>