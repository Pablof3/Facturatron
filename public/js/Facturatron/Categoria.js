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
                    if(response.error !== undefined) {
                        
                    } else if(response.status == "ok") {
                        alert('Todo OKEY');
                    } else {
                        alert(response.msgerror);
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