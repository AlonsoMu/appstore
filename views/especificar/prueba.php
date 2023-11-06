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

    <link rel="stylesheet" type="text/css" href="./styles.css">
  
</head>

<body>

    <?php
    $idterminator = $_GET['id']; //Encapsulndo el id en una variable (URL)
    if(empty($idterminator)):   //Comprobamos si existe un id en la URL y si no existe mandamos "NO"
    ?>

        <p>Consultar con webmaster</p>

    <?php else: ?>

        
        <script type="text/javascript">
            function $(id){
                return document.querySelector(id);
            }

            function especificar(){
                const parametros = new FormData();
                parametros.append("operacion", "especificarProducto");
                parametros.append("idproducto", '<?php echo $idterminator; ?>');
                //parametros.append("idproducto", $("#lista-especificaciones").value);
                //parametros.append("idproducto", '2');

                fetch(`../../controllers/producto.controller.php`,{
                    method: "POST",
                    body: parametros
                })
                .then(respuesta => respuesta.json())
                .then(datos => {
                    //const nuevoItem = $("#lista-especificaciones");
                    //nuevoItem.innerHTML = ""; // Limpia la tabla antes de agregar nuevos datos

                    if (datos.length === 0){
                        $("#lista-especificaciones").innerHTML = `<p>Pronto tendremos más novedades</p>`;
                    } else {
                    $("#lista-especificaciones").innerHTML = ``;
                    datos.forEach(element => {
                        const nuevoItem = `

                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                            <tbody>
                                <tr>
                                    <td class="text-nowrap"><strong>${element.clave}</strong></td>
                                    <td>${element.valor}</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        
                        `;
                        $("#lista-especificaciones").innerHTML += nuevoItem;

                    });
                    }
                })
                .catch(e => {
                    console.error(e)
                });
            }
            // Llama a la función especificar después de cargar la página
            especificar();

//________________________________________________________________________________________________________________________


            function galeria(){
                const parametrox = new FormData();
                parametrox.append("operacion", "especificarProducto");
                parametrox.append("idproducto", '<?php echo $idterminator; ?>');
                //parametros.append("idproducto", $("#lista-especificaciones").value);
                //parametros.append("idproducto", '2');

                fetch(`../../controllers/producto.controller.php`,{
                    method: "POST",
                    body: parametrox
                })
                .then(respuesta => respuesta.json())
                .then(datox => {

                    if (datox.length === 0){
                        $("#imageGallery").innerHTML = `<p>Aún no tenemos nada para mostrar</p>`;
                    } else {
                    $("#imageGallery").innerHTML = ``;
                    let autoin = 1;
                    datox.forEach(element => {

                        const rutafoto = (element.rutafoto == null) ? "noimagen.jpg" : element.rutafoto;

                        /*const sliderand = `
                        <div class="mySlides">
                            <img src="../../images/${element.fotografia}" style="width:100%; height:400px;">
                        </div>
                        `;*/

                        const slidert = `
                        <div class="mySlides">
                            <img src="../../images/${rutafoto}" style="width:100%; height:400px;">
                        </div>
                        `;

                        const miniatura = `
                        <div class="column">
                            <img class="demo cursor" src="../../images/${rutafoto}" style="width:100%" onclick="currentSlide(${autoin++})">
                        </div>
                        `;

                        //$("#imageGallery").innerHTML += slidert;
                        //$("#imageGallery").innerHTML += sliderand + slidert;
                        $("#imageGallery").innerHTML += slidert;
                        $("#imageGallery2").innerHTML += miniatura;

                        let slides = document.getElementsByClassName("mySlides");
                        slides[0].style.display = "block";

                    });
                    }
                })
                .catch(e => {
                    console.error(e)
                });
            }
            // Llama a la función especificar después de cargar la página
            galeria();

//________________________________________________________________________________________________________________________

            function name(){
                const parametroy = new FormData();
                parametroy.append("operacion", "especificarProducto");
                parametroy.append("idproducto", '<?php echo $idterminator; ?>');
                fetch(`../../controllers/producto.controller.php`,{
                    method: "POST",
                    body: parametroy
                })
                .then(respuesta => respuesta.json())
                .then(datoy => {

                    if (datoy.length === 0){
                        $("#nombre_producto").innerHTML = `<p>Pronto tendremos más novedades</p>`;
                    } else {
                    $("#nombre_producto").innerHTML = ``;
                    datoy.forEach(element => {
                        const nuevoItem = `
                                                
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                            <tbody>
                                <tr>
                                    <h1><strong>${element.descripcion}</strong></h1>
                                    <h2>S/${element.precio}</h2>
                                    <h6>Fecha de lanzamiento: ${element.create_at}</h6>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        
                        `;
                        $("#nombre_producto").innerHTML = nuevoItem;

                    });
                    }
                })
                .catch(e => {
                    console.error(e)
                });
            }
            // Llama a la función especificar después de cargar la página
            name();
        </script>

        

        



    <!-- BOB -->
    <div class="container mt-3">
        <div class="row">
            
            <!-- SLIDER -->
            <div class="col-7">
            <div class="container" style="padding:0; margin:0;">
                <div id="imageGallery">
                </div>
                <div class="row" id="imageGallery2">
                </div>

                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>
            </div>
            </div>

            <!-- DESCR -->
            <div class="col-5">
                <h5 class="card-title" >Nuevo | +20 vendidos</h5>
                <div class="table-responsive" id="nombre_producto">
                 
                </div>
            </div>

            <!-- ARGUMENTO -->
            <div class="col-4 mt-3">
                <h4 class="card-title" >Características</h4>
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-sm" id="lista-especificaciones">
                    </table>
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
        
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
        showSlides(slideIndex += n);
        }

        function currentSlide(n) {
        showSlides(slideIndex = n);
        }

        function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("demo");
        //let captionText = document.getElementById("caption");
        if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
                for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex-1].style.display = "block";
                dots[slideIndex-1].className += " active";
                
                //captionText.innerHTML = dots[slideIndex-1].alt;
        }

        /*function showSlides(n) {
             var slides = document.getElementsByClassName("mySlides");
             if (n > 3) {
                 slideIndex = 1
             }
             if (n < 1) {
                 slideIndex = 3
             }
             slides[0].style.display = "none";
             slides[1].style.display = "none";
             slides[2].style.display = "none";
             slides[slideIndex - 1].style.display = "block";
         }*/
    </script>





    <?php endif; ?>
  
    


</body>
</html>
