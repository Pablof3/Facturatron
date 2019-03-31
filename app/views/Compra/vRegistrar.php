<?php require RUTA_APP .'/views/inc/Header.php';?>
<?php
    /** @var Array $proveedores Arreglo de Proveedores */
    $proveedores=$data['Proveedores'];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Dashboard</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Compra</a>
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
                    <h6 class="mb-3">Registro Compra</h6>
                    <form class="needs-validation" id="" novalidate>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <label>State Single</label>
                                <select class="form-control select2-single">
                                    <option label="&nbsp;">&nbsp;</option>
                                    <?php foreach ($proveedores as $proveedor):?>
                                    <option value="<?= $proveedor->id_proveedor?>"><?= $proveedor->nombre ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Razon</label>
                                <input type="text" class="form-control" name="Cliente[razon]" placeholder="Razon"
                                    value="" maxlength="20" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Nit</label>
                                <input type="text" class="form-control" name="Cliente[nit]" placeholder="Nit" value=""
                                    maxlength="10" pattern="[0-9]*" required>
                                <div class="invalid-feedback">
                                    Requerido <br>
                                    Permitido solo numeros
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Nombre</label>
                                <input type="text" class="form-control" name="Cliente[nombre]" placeholder="Nombre"
                                    value="" maxlength="25" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Apellidos</label>
                                <input type="text" class="form-control" name="Cliente[apellidos]"
                                    placeholder="Apellidos" value="" maxlength="35" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $libs=['0'=>'Compra'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>