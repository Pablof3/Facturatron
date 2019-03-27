var url = "http://"+window.location.host+"/Facturatron/"

if(document.getElementById("proveedor_registrar")) {
    var form = document.getElementById("proveedor_registrar");
    form.addEventListener(
        "submit",
        function(event) {
            event.preventDefault();
            event.stopPropagation();
            if(form.checkValidity() === true) {
                $.ajax({
                    type: "POST",
                    url: url + "Proveedor/Registrar",
                    data: $('#proveedor_registrar').serialize(),
                    dataType: "JSON",
                    cache: false,
                    success: function(response) {
                        if(response.status == true) {
                            Swal.fire({
                                title: 'Correcto',
                                text: 'Proveedor creado correctamente',
                                type: 'success',
                                confirmButtonText: 'Correcto',
                                onAfterClose: function() {
                                    window.location.href = url + 'Proveedor/vListar'
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

if(document.getElementById("proveedor_modificar")) {
    var form = document.getElementById("proveedor_modificar");
    form.addEventListener(
        "submit",
        function(event) {
            event.preventDefault();
            event.stopPropagation();
            if(form.checkValidity() === true) {
                $.ajax({
                    type: "POST",
                    url: url + "Proveedor/Modificar",
                    data: $('#proveedor_modificar').serialize(),
                    dataType: "JSON",
                    cache: false,
                    success: function(response) {
                        if(response.status == true) {
                            Swal.fire({
                                title: 'Correcto',
                                text: 'Proveedor modificado correctamente',
                                type: 'success',
                                confirmButtonText: 'Correcto',
                                onAfterClose: function() {
                                    window.location.href = url + 'Proveedor/vListar'
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

if(document.getElementById("proveedor_eliminar")) {
    var form = document.getElementById("proveedor_eliminar");
    form.addEventListener(
        "submit",
        function(event) {
            event.preventDefault();
            event.stopPropagation();
            if(form.checkValidity() === true) {
                $.ajax({
                    type: "POST",
                    url: url + "Proveedor/Eliminar",
                    data: $('#proveedor_eliminar').serialize(),
                    dataType: "JSON",
                    cache: false,
                    success: function(response) {
                        if(response.status == true) {
                            Swal.fire({
                                title: 'Correcto',
                                text: 'Proveedor eliminado correctamente',
                                type: 'success',
                                confirmButtonText: 'Correcto',
                                onAfterClose: function() {
                                    window.location.href = url + 'Proveedor/vListar'
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

