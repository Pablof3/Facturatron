var url = "http://" + window.location.host + "/Facturatron/";

//Venta registrar
if (document.getElementById("form_CompraRegistro")) {
  var form = document.getElementById("form_CompraRegistro");
  form.addEventListener(
    "submit",
    function(event) {
      event.preventDefault();
      event.stopPropagation();
      if (form.checkValidity() === true) {
        $.ajax({
          type: "POST",
          url: url + "Compra/Registrar",
          data: $("#form_CompraRegistro").serialize(),
          dataType: "JSON",
          success: function(response) {
            if (response.status == true) {
              Swal.fire({
                title: "Correcto",
                text: "Compra creada correctamente",
                type: "success",
                confirmButtonText: "Correcto"
              });
              setTimeout(function (){document.location.href=url+'Compra/vLista'},2000);
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
  getListaCompra();
}
function SetBusqueda(input) 
{  
  busqueda=input.value;
  getListaCompra();
}

function getListaCompra(pag=1) 
{  
  $.post(url+"Compra/vTabla", {
    'Tabla':{
      'pagActual':pag,
      'limit':limit,
      'busqueda':busqueda
    } 
  },
    function (data, textStatus, jqXHR) {
      $('#CompraLista').html(data);
    },
    "HTML"
  );

}
// Detalles Producto
$(document).ready(function () {
  agregarDetalle();
});
var id_detalleCompra=0;//Auto incrementar
function agregarDetalle () 
{  

  $.get(url+'Compra/vDetalleRegistro',{
    'id': id_detalleCompra
  },
    function (data, textStatus, jqXHR) {
      $('#CompraDetalle_RegistroLista').append(data);
      $(".select2-single, .select2-multiple").select2({
        theme: "bootstrap",
        placeholder: "",
        maximumSelectionSize: 6,
        containerCssClass: ":all:"
      });
    },
    "HTML"
  );
  id_detalleCompra+=1;
}

function selectProducto_onchange(element)
{
  var idProducto=$(element).val();
  var id_element=$(element).data('id');
  $.post(url+'Producto/getPrecioCompraProducto', {
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
  while (i<=id_detalleCompra) {
    var subt=$(`#inSub${i}`).val()
    if(subt!=0 && subt!=undefined)
    {
      suma+=parseFloat(subt);
    }
    i+=1;
  }
  $('#compraTotal').val(suma.toFixed(2));
}