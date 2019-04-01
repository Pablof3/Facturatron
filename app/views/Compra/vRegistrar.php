<?php require RUTA_APP .'/views/inc/Header.php';?>
<?php 
    $proveedores = $data['Proveedores']; 
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
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form class="needs-validation" id="form_CompraRegistro" enctype="multipart/form-data" novalidate>
                <div class="card mb-4">
                    <div class="card-body">
                        <h6 class="mb-3">Registro de Compra Detalle</h6>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="">Proveedor</label>
                                <select id="" name="Compra[proveedor]" class="form-control select2-single"
                                    required>
                                    <?php foreach($proveedores as $proveedor): ?>
                                    <option value="<?=$proveedor->id_proveedor?>"><?=$proveedor->nombre?></option>
                                    <?php endforeach;?>
                                </select>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Total</label>
                                <input type="text" id="compraTotal" class="form-control" name="Compra[total]" placeholder="Total" value=""
                                    maxlength="35" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Registrar</button>
                    </div>
                </div>
                <div id="CompraDetalle_RegistroLista">

                </div>
                <div class="form-row">
                    <button type="button" onclick="agregarDetalle()" class="btn btn-secondary mb-1 mx-auto">Agragar
                        Detalle</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<?php $libs=['0'=>'Compra'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>