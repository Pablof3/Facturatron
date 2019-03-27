var url = "http://" + window.location.host + "/Facturatron/";
$(document).ready(function () {
  getListaCliente();
});

// Cliente Registrar
if (document.getElementById("form_ClienteRegistro")) {
  var form = document.getElementById("form_ClienteRegistro");
  form.addEventListener(
    "submit",
    function(event) {
      event.preventDefault();
      event.stopPropagation();
      if (form.checkValidity() === true) {
        $.ajax({
          type: "POST",
          url: url + "Cliente/Registrar",
          data: $("#form_ClienteRegistro").serialize(),
          dataType: "JSON",
          success: function(response) {
            if (response.status == true) {
              Swal.fire({
                title: "Correcto",
                text: "Cliente creado correctamente",
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

//Cliente Actualizar
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

// Eliminar Cliente
if (document.getElementById('form_ClienteEliminar')) {
  var form = document.getElementById("form_ClienteEliminar");
  form.addEventListener(
    "submit",
    function(event) {
      event.preventDefault();
      event.stopPropagation();
      if (form.checkValidity() === true) {
        $.ajax({
          type: "POST",
          url: url + "Cliente/Eliminar",
          data: $("#form_ClienteEliminar").serialize(),
          dataType: "JSON",
          success: function(response) {
            console.log(response);
            if (response.status == true) {
              Swal.fire({
                title: "Correcto",
                text: "Cliente Eliminado Exitosamente",
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
  getListaCliente();
}
function SetBusqueda(input) 
{  
  busqueda=input.value;
  getListaCliente();
}

function getListaCliente(pag=1) 
{  
  $.post(url+"Cliente/vTabla", {
    'Tabla':{
      'pagActual':pag,
      'limit':limit,
      'busqueda':busqueda
    } 
  },
    function (data, textStatus, jqXHR) {
      $('#ClienteLista').html(data);
    },
    "HTML"
  );

}