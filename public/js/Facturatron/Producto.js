var url = "http://" + window.location.host + "/Facturatron/";
$(document).ready(function () {
  getListaProducto();
});
if (document.getElementById("form_ProductoRegistro")) {
    var form = document.getElementById("form_ProductoRegistro");
    form.addEventListener(
    "submit",
    function(event) {
        event.preventDefault();
        event.stopPropagation();
        if(form.checkValidity() === true) {
          $.ajax({
              type: "POST",
              url: url+'Producto/Registrar',
              data: $('#form_ProductoRegistro').serialize(),
              contentType: false,
              processData: false,
              dataType: "JSON",
              success: function (response) {
                  console.log(response)
                if(response.status == true) {
                  Swal.fire({
                      title: 'Correcto',
                      text: 'Producto creado correctamente',
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
}

// Producto Actualizar
if (document.getElementById("form_ProductoActualizar")) {
    var form = document.getElementById("form_ProductoActualizar");
    form.addEventListener(
    "submit",
    function(event) {
        event.preventDefault();
        event.stopPropagation();
        if(form.checkValidity() === true) {
          $.ajax({
              type: "POST",
              url: url+'Producto/Actualizar',
              data: $('#form_ProductoActualizar').serialize(),
              dataType: "JSON",
              success: function (response) {
                if(response.status == true) {
                  Swal.fire({
                      title: 'Correcto',
                      text: 'Producto creado correctamente',
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
}

//Producto Actualizar
if (document.getElementById("form_ClienteActualizar")) {
    var formActualizar = document.getElementById("form_ClienteActualizar");
    formActualizar.addEventListener(
      "submit",
      function(event) {
        event.preventDefault();
        event.stopPropagation();
        if (formActualizar.checkValidity() === true) {
          $.ajax({
            type: "POST",
            url: url + "Cliente/Actualizar",
            data: $("#form_ClienteActualizar").serialize(),
            dataType: "JSON",
            success: function(response) {
              console.log(response);
              if (response.status == true) {
                Swal.fire({
                  title: "Correcto",
                  text: "Cliente Actualizado correctamente",
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
        formActualizar.classList.add("was-validated");
      },
      false
    );
  }
  
  // Eliminar Producto
  if (document.getElementById('form_ProductoEliminar')) {
    var form = document.getElementById("form_ProductoEliminar");
    form.addEventListener(
      "submit",
      function(event) {
        event.preventDefault();
        event.stopPropagation();
        if (form.checkValidity() === true) {
          $.ajax({
            type: "POST",
            url: url + "Producto/Eliminar",
            data: $("#form_ProductoEliminar").serialize(),
            dataType: "JSON",
            success: function(response) {
              console.log(response);
              if (response.status == true) {
                Swal.fire({
                  title: "Correcto",
                  text: "Producto Eliminado Exitosamente",
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

// Tabla
var limit=10;
var busqueda='';
function SetNumRegistros(num)
{
  $('#dropdownNumRegistros').html(num);
  limit=num;
  getListaProducto();
}
function SetBusqueda(input) 
{  
  busqueda=input.value;
  getListaProducto();
}

function getListaProducto(pag=1) 
{  
  $.post(url+"Producto/vTabla", {
    'Tabla':{
      'pagActual':pag,
      'limit':limit,
      'busqueda':busqueda
    } 
  },
    function (data, textStatus, jqXHR) {
      $('#ProductoLista').html(data);
    },
    "HTML"
  );

}


//Previsualizar Imagen a subir
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('imagen_preview');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}