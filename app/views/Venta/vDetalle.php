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
                    <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="mb-3">Detalle de Venta</h6>
                    <form class="needs-validation" novalidate>
                        <input type="hidden" name="Cliente[id_cliente]" value="<?= $data['Venta']->id_venta; ?>"
                            hidden>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="">Numrero</label>
                                <input type="number" class="form-control"  placeholder="Numero"
                                    value="<?= $data['Venta']->nro ?>" maxlength="11" disabled required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Fecha</label>
                                <input type="text" class="form-control" placeholder="Fecha"
                                    value="<?= $data['Venta']->fecha; ?>" maxlength="10" pattern="[0-9]*" disabled required>
                                <div class="invalid-feedback">
                                    Campo requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Usuario</label>
                                <input type="text" class="form-control" placeholder="Usuario"
                                    value="<?= $data['Venta']->usuario; ?>" maxlength="11" disabled required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Cliente</label>
                                <input type="text" class="form-control"
                                    placeholder="Cliente" value="<?= $data['Venta']->cliente; ?>" maxlength="11"
                                    disabled required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Factura</label>
                                <input type="text" class="form-control" placeholder="Factura"
                                    value="<?= $data['Venta']->factura; ?>" maxlength="11" disabled required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Total</label>
                                <input type="text" class="form-control"
                                    placeholder="Venta" value="<?= $data['Venta']->total; ?>" maxlength="11"
                                    disabled required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-primary" href="<?= RUTA_URL;?>\Venta\vLista" >Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $libs=['0'=>'Cliente'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>