var url = "http://" + window.location.host + "/Facturatron/";

//Venta registrar
if (document.getElementById("form_Factura_Registro")) {
  var form = document.getElementById("form_Factura_Registro");
  form.addEventListener(
    "submit",
    function(event) {
      event.preventDefault();
      event.stopPropagation();
      if (form.checkValidity() === true) {
        $.ajax({
          type: "POST",
          url: url + "Factura/Registrar",
          data: $("#form_Factura_Registro").serialize(),
          dataType: "JSON",
          success: function(response) {
            if (response.status == true) {
              Swal.fire({
                title: "Correcto",
                text: "Factura creada correctamente",
                type: "success",
                confirmButtonText: "Correcto"
              });

            } else {
              if (response.validate.status == false) {
                var msgError = "";
                errores = Object.keys(response.validate.error).map(
                  i => response.validate.error[i]
                );
                errores.forEach(function(element) {
                  msgError += element[0] + "\n";
                });
                Swal.fire({
                  title: "Error",
                  text: msgError,
                  type: "error",
                  confirmButtonText: "Cerrar"
                });
              }
              if (response.db.status == false) {
                Swal.fire({
                  title: "Error",
                  text: response.db.error,
                  type: "error",
                  confirmButtonText: "Cerrar"
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
}


$(document).on('keyup', '#numeroDocumento', function() {
  var nit  = $(this).val();

  $.ajax({
    type: "GET",
    url: url + "/Cliente/GetRazonSocial",
    data: {
      nit: nit
    },
    dataType: "JSON",
    success: function (response) {
      if(response.status) {
        $('#nombreRazonSocial').val(response.razonSocial);
      } else {
        $('#nombreRazonSocial').val('');
      }
    },
    error: function (err) {
      console.log(err);
    }
  });

});