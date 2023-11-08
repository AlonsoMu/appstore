<!doctype html>
  <html lang="es">

  <head>
    <title>Recuperar Clave</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  </head>

  <body>
    <div class="container mt-3">
      <div class="row justify-content-center"> <!-- Centrar el contenido -->
        <div class="col-md-6"> <!-- Limitar el ancho del formulario -->
          <form class="w-100" action="" autocomplete="off">
            <div class="form-group text-center">
              <h1>Valide sus datos</h1>
              <hr>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <!-- CAMPO EMAIL -->
                  <div class="mb-3">
                    <label for="email" class="form-label">Email / Teléfono</label>
                    <input type="email" class="form-control" id="email" placeholder="Ingrese su Email / Teléfono" spellcheck="false" autofocus>
                  </div>      
                </div>  
                <div class="d-none" id="datos">
                  <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" readonly>
                  </div>
                  <div class="form-group">
                    <label for="email1">Correo Electrónico:</label>
                    <input type="text" class="form-control" id="email1" readonly>
                  </div>
                  <div class="form-group">
                    <label for="telefono1">Télefono:</label>
                    <input type="text" class="form-control" id="telefono1" readonly>
                  </div>
                </div>  
                <!-- Checkbox para notificaciones -->
                <div class="form-check" id="nadiemeve1">
                  <input type="checkbox" class="form-check-input" id="recibir-email" name="notificacion" value="email">
                  <label class="form-check-label" for="recibir-email">Recibir por Email</label>
                </div>
                <div class="form-check" id="nadiemeve2">
                  <input type="checkbox" class="form-check-input" id="recibir-sms" name="notificacion" value="sms">
                  <label class="form-check-label" for="recibir-sms">Recibir por SMS</label>
                </div>
              </div>
              <!-- <div class="card-footer text-end">
                <button class="btn btn-sm btn-primary" type="button" id="guardar" data-bs-toggle="modal" data-bs-target="#modalId">Enviar mensaje recuperación</button>
              </div> -->
              <div class="card-footer d-flex justify-content-end" style="flex-wrap: wrap; gap: 15px;">
                <button class="btn btn-secondary" type="button" id="reiniciar">Reiniciar</button>
                <button class="btn btn-primary" type="button" id="buscar">Buscar</button>
                <button class="btn btn-primary d-none" type="button" id="enviar">Enviar mensaje de recuperación</button>
              </div>
            </form> <!-- FIN DEL FORMULARIO-->
          </div> <!-- FIN DEL CARD -->
        </div> <!-- FIN DEL COL -->
      </div> <!-- FIN DEL ROW -->
    </div> <!-- FIN DEL CONTAINER -->
    
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary text-light">
            <h5 class="modal-title" id="modalTitleId">Validar clave generada</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="" autocomplete="off" id="formulario-validarclave">
              <div class="form-group">
                <label for="clavegenerada">Escriba la clave:</label>
                <input type="tel" style="font-size: 4em; font-weight: bold;" maxlength="6" class="form-control text-center" id="clavegenerada">
              </div>
              <div id="claves" class="d-none">
                <div class="form-group">
                  <label for="clave1">Escribe tu nueva contraseña:</label>
                  <input type="password" class="form-control" id="clave1">
                </div>
                <div class="form-group">
                  <label for="clave2">Vuelva a ingresar su contraseña:</label>
                  <input type="password" class="form-control" id="clave2">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="comprobar">Comprobar</button>
            <button type="button" class="btn btn-primary d-none" id="actualizar">Actualizar clave</button>
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

    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
      let noveo1 = document.getElementById('nadiemeve1');
      let noveo2 = document.getElementById('nadiemeve2');
      noveo1.classList.add('d-none');
      noveo2.classList.add('d-none');

      document.addEventListener("DOMContentLoaded", () => {

        const emailCheckbox = document.getElementById("recibir-email");
        const smsCheckbox = document.getElementById("recibir-sms");

        emailCheckbox.addEventListener('change', () => {
          if (emailCheckbox.checked) {
            smsCheckbox.disabled = true;
          } else {
            smsCheckbox.disabled = false;
          }
        });

        smsCheckbox.addEventListener('change', () => {
          if (smsCheckbox.checked) {
            emailCheckbox.disabled = true;
          } else {
            emailCheckbox.disabled = false;
          }
        });

      const txtNombreUsuario = document.getElementById('email');
      const btnReiniciar = document.getElementById('reiniciar');
      const btnBuscar = document.getElementById('buscar');
      const divDatosColaborador = document.getElementById('datos');
      const txtApellidos = document.getElementById('apellidos');
      const txtCorreoElectronico = document.getElementById('email1');
      const txttelefono = document.getElementById('telefono1');
      const btnEnviarClave = document.getElementById('enviar');
      const txtClaveCorreo = document.getElementById('clavegenerada');
      const btnComprobar = document.getElementById('comprobar');
      const divClaves = document.getElementById('claves');
      const txtClave1 = document.getElementById('clave1');
      const txtClave2 = document.getElementById('clave2');
      const btnActualizar = document.getElementById('actualizar');


        function $(id) {
          return document.querySelector(id);
        }
        

        // Variable para almacenar el idusuario
        let idusuario = -1;

        const modal = new bootstrap.Modal(document.getElementById('modalId'));

        
        function buscar() {
          const parametros = new FormData();
          parametros.append("operacion", "buscarUsuario");
          parametros.append("email", txtNombreUsuario.value);

          fetch(`./controllers/usuario.controller.php`, {
            method: "POST",
            body: parametros
          })
          .then(respuesta => respuesta.text())
          .then(datos => {
            if (datos != '') {
              divDatosColaborador.classList.remove('d-none');
              txtNombreUsuario.classList.remove('is-invalid');
              txtNombreUsuario.classList.add('is-valid');
              btnEnviarClave.classList.remove('d-none');
              btnReiniciar.classList.add('d-none');
              btnBuscar.classList.add('d-none');
              const registro = JSON.parse(datos);
              //Enviando datos a formulario
              idusuario = `${registro.idusuario}`;
              txtApellidos.value = `${registro.apellidos}`;
              txttelefono.value = registro.telefono;
              txtCorreoElectronico.value = registro.email;

              //---
              noveo1.classList.remove('d-none');
              noveo2.classList.remove('d-none');

            } else {
              if (txtNombreUsuario.value.trim() == '') {
                txtNombreUsuario.classList.remove('is-valid');
                txtNombreUsuario.classList.add('is-invalid');
                divDatosColaborador.classList.add('d-none');
                alert('Nombre de usuario no puede estar vacío ni contener espacios', 'error');
              } else {
                idusuario = -1;
                txtNombreUsuario.classList.add('is-invalid');
                divDatosColaborador.classList.add('d-none');
                txtApellidos.value = '';
                txtCorreoElectronico.value = '';
                alert('Nombre de usuario no encontrado', 'error');
              }
            }
          });
        }

        
        btnBuscar.addEventListener('click', buscar);
        // Llama a la función buscar cuando se haga clic en el botón
        // const enviarMensajeButton = document.getElementById("guardar");
        // enviarMensajeButton.addEventListener("click", buscar);


        function email(){
          const parametros = new FormData();
          parametros.append("operacion", "enviarCorreo");
          parametros.append("idusuario", idusuario);
          parametros.append("email", txtCorreoElectronico.value);

          if (emailCheckbox.checked) {
            // Si el checkbox de email está marcado, envía solo por email
            parametros.append("enviar_email", "1");
          }else if (smsCheckbox.checked)
          {
            parametros.append("enviar_sms", "1");
          } else {
            // Si no se ha marcado el checkbox de email, evita el envío por SMS
            alert('Seleccione al menos una opción de notificación', 'error');
            return;
          }

          fetch(`./controllers/usuario.controller.php`, {
            method:"POST",
            body: parametros
          })
          .then(respuesta => respuesta.text())
          .then(datos =>{
            console.log(datos)
            document.getElementById('formulario-validarclave').reset();
            alert('Verifica tu correo por favor', 'info');
            txtClaveCorreo.removeAttribute('readonly', '');
            divClaves.classList.add('d-none');
          })
          .catch(e => {
            console.error(e)
          });
        }










        function sms(){
          const parametros = new FormData();
          parametros.append("operacion", "sendSms");
          parametros.append("idusuario", idusuario);
          parametros.append("telefono", txttelefono.value);

          if (smsCheckbox.checked) {
            // Si el checkbox de email está marcado, envía solo por email
            parametros.append("enviar_sms", "1");
          }else if(emailCheckbox.checked){
            parametros.append("enviar_email", "1");
          } else {
            // Si no se ha marcado el checkbox de email, evita el envío por SMS
            alert('Seleccione al menos una opción de notificación', 'error');
            return;
          }

          fetch(`./controllers/usuario.controller.php`, {
            method:"POST",
            body: parametros
          })
          .then(respuesta => respuesta.text())
          .then(datos =>{
            console.log(datos)
            document.getElementById('formulario-validarclave').reset();
            alert('Verifica tu celular por favor', 'info');
            txtClaveCorreo.removeAttribute('readonly', '');
            divClaves.classList.add('d-none');
          })
          .catch(e => {
            console.error(e)
          });
        }


/*
        function sms(){
          const parametros = new FormData();
          parametros.append("operacion", "sendSms");
          parametros.append("idusuario", idusuario);
          parametros.append("telefono", txttelefono.value),


          fetch(`./controllers/usuario.controller.php`, {
            method:"POST",
            body: parametros
          })
          .then(respuesta => respuesta.text())
          .then(datos =>{
            console.log(datos)
            document.getElementById('formulario-validarclave').reset();
            alert('Verifica tu sms por favor', 'info');
            txtClaveCorreo.removeAttribute('readonly', '');
            divClaves.classList.add('d-none');
          })
          .catch(e => {
            console.error(e)
          });
        }
*/
















        function validarClave() {
        const parametros = new URLSearchParams();
        parametros.append('operacion', 'validar');
        parametros.append('idusuario', idusuario);
        parametros.append('clavegenerada', txtClaveCorreo.value);


        fetch(`./controllers/usuario.controller.php`, {
            method: 'POST',
            body: parametros

          })
          .then(res => res.json())
          .then(datos => {
            // console.log(datos);
            //Analizando los datos
            if (txtClaveCorreo.value.trim() == '') {
              alert('Campo obligatorio', 'info');
              txtClaveCorreo.focus();
            } else {
              if (datos.status == 'VALIDO') {
                txtClaveCorreo.setAttribute('readonly', '');
                divClaves.classList.remove('d-none');
                btnComprobar.classList.add('d-none');
                btnActualizar.classList.remove('d-none');
                txtClave1.focus();
              } else {
                alert('Clave incorrecta, revise su correo por favor', 'error');
                txtClaveCorreo.value = '';
                txtClaveCorreo.focus();
              }
            }
          });
      }

      function actualizarClave() {
        //Si ninguna caja esta vacia
        if (txtClave1.value.trim() == '') {
          alert('Las contraseña no puede estar vacía ni contener espacios', 'error');
          txtClave1.value = '';
          txtClave1.focus();
          // modal.togle();
        } else if (txtClave2.value.trim() == '') {
          alert('Las contraseña no puede estar vacía ni contener espacios', 'error');
          txtClave2.value = '';
          txtClave2.focus();
        } else {
          if (txtClave1.value != '' && txtClave2.value != '') {
            if (txtClave1.value == txtClave2.value) {
              const parametros = new URLSearchParams();
              parametros.append('operacion', 'actualizarClave');
              parametros.append('idusuario', idusuario);
              parametros.append('claveacceso', txtClave1.value);
              fetch(`./controllers/usuario.controller.php`, {
                  method: 'POST',
                  body: parametros
                })
                .then(res => res.json())
                .then(datos => {
                  console.log(datos);
                  alert('Se actualizó su clave. Vuelva a inicar sesión', 'success');

                  setTimeout(() => {
                    window.location.href = './';
                  }, 2500);
                });
              modal.toggle();
            } else {
              alert('Las contraseñas no coinciden', 'error');
              txtClave2.value = '';
              txtClave2.focus();
            }
          }
        }


      }


        //Evento click para botón
        btnReiniciar.addEventListener('click', () => {
          txtNombreUsuario.focus();
          txtNombreUsuario.classList.remove('is-invalid');
          txtNombreUsuario.classList.remove('is-valid');
        });

        btnEnviarClave.addEventListener('click', () => {
          if (idusuario !== -1) {
            if (emailCheckbox.checked) {
              email();
              modal.toggle();
            }else if (smsCheckbox.checked) {
              sms();
              modal.toggle();
              //console.log(smsCheckbox);
            } else {
              alert('Seleccione al menos una opción de notificación', 'error');
            }
          } else {
            alert('Ingrese nombre de usuario', 'error');
          }
        });

        btnComprobar.addEventListener('click', validarClave);

        btnActualizar.addEventListener('click', () => {
        actualizarClave();
      });
        // const enviarMensajeButton = document.getElementById("guardar");
        // enviarMensajeButton.addEventListener("click", email);
        //Evento ENTER teclado
        txtNombreUsuario.addEventListener('keypress', (key) => {
          if (key.keyCode == 13) buscar()
        });
      });

    </script>
  </body>
  </html>


