<?php require RUTA_APP .'/views/inc/Header.php';?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Nuevo Proveedor</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Proveedor</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Registrar</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="mb-3">Registrar Proveedor</h6>
                    <form id="proveedor_registrar" class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label for="nombre_proveedor">Nombre</label>
                                <input type="text" class="form-control" id="nombre_proveedor" name="Proveedor[nombre]" maxlength="40" placeholder="Nombre Proveedor"
                                    value="" required>
                                <div class="valid-feedback">
                                    Campo correcto!
                                </div>
                                <div class="invalid-feedback">
                                    El nombre de la proveedor es requerido.
                                </div>
                            </div>
							<div class="col-md-3 mb-3">
                                <label for="telefono_proveedor">Telefono</label>
                                <input type="text" class="form-control" id="telefono_proveedor" name="Proveedor[telefono]" maxlength="10" placeholder="Telefono Proveedor"
                                    value="" required>
                                <div class="valid-feedback">
                                    Campo correcto!
                                </div>
                                <div class="invalid-feedback">
                                    El telefono de proveedor es requerido.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="direccion_proveedor">Direccion</label>
                                <input type="text" class="form-control" id="direccion_proveedor" name="Proveedor[direccion]" maxlength="55" placeholder="Direccion Proveedor"
                                    value="" required>
                                <div class="valid-feedback">
                                    Campo correcto!
                                </div>
                                <div class="invalid-feedback">
                                    La direccion del proveedor es requerido.
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Registrar</button>
						<a href="<?=RUTA_URL?>/Proveedor/vListar" class="btn btn-danger">Volver Atras</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $libs = ['0' => "Proveedor"] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>