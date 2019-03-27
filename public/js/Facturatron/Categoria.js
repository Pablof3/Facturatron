var url = "http://"+window.location.host+"/Facturatron/"
$(document).ready(function () {
    getListaCategoria();
  });

if(document.getElementById("categoria_registrar")) {
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
                            Swal.fire({
                                title: 'Correcto',
                                text: 'Categoria creada correctamente',
                                type: 'success',
                                confirmButtonText: 'Correcto',
                                onAfterClose: function() {
                                    window.location.href = url + 'Categoria/vListar'
                                }
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
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: response.db.error,
                                    type: 'error',
                                    confirmButtonText: 'Cerrar'
                                });
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
}

if(document.getElementById("categoria_modificar")) {
    var form = document.getElementById("categoria_modificar");
    form.addEventListener(
        "submit",
        function(event) {
            event.preventDefault();
            event.stopPropagation();
            if(form.checkValidity() === true) {
                $.ajax({
                    type: "POST",
                    url: url + "Categoria/Modificar",
                    data: $('#categoria_modificar').serialize(),
                    dataType: "JSON",
                    cache: false,
                    success: function(response) {
                        if(response.status == true) {
                            Swal.fire({
                                title: 'Correcto',
                                text: 'Categoria modificada correctamente',
                                type: 'success',
                                confirmButtonText: 'Correcto',
                                onAfterClose: function() {
                                    window.location.href = url + 'Categoria/vListar'
                                }
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
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: response.db.error,
                                    type: 'error',
                                    confirmButtonText: 'Cerrar'
                                });
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
}

if(document.getElementById("categoria_eliminar")) {
    var form = document.getElementById("categoria_eliminar");
    form.addEventListener(
        "submit",
        function(event) {
            event.preventDefault();
            event.stopPropagation();
            if(form.checkValidity() === true) {
                $.ajax({
                    type: "POST",
                    url: url + "Categoria/Eliminar",
                    data: $('#categoria_eliminar').serialize(),
                    dataType: "JSON",
                    cache: false,
                    success: function(response) {
                        if(response.status == true) {
                            Swal.fire({
                                title: 'Correcto',
                                text: 'Categoria eliminada correctamente',
                                type: 'success',
                                confirmButtonText: 'Correcto',
                                onAfterClose: function() {
                                    window.location.href = url + 'Categoria/vListar'
                                }
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
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: response.db.error,
                                    type: 'error',
                                    confirmButtonText: 'Cerrar'
                                });
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
}


// Tabla
var limit=5;
var busqueda='';
function SetNumRegistros(num)
{
  $('#dropdownNumRegistros').html(num);
  limit=num;
  getListaCategoria();
}
function SetBusqueda(input) 
{  
  busqueda=input.value;
  getListaCategoria();
}

function getListaCategoria(pag=1) 
{  
  $.post(url+"Categoria/vTabla", {
    'Tabla':{
      'pagActual':pag,
      'limit':limit,
      'busqueda':busqueda
    } 
  },
    function (data, textStatus, jqXHR) {
      $('#CategoriaLista').html(data);
    },
    "HTML"
  );

}
