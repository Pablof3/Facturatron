<?php require RUTA_APP .'/views/inc/Header.php';?>
<?php 
$clientes=$data['Clientes'];
?>
<div class="row">
    <div class="col-12">
        <h1>Dashboard</h1>
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb pt-0">
                <li class="breadcrumb-item">
                    <a href="#">Venta</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Registrar</li>
            </ol>
        </nav>
        <div class="separator mb-5"></div>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <form class="needs-validation" id="form_VentaRegistro" novalidate>
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="mb-3">Registro de Venta</h6>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Cliente</label>
                            <select name="Venta[cliente]" class="form-control select2-single">
                                <option value="" label="&nbsp;">&nbsp;</option>
                                <?php foreach ($clientes as $cliente):?>
                                <option value="<?= $cliente->id_cliente ?>"><?= $cliente->nombre ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="">Total</label>
                            <input type="number" step="0.01" class="form-control" placeholder="Total" maxlength="11"
                                id="ventaTotal" required>
                            <div class="invalid-feedback">
                                Campo Requerido
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Registrar</button>

                </div>
            </div>
            <div id='VentaDetalle_RegistroLista'>

            </div>
            <div class="form-row">
                <button type="button" onclick="agregarDetalle()" class="btn btn-secondary mb-1 mx-auto">Agragar
                    Detalle</button>
            </div>
        </form>
    </div>
</div>
</div>
<?php $libs=['0'=>'Venta'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>