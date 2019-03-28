var url = "http://" + window.location.host + "/Facturatron/";
$(document).ready(function () {
  getListaUsuario();
});

// Cliente Registrar
if (document.getElementById("form_UsuarioRegistro")) {
  var form = document.getElementById("form_UsuarioRegistro");
  form.addEventListener(
    "submit",
    function(event) {
      event.preventDefault();
      event.stopPropagation();
      if (form.checkValidity() === true) {
        $.ajax({
          type: "POST",
          url: url + "Usuario/Registrar",
          data: $("#form_UsuarioRegistro").serialize(),
          dataType: "JSON",
          success: function(response) {
            if (response.status == true) {
              Swal.fire({
                title: "Correcto",
                text: "Usuario creado correctamente",
                type: "success",
                confirmButtonText: "Correcto"
              });
              setTimeout(function (){document.location.href=url+'Usuario/vLista'},2000);
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
if (document.getElementById("form_UsuarioActualizar")) {
  var formActualizar = document.getElementById("form_UsuarioActualizar");
  formActualizar.addEventListener(
    "submit",
    function(event) {
      event.preventDefault();
      event.stopPropagation();
      if (formActualizar.checkValidity() === true) {
        $.ajax({
          type: "POST",
          url: url + "Usuario/Actualizar",
          data: $("#form_UsuarioActualizar").serialize(),
          dataType: "JSON",
          success: function(response) {
            console.log(response);
            if (response.status == true) {
              Swal.fire({
                title: "Correcto",
                text: "Usuario Actualizado correctamente",
                type: "success",
                confirmButtonText: "Correcto"
              });
              setTimeout(function (){document.location.href=url+'Usuario/vLista'},2000);
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
if (document.getElementById('form_UsuarioEliminar')) {
  var form = document.getElementById("form_UsuarioEliminar");
  form.addEventListener(
    "submit",
    function(event) {
      event.preventDefault();
      event.stopPropagation();
      if (form.checkValidity() === true) {
        $.ajax({
          type: "POST",
          url: url + "Usuario/Eliminar",
          data: $("#form_UsuarioEliminar").serialize(),
          dataType: "JSON",
          success: function(response) {
            console.log(response);
            if (response.status == true) {
              Swal.fire({
                title: "Correcto",
                text: "Usuario Eliminado Exitosamente",
                type: "success",
                confirmButtonText: "Correcto"
              });
              setTimeout(function (){document.location.href=url+'Usuario/vLista'},2000);
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
var limit=5;
var busqueda='';
function SetNumRegistros(num)
{
  $('#dropdownNumRegistros').html(num);
  limit=num;
  getListaUsuario();
}
function SetBusqueda(input) 
{  
  busqueda=input.value;
  getListaUsuario();
}

function getListaUsuario(pag=1) 
{  
  $.post(url+"Usuario/vTabla", {
    'Tabla':{
      'pagActual':pag,
      'limit':limit,
      'busqueda':busqueda
    } 
  },
    function (data, textStatus, jqXHR) {
      $('#UsuarioLista').html(data);
    },
    "HTML"
  );

}