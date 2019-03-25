<?php require RUTA_APP .'/views/inc/Header.php';?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Dashboard</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Cliente</a>
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
                    <h6 class="mb-3">Actualizar Cliente</h6>
                    <form class="needs-validation" id="form_ClienteRegistro" novalidate>
                        <input type="hidden" name="Cliente[id_cliente]" value="<?= $data['Cliente']->id_cliente; ?>" hidden>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="">Razon</label>
                                <input type="text" class="form-control"
                                    name="Cliente[razon]"
                                    placeholder="Razon"
                                    value="<?= $data['Cliente']->razon; ?>" maxlength="20" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Nit</label>
                                <input type="text" class="form-control" name="Cliente[nit]"
                                        placeholder="Nit"
                                        value="<?= $data['Cliente']->nit; ?>" 
                                        maxlength="10" pattern="[0-9]*" required> 
                                <div class="invalid-feedback">
                                    Permitido solo numeros
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Nombre</label>
                                <input type="text" class="form-control"
                                        name="Cliente[nombre]"
                                        placeholder="Nombre"
                                        value="<?= $data['Cliente']->nombre; ?>" 
                                        maxlength="25" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Apellidos</label>
                                <input type="text" class="form-control" 
                                        name="Cliente[apellidos]" 
                                        placeholder="Apellidos"
                                        value="<?= $data['Cliente']->apellidos; ?>" 
                                        maxlength="35" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $libs=['0'=>'Cliente'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>