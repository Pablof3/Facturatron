<?php require RUTA_APP .'/views/inc/Header.php';?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Dashboard</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Producto</a>
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
                    <h6 class="mb-3">Actualizar Producto</h6>
                    <form class="needs-validation" id="form_ProductoActualizar" novalidate>
                        <input type="hidden" name="Producto[id_producto]" value="<?= $data['producto']->id_producto; ?>" hidden>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="">Descripcion</label>
                                <input type="text" class="form-control"
                                    name="Producto[descripcion]"
                                    placeholder="Descripcion"
                                    value="<?= $data['Producto']->descripcion; ?>" maxlength="50" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Precio unitario</label>
                                <input type="number" step="0.01" class="form-control" name="Producto[precio_unitario]"
                                        placeholder="Precio unitario"
                                        value="<?= $data['Producto']->precio_unitario; ?>" 
                                        maxlength="11" pattern="[0-9]*" required> 
                                <div class="invalid-feedback">
                                    Permitido solo numeros
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Medida</label>
                                <input type="text" class="form-control"
                                        name="Producto[medida]"
                                        placeholder="Medida"
                                        value="<?= $data['Producto']->medida; ?>" 
                                        maxlength="10" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Categoria</label>
                                <input type="text" class="form-control" 
                                        name="Producto[categoria]" 
                                        placeholder="Categoria"
                                        value="<?= $data['Producto']->categoria; ?>" 
                                        maxlength="11" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Imagen</label>
                                <input type="text" class="form-control"
                                        name="Producto[imagen]"
                                        placeholder="Imagen"
                                        value="<?= $data['Producto']->imagen; ?>" 
                                        maxlength="100" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Stock minimo</label>
                                <input type="number" class="form-control" 
                                        name="Producto[stock_minimo]" 
                                        placeholder="Stock minimo"
                                        value="<?= $data['Producto']->stock_minimo; ?>" 
                                        maxlength="11" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Precio de compra</label>
                                <input type="number" step="0.01" class="form-control"
                                        name="Producto[precio_compra]"
                                        placeholder="Precio de compra"
                                        value="<?= $data['Producto']->precio_compra; ?>" 
                                        maxlength="11" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Actualizar</button>
                        <button class="btn btn-primary" type="reset">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $libs=['0'=>'Producto'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>