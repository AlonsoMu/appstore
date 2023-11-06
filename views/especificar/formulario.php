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
  
  <div class="container mt-3">
    <form action="" autocomplete="off" id="form-producto">
      <div class="card">
        <div class="card-header">
          <div>Registrar Especificaciones</div>
        </div>
        <div class="card-body">
          <!-- CAMPO Producto -->
          <div class="mb-3">
            <label for="producto" class="form-label">Productos</label>
            <select name="" id="producto" class="form-select" required>
              <option value="">Seleccione</option>
            </select>
          </div>
          <div class="row">
            <!-- CAMPO CLAVE -->
            <div class="col-md-6 mb-3">
              <label for="clave" class="form-label">Clave:</label>
              <input type="text" class="form-control" id="clave" required>
            </div>
            <!-- CAMPO VALOR -->
            <div class="col-md-6 mb-3">
              <label for="valor" class="form-label">Valor:</label>
              <input type="text" class="form-control" id="valor" required>
            </div>
          </div> <!-- FIN DEL ROW -->
          <div class="mb-3">
            <label for="rutafoto" class="form-label">Fotografia</label>
            <input type="file" class="form-control" id="rutafoto" accept=".jpg">
          </div>
        </div>
        <div class="card-footer text-end">
          <button class="btn btn-sm btn-success" type="submit" id="guardar">Guardar</button>
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

      function getProducto(){
        // Creando datos que enviaremos al controlador
        const parametros = new FormData();
        parametros.append("operacion", "listar");

        
        fetch(`../../controllers/producto.controller.php`, {
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
            etiqueta.value = element.idproducto;
            etiqueta.innerText = element.descripcion;

            $("#producto").appendChild(etiqueta);
          });
          })
          .catch(e => {
            console.error(e)
          });
      }


      function formRegister(){
        const parametros = new FormData();
        parametros.append("operacion", "registrarEspecificacion");
        parametros.append("idproducto", $("#producto").value);
        parametros.append("clave", $("#clave").value);
        parametros.append("valor", $("#valor").value);
        parametros.append("rutafoto", $("#rutafoto").files[0]);


        fetch(`../../controllers/producto.controller.php`,{
          method: "POST",
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datos => {
            if(datos.idespecif > 0){
              alert(`Especificación registrado con ID: ${datos.idespecif}`)
              $("#form-producto").reset();
            }
          })
          .catch(e => {
            console.error(e)
          });
      }
      $("#form-producto").addEventListener("submit", (event) =>{
        event.preventDefault(); // Stop al evento
        
        if(confirm("¿Está seguro de guardar?")){
          formRegister();
        }
      });


      // Funciones de carga automática
      getProducto();
    });
  </script>
</body>  

</html>