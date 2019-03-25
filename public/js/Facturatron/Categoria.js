var url = "http://"+window.location.host+"/Facturatron/"
var form = document.getElementById("categoria_registrar");
form.addEventListener(
    "submit",
    function(event) {
        event.preventDefault();
        event.stopPropagation();
        if(form.checkValidity() === true) {
            $.ajax({
                type: "POST",
                url: url + "Categoria/Registrar",
                data: $('#categoria_registrar').serialize(),
                dataType: "JSON",
                cache: false,
                success: function(response) {
                    if(response.status == true) {
                      showNotification('top', 'right', "success", "Correcto", "Categoria Registrada con exito");
                    } else {
                        if(response.validate.status == false) {
                            var msgError = "";
                            errores = Object.keys(response.validate.error).map(i => response.validate.error[i])
                            errores.forEach(function(element) {
                                msgError += element[0] + "<br>";
                            });
                            showNotification('top', 'right', 'danger', 'Error', msgError);
                        }
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
        form.classList.add("was-validated");
    },
    false
);