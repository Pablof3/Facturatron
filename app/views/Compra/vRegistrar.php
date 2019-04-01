<?php require RUTA_APP .'/views/inc/Header.php';?>
<?php $categorias = $data; ?>
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
                    <h6 class="mb-3">Registro de Compra</h6>
                    <form class="needs-validation" id="form_CompraRegistro" enctype="multipart/form-data" novalidate>
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
                            <div class="col-md-4 mb-3">
                                <label for="compra_fecha">Fecha</label>
                                <input id="compra_fecha" type="text" class="form-control datepicker"
                                    name="Compra[fecha]"
                                    placeholder="Fecha"
                                    value=""
                                    required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                            <label for="compra_usuario">Usuario</label>
                                <select id="compra_usuario" name="Compra[usuario]" 
                                        class="form-control" required>
                                <?php foreach($usuarios as $usuario): ?>
                                    <option value="<?=$usuario->id_usuario?>"><?=$usuario->nombre?></option>
                                <?php endforeach;?>
                                </select>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Nit</label>
                                <input type="text" class="form-control" name="Cliente[nit]" placeholder="Nit" value=""
                                    maxlength="10" pattern="[0-9]*" required>
                            <label for="compra_proveedor">Proveedor</label>
                                <select id="compra_proveedor" name="Compra[proveedor]" 
                                        class="form-control" required>
                                <?php foreach($proveedores as $proveedor): ?>
                                    <option value="<?=$proveedor->id_proveedor?>"><?=$proveedor->nombre?></option>
                                <?php endforeach;?>
                                </select>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                            <label for="compra_total">Total</label>
                                <input id="compra_total" type="number" step="0.01" class="form-control" placeholder="Total"
                                name="Compra[total]" value="" 
                                        maxlength="11" 
                                        pattern="[0-9]*" required >
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                    </li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="mb-3">Registro de Compra Detalle</h6>
                    <form class="needs-validation" id="form_CompraRegistro" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Nombre</label>
                                <input type="text" class="form-control" name="Cliente[nombre]" placeholder="Nombre"
                                    value="" maxlength="25" required>
                            <label for="compradetalle_producto">Producto</label>
                                <select id="compradetalle_producto" name="CompraDetalle[producto]" 
                                        class="form-control" required>
                                <?php foreach($productos as $producto): ?>
                                    <option value="<?=$producto->id_producto?>"><?=$producto->descripcion?></option>
                                <?php endforeach;?>
                                </select>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Apellidos</label>
                                <input type="text" class="form-control" name="Cliente[apellidos]"
                                    placeholder="Apellidos" value="" maxlength="35" required>
                            <label for="compradetalle_precio">Precio</label>
                                <input id="compradetalle_precio" type="number" step="0.01" class="form-control" placeholder="Precio"
                                name="CompraDetalle[precio]" value="" 
                                        maxlength="11" 
                                        pattern="[0-9]*" required >
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                            <label for="compradetalle_cantidad">Cantidad</label>
                                <input id="compradetalle_cantidad" type="number" class="form-control" placeholder="Cantidad"
                                name="CompraDetalle[cantidad]" value="" 
                                        maxlength="11" 
                                        pattern="[0-9]*" required >
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                            <label for="compradetalle_subtotal">Sub-Total</label>
                                <input id="compradetalle_subtotal" type="number" step="0.01" class="form-control" placeholder="Sub-Total"
                                name="Compra[subtotal]" value="" 
                                        maxlength="11" 
                                        pattern="[0-9]*" required >
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
</div>
<?php $libs=['0'=>'Compra'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>