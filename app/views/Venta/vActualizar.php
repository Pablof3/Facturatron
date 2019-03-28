<?php require RUTA_APP .'/views/inc/Header.php';?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Dashboard</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Venta</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Actualizar</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="mb-3">Actualizar Ventas</h6>
                    <form class="needs-validation" id="form_VentaActualizar" novalidate>
                        <input type="hidden" name="Venta[id_venta]" value="<?= $data['Venta']->id_venta; ?>"
                            hidden>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="">Numero</label>
                                <input type="number" class="form-control" name="Venta[nro]" placeholder="Numero"
                                    value="<?= $data['Venta']->nro; ?>" maxlength="11" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Fecha</label>
                                <input type="text" class="form-control datepicker" name="Venta[fecha]" placeholder="Fecha"
                                    value="<?= $data['Venta']->fecha; ?>" maxlength="10" pattern="[0-9]*" required>
                                <div class="invalid-feedback">
                                    Ingrese fecha
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Usuario</label>
                                <input type="text" class="form-control" name="Venta[usuario]" placeholder="Usuario"
                                    value="<?= $data['Venta']->usuario; ?>" maxlength="11" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Cliente</label>
                                <input type="text" class="form-control" name="Venta[cliente]"
                                    placeholder="Cliente" value="<?= $data['Venta']->cliente; ?>" maxlength="11"
                                    required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Factura</label>
                                <input type="text" class="form-control" name="Venta[factura]" placeholder="Factura"
                                    value="<?= $data['Venta']->factura; ?>" maxlength="11" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Total</label>
                                <input type="number" step="0.01" class="form-control" name="Venta[total]"
                                    placeholder="Total" value="<?= $data['Venta']->total; ?>" maxlength="11"
                                    required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Actualizar</button>
                        <button class="btn btn-primary" type="reset" onclick="document.location.href='<?= RUTA_URL ?>/Venta/vLista';" >Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $libs=['0'=>'Venta'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>