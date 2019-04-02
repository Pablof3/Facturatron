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
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="compra_descripcion">Numero</label>
                                <input id="compra_descripcion" type="text" class="form-control"
                                    value="<?=$data["Venta"]->nro?>" disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="compra_fecha">Fecha</label>
                                <input id="compra_fecha" type="text" class="form-control"
                                        value="<?=$data["Venta"]->fecha?>" 
                                         disabled>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="compra_fecha">Usuario</label>
                                <input id="compra_fecha" type="text" class="form-control"
                                        value="<?=$data["Venta"]->usuario?>" 
                                         disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="compra_fecha">Cliente</label>
                                <input id="compra_fecha" type="text" class="form-control"
                                        value="<?=$data["Venta"]->cliente?>" 
                                         disabled>
                            </div>
                            <div class="col-md-8 mb-3">
                                <table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Precio Compra</th>
                                            <th>Cantidad</th>
                                            <th>SubTotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($data["Venta"]->venta_detalles as $venta_detalle): ?>
                                        <tr>
                                            <td><?=$venta_detalle->nombre_producto?></td>
                                            <td><?=$venta_detalle->precio?></td>
                                            <td><?=$venta_detalle->cantidad?></td>
                                            <td><?=$venta_detalle->subtotal?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                        <tr style="font-weight: bold">
                                            <td colspan="3">TOTAL</td>
                                            <td colspan="1"><?=$data["Venta"]->total?></td>
                                        </tr>
                                    </tbody>
                                </table>
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