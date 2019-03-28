var url = "http://" + window.location.host + "/Facturatron/";

// Cliente Registrar
if (document.getElementById("form_Login")) {
	var form = document.getElementById("form_Login");
	form.addEventListener(
	  "submit",
	  function(event) {
		event.preventDefault();
		event.stopPropagation();
		if (form.checkValidity() === true) {
		  $.ajax({
			type: "POST",
			url: url + "Login/IniciarSesion",
			data: $("#form_Login").serialize(),
			dataType: "JSON",
			success: function(response) {
			  if (response.status == true) {
				Swal.fire({
					title: "Correcto",
					text: "Sesion Iniciada correctamente",
					type: "success",
					confirmButtonText: "Correcto",
					onAfterClose: function() {
						window.location.href = url + 'Categoria/vListar'
					}
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
				} else {
					Swal.fire({
						title: "Error",
						text: "Error, Credenciales incorrectas",
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