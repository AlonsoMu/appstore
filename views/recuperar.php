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
        <form action="" autocomplete="off" id="form-recuperar">
          <div class="card">
            <div class="card-header">
              <div>Recuperar Contraseña</div>
            </div>
            <div class="card-body">
              <!-- CAMPO EMAIL -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Ingrese su correo electrónico">
              </div>
              <!-- Checkbox para notificaciones -->
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="recibir-email" name="notificacion" value="email">
                <label class="form-check-label" for="recibir-email">Recibir por Email</label>
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="recibir-sms" name="notificacion" value="sms">
                <label class="form-check-label" for="recibir-sms">Recibir por SMS</label>
              </div>
            </div>
            <div class="card-footer text-end">
              <button class="btn btn-sm btn-primary" type="button" id="guardar" data-bs-toggle="modal" data-bs-target="#modalId">Enviar mensaje recuperación</button>
            </div>
          </div> <!-- FIN DEL CARD -->
        </form> <!-- FIN DEL FORMULARIO-->
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
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      function $(id){
        return document.querySelector(id);
      }
      const emailCheckbox = document.getElementById("recibir-email");
      const smsCheckbox = document.getElementById("recibir-sms");
  
      emailCheckbox.addEventListener("change", function () {
        smsCheckbox.checked = false;
        smsCheckbox.disabled = this.checked;
      });
  
      smsCheckbox.addEventListener("change", function () {
        emailCheckbox.checked = false;
        emailCheckbox.disabled = this.checked;
      });

      function enviarEmail() {
        const parametros = new FormData();
        parametros.append("operacion", "sendEmail");
        parametros.append("emailDestino", $("#email").value);

        fetch("../controllers/usuario.controller.php", {
          method: "POST",
          body: parametros,
        })
          .then((respuesta) => respuesta.json())
          .then((datos) => {
            if (datos.enviado) {
              alert("Código enviado correctamente. Verifique su correo electrónico.");
              $("#form-recuperar").reset();
            } else {
              alert("Error al enviar el código. Inténtelo nuevamente.");
            }
          })
          .catch((e) => {
            console.error(e);
            alert("Error en la solicitud. Inténtelo nuevamente.");
          });
      }

      function enviarSms() {
        const parametros = new FormData();
        parametros.append("operacion", "sendSMS");
        parametros.append("telefono", $("#email").value);

        fetch("../controllers/usuario.controller.php", {
          method: "POST",
          body: parametros,
        })
          .then(() => {
            alert("Código SMS enviado correctamente. Verifique su mensaje de texto.");
            $("#form-recuperar").reset();
          })
          .catch((e) => {
            console.error(e);
            alert("Error al enviar el código SMS. Inténtelo nuevamente.");
          });
      }

      // EVENTOS
      $("#guardar").addEventListener("click", () => {
        const emailCheckbox = document.getElementById("recibir-email");
        const smsCheckbox = document.getElementById("recibir-sms");

        if (emailCheckbox.checked) {
          enviarEmail();
        } else if (smsCheckbox.checked) {
          enviarSms();
        } else {
          alert("Por favor, seleccione 'Recibir por Email' o 'Recibir por SMS' para enviar el código.");
        }
      });
      
    });

    






  </script>
</body>
</html>


