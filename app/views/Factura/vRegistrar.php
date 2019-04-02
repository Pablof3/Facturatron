<?php require RUTA_APP .'/views/inc/Header.php';?>
<?php 
$venta=$data["Venta"];
?>
<div class="row">
    <div class="col-12">
        <h1>Dashboard</h1>
        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb pt-0">
                <li class="breadcrumb-item">
                    <a href="#">Factura</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Registrar</li>
            </ol>
        </nav>
        <div class="separator mb-5"></div>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <form class="needs-validation" id="form_Factura_Registro" novalidate>
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="mb-3">Registro de Factura</h6>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label>NIT</label>
                            <input type="text"
									value="" 
                                    class="form-control" 
                                    placeholder="NIT" 
                                    name="Factura[numeroDocumento]"
                                    id="numeroDocumento" required>
                        </div>
						<div class="col-md-3 mb-3">
                            <label>Nombre Razon</label>
                            <input type="text"
									value="" 
                                    class="form-control" 
                                    placeholder="Total" 
                                    name="Factura[nombreRazonSocial]"
                                    id="nombreRazonSocial" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Codigo Cliente</label>
                            <input type="text"
									value="" 
                                    class="form-control" 
                                    placeholder="Total" 
                                    name="Factura[codigoCliente]"
                                    id="codigoCliente" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="">Total</label>
                            <input type="text"
                                    value="<?=$venta->total?>" 
                                    class="form-control" 
                                    placeholder="Total" 
                                    name="Factura[montoTotal]"
                                    id="montoTotal" disabled>
                        </div>
                    </div>
					<div class="form-row">
						<table class="table table-striped table-inverse table-responsive">
							<thead class="thead-inverse">
								<tr>
									<th>Producto</th>
									<th>Precio</th>
									<th>Cantidad</th>
									<th>Subtotal</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($venta->venta_detalles as $venta_detalle): ?>
									<tr>
										<td><?=$this->NombreProducto($venta_detalle->producto)?></td>
										<td><?=$venta_detalle->precio?></td>
										<td><?=$venta_detalle->cantidad?></td>
										<td><?=$venta_detalle->subtotal?></td>
									</tr>
								</tbody>
								<?php endforeach; ?>
						</table>
					</div>
                    <button class="btn btn-primary" type="submit">Registrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<?php $libs=['0'=>'Factura'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>