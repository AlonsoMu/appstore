<!doctype html>
<html lang="es">

<head>
  <title>Catálogo de productos</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <div class="container mt-3">

        <!-- Filtro -->
        <div class="row mb-3">
        <div class="col-12">
            <label for="" class="form-label">Seleccione una categoría</label>
            <select name="categorias" id="categorias" class="form-select">
            <option value="-1">Mostrar todas</option>
            </select>
        </div>
        </div>

        <!-- Catálogo -->
        <div class ="row">
              <div class="col-md-2">
                <div>
                  <label for="">Precio</label>
                  <input type="text" id="precioFiltro" value="1000" >
                  <input type="range" min="1" max="5000" value="1000" id="precioRango">
                  <button class="btn btn-sm btn-primary" id="mostrarFiltro" type="button">Filtrar</button>
                </div>
              </div>
              <div class="col-md-10">
                <div class="row"  id="lista-productos"></div>
              </div>
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

    let dataObtenida = null;

    function getCategorias(){

      const parametros = new FormData();
      parametros.append("operacion", "listar");

      fetch(`../../controllers/categoria.controller.php`, {
        method: "POST",
        body: parametros
      })
        .then(respuesta => respuesta.json())
        .then(datos => {
          datos.forEach(element => {
            const tagOption = document.createElement("option");
            tagOption.innerText = element.categoria;
            tagOption.value = element.idcategoria;
            $("#categorias").appendChild(tagOption)
          });
        })
        .catch(e => {
          console.error(e);
        });
    }

    function actualizarCatalogo(){
      const parametros = new FormData();
      parametros.append("operacion", "filtrarCategoria");
      parametros.append("idcategoria", $("#categorias").value);

      fetch(`../../controllers/producto.controller.php`, {
        method: "POST",
        body: parametros
      })
        .then(respuesta => respuesta.json())
        .then(data => {
          dataObtenida = data;
          if (dataObtenida.length == 0){
            $("#lista-productos").innerHTML = `<p>Pronto tendremos más novedades</p>`;  
          }else{
            $("#lista-productos").innerHTML = ``;
            dataObtenida.forEach(element => {
              //Evaluar si tiene una fotografía
              const rutaImagen = (element.fotografia == null) ? "noimagen.jpg" : element.fotografia;
  
              //Renderizado
              const nuevoItem = `
              <div class="col-3 mb-3">
                <div class="card" style="width: 100%;" heigh="100%">
                <a href="../especificar/prueba.php?id=${element.idproducto}">
                  <img src="../../images/${rutaImagen}" class="card-img-top" alt="" width="100%" height="300px">
                </a>
                  <div class="card-body">
                    <h5 class="card-title">${element.descripcion}</h5>
                    <p class="card-text">S/ ${element.precio}</p>
                    <div class="d-grid">
                      <a href="#" data-idproducto="${element.idproducto}" class="btn btn-sm btn-primary">Comprar</a>
                    </div>
                  </div>
                </div>
              </div>
              `;
              $("#lista-productos").innerHTML += nuevoItem;
            });
          }

        })
        .catch(e => {
          console.error(e)
        });
    }

    $("#precioRango").addEventListener("change",() => {
      $("#precioFiltro").value = $("#precioRango").value;
    });

    $("#categorias").addEventListener("change", actualizarCatalogo);

    $("#mostrarFiltro").addEventListener("click",() => {

    console.log(dataObtenida);

    const precio = parseFloat($("#precioFiltro").value);
            //Render
    

    $("#lista-productos").innerHTML = "";
    
    dataObtenida.forEach(element => {

      const rutaImagen =(element.fotografia == null) ? "noImage.jfif" : element.fotografia;
      
      if(precio >= parseFloat(element.precio)){

      

      const precio = `
        <div class="col-3 mb-3">
          <div class="card" style="width: 100%;" heigh="100%">
          <a href="../especificar/prueba.php?id=${element.idproducto}">
            <img src="../../images/${rutaImagen}" class="card-img-top" alt="" width="100%" height="300px">
          </a>
            <div class="card-body">
              <h5 class="card-title">${element.descripcion}</h5>
              <p class="card-text">S/ ${element.precio}</p>
              <div class="d-grid">
                <a href="#" data-idproducto="${element.idproducto}" class="btn btn-sm btn-primary">Comprar</a>
              </div>
            </div>
          </div>
        </div>
      
      `;
        //AGREGAMOS EN href LA DIRECCION DE NUESTRO ARCHIVO DE DESTINO Y UNA OPERACION ID QUE ALMACENA EL ID DEL PRODUCTO
        //Y LO ENVIA AL ARCHIVO DE DESTINNO
        $("#lista-productos").innerHTML += precio;
    }
    });


    });

    getCategorias();
    actualizarCatalogo();

  </script>

</body>

</html>