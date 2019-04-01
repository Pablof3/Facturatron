var url = "http://" + window.location.host + "/Facturatron/";
$(document).ready(function () {
  agregarDetalle();
  getListaVenta();
});

//Venta registrar
if (document.getElementById("form_VentaRegistro")) {
    var form = document.getElementById("form_VentaRegistro");
    form.addEventListener(
      "submit",
      function(event) {
        event.preventDefault();
        event.stopPropagation();
        if (form.checkValidity() === true) {
          $.ajax({
            type: "POST",
            url: url + "Venta/Registrar",
            data: $("#form_VentaRegistro").serialize(),
            dataType: "JSON",
            success: function(response) {
              if (response.status == true) {
                Swal.fire({
                  title: "Correcto",
                  text: "Venta creada correctamente",
                  type: "success",
                  confirmButtonText: "Correcto"
                });

                setTimeout(function (){document.location.href=url+'Factura/vRegistrar'},2000);
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

  //Venta Actualizar
if (document.getElementById("form_VentaActualizar")) {
    var formActualizar = document.getElementById("form_VentaActualizar");
    formActualizar.addEventListener(
      "submit",
      function(event) {
        event.preventDefault();
        event.stopPropagation();
        if (formActualizar.checkValidity() === true) {
          $.ajax({
            type: "POST",
            url: url + "Venta/Actualizar",
            data: $("#form_VentaActualizar").serialize(),
            dataType: "JSON",
            success: function(response) {
              console.log(response);
              if (response.status == true) {
                Swal.fire({
                  title: "Correcto",
                  text: "Venta Actualizada correctamente",
                  type: "success",
                  confirmButtonText: "Correcto"
                });
                setTimeout(function (){document.location.href=url+'Venta/vLista'},2000);
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


// Eliminar Venta
if (document.getElementById('form_VentaEliminar')) {
    var form = document.getElementById("form_VentaEliminar");
    form.addEventListener(
      "submit",
      function(event) {
        event.preventDefault();
        event.stopPropagation();
        if (form.checkValidity() === true) {
          $.ajax({
            type: "POST",
            url: url + "Venta/Eliminar",
            data: $("#form_VentaEliminar").serialize(),
            dataType: "JSON",
            success: function(response) {
              console.log(response);
              if (response.status == true) {
                Swal.fire({
                  title: "Correcto",
                  text: "Venta Eliminada Exitosamente",
                  type: "success",
                  confirmButtonText: "Correcto"
                });
                setTimeout(function (){document.location.href=url+'Venta/vLista'},2000);
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
  getListaVenta();
}
function SetBusqueda(input) 
{  
  busqueda=input.value;
  getListaVenta();
}

function getListaVenta(pag=1) 
{  
  $.post(url+"Venta/vTabla", {
    'Tabla':{
      'pagActual':pag,
      'limit':limit,
      'busqueda':busqueda
    } 
  },
    function (data, textStatus, jqXHR) {
      $('#VentaLista').html(data);
    },
    "HTML"
  );

}
// Detalles Producto
var id_detalleVenta=0;//Auto incrementar
function agregarDetalle () 
{  

  $.get(url+'Venta/vDetalleRegistro',{
    'id': id_detalleVenta
  },
    function (data, textStatus, jqXHR) {
      $('#VentaDetalle_RegistroLista').append(data);
      $(".select2-single, .select2-multiple").select2({
        theme: "bootstrap",
        placeholder: "",
        maximumSelectionSize: 6,
        containerCssClass: ":all:"
      });
    },
    "HTML"
  );
  id_detalleVenta+=1;
}

function selectProducto_onchange(element)
{
  var idProducto=$(element).val();
  var id_element=$(element).data('id');
  $.post(url+'Producto/getPrecioProducto', {
    'id_producto':idProducto
  },
    function (data, textStatus, jqXHR) {
      $(`#inp${id_element}`).val(data);
    },
    "JSON"
  );
}

function CalcularSubtotal(element)
{
  var cantidad=$(element).val();
  var id_element=$(element).data('id');
  var precio=$(`#inp${id_element}`).val();
  $(`#inSub${id_element}`).val((cantidad* precio).toFixed(2));
  SumarVenta();
}

function SumarVenta()
{ 
  var i =0;
  var suma=0;
  while (i<=id_detalleVenta) {
    var subt=$(`#inSub${i}`).val()
    if(subt!=0 && subt!=undefined)
    {
      suma+=parseFloat(subt);
    }
    i+=1;
  }
  $('#ventaTotal').val(suma.toFixed(2));
}