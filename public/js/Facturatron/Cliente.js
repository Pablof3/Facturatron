var url = "http://"+window.location.host+"/Facturatron/"
var form = document.getElementById("form_ClienteRegistro");
form.addEventListener(
    "submit",
    function(event) {
        event.preventDefault();
        event.stopPropagation();
        if(form.checkValidity() === true) {
          $.ajax({
              type: "POST",
              url: url+'Cliente/Registrar',
              data: $('#form_ClienteRegistro').serialize(),
              dataType: "JSON",
              success: function (response) {
                if(response.status == true) {
                  Swal.fire({
                      title: 'Correcto',
                      text: 'Cliente creado correctamente',
                      type: 'success',
                      confirmButtonText: 'Correcto'
                  });
              } else {
                  if(response.validate.status == false) {
                      var msgError = "";
                      errores = Object.keys(response.validate.error).map(i => response.validate.error[i])
                      errores.forEach(function(element) {
                          msgError += element[0] + "\n";
                      });
                      Swal.fire({
                          title: 'Error',
                          text: msgError,
                          type: 'error',
                          confirmButtonText: 'Cerrar'
                      });
                  }
                  if (response.db.status==false) {
                      Swal.fire({
                        title: 'Error',
                        text: response.db.error,
                        type: 'error',
                        confirmButtonText: 'Cerrar'
                      });
                  }
              }
              }
          });  
        }
        form.classList.add("was-validated");
    },
    false
);

// Cliente Actualizar
document.getElementById('form_ClienteActualizar').addEventListener(
  "submit",
  function(event) {
      event.preventDefault();
      event.stopPropagation();
      if(form.checkValidity() === true) {
        $.ajax({
            type: "POST",
            url: url+'Cliente/Actualizar',
            data: $('#form_ClienteActualizar').serialize(),
            dataType: "JSON",
            success: function (response) {
              if(response.status == true) {
                Swal.fire({
                    title: 'Correcto',
                    text: 'Cliente creado correctamente',
                    type: 'success',
                    confirmButtonText: 'Correcto'
                });
            } else {
                if(response.validate.status == false) {
                    var msgError = "";
                    errores = Object.keys(response.validate.error).map(i => response.validate.error[i])
                    errores.forEach(function(element) {
                        msgError += element[0] + "\n";
                    });
                    Swal.fire({
                        title: 'Error',
                        text: msgError,
                        type: 'error',
                        confirmButtonText: 'Cerrar'
                    });
                }
                if (response.db.status==false) {
                    Swal.fire({
                      title: 'Error',
                      text: response.db.error,
                      type: 'error',
                      confirmButtonText: 'Cerrar'
                    });
                }
            }
            }
        });  
      }
      form.classList.add("was-validated");
  },
  false
);

