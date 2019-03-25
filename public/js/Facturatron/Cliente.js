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
                  showNotification('top', 'right', 'primary', 'Error', 'mensaje');

              }
          });  
        }
        form.classList.add("was-validated");
    },
    false
);
