<!doctype html>
<html lang="es">

<head>
  <title>Especificar</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  
    <div class="container ">
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Características</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="lista-especificaciones">
                    <tbody>
                        <!--<tr>
                            <td class="text-nowrap"><strong>Característica 1:</strong></td>
                            <td>Valor 1</td>
                        </tr>
                        <tr>
                            <td class="text-nowrap"><strong>Característica 2:</strong></td>
                            <td>Valor 2</td>
                        </tr>
                        <tr>
                            <td class="text-nowrap"><strong>Característica 3:</strong></td>
                            <td>Valor 3</td>
                        </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>









  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script>
    function $(id){
      return document.querySelector(id);
    }

    function especificar(){
        
        const parametros = new FormData();
        parametros.append("operacion", "especificarProducto");

        fetch(`../../controllers/producto.controller.php`,{
            method: "POST",
            body: parametros
        })
        .then(respuesta => respuesta.json())
        .then(datos => {

            if (datos.length == 0){
            $("#lista-especificaciones").innerHTML = `<p>Pronto tendremos más novedades</p>`;  
          }else{
            $("#lista-especificaciones").innerHTML = ``;

            const nuevoItem = `
            
                <tr>
                    <td class="text-nowrap"><strong></strong>${element.clave}</td>
                    <td>${element.valor}1</td>
                </tr>
                
                
            
            `;
            $("#lista-especificaciones").innerHTML += nuevoItem;

          }
          
        })
        .catch(e =>{
            console.error(e)
        })

        especificar();

    }
  </script>
</body>

</html>