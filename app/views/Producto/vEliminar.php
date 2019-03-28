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
                    <li class="breadcrumb-item active" aria-current="page">Eliminar</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="mb-3">Eliminar Producto ?</h6>
                    <form class="needs-validation" id="form_ProductoEliminar" novalidate>
                    <input type="hidden" id="producto_id" name="Producto[id_producto]" value="<?=$data["Producto"]->id_producto?>">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="producto_descripcion">Descripcion</label>
                                <input id="producto_descripcion" type="text" class="form-control"
                                    placeholder="Descripcion"
                                    value="<?=$data["Producto"]->descripcion?>" maxlength="50" disabled>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="producto_precio">Precio Unitario</label>
                                <input id="producto_precio" type="number" step="0.01" class="form-control"
                                        placeholder="Precio unitario"
                                        value="<?=$data["Producto"]->precio_unitario?>" 
                                        maxlength="11" 
                                        pattern="[0-9]*" disabled>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="producto_medida">Medida</label>
                                <select id="producto_medida" class="form-control"
                                     disabled>
                                    <option value="Unidad" <?= "Unidad" == $data["Producto"]->medida ? "selected" : ""?>>Unidad</option>
                                    <option value="Peso" <?= "Peso" == $data["Producto"]->medida ? "selected" : ""?>>Peso</option>
                                    <option value="Longitud" <?= "Longitud" == $data["Producto"]->medida ? "selected" : ""?>>Longitud</option>
                                    <option value="Kg" <?= "Kg" == $data["Producto"]->medida ? "selected" : ""?>>Kg</option>
                                    <option value="Litro" <?= "Litro" == $data["Producto"]->medida ? "selected" : ""?>>Litro</option>
                                    <option value="Mtrs" <?= "Mtrs" == $data["Producto"]->medida ? "selected" : ""?>>Mtrs</option>
                                    <option value="Gr" <?= "Gr" == $data["Producto"]->medida ? "selected" : ""?>>Gr</option>
                                    <option value="Vaso" <?= "Vaso" == $data["Producto"]->medida ? "selected" : ""?>>Vaso</option>
                                    <option value="Plato" <?= "Plato" == $data["Producto"]->medida ? "selected" : ""?>>Plato</option>
                                    <option value="Cubierto" <?= "Cubierto" == $data["Producto"]->medida ? "selected" : ""?>>Cubierto</option>
                                </select>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="producto_categoria">Categoria</label>
                                <select id="producto_categoria" 
                                        class="form-control" disabled>
                                <?php foreach($data["Categorias"] as $categoria): ?>
                                    <option value="<?=$categoria->id_categoria?>" <?= $categoria->id_categoria == $data["Producto"]->categoria ? "selected" : ""?>><?=$categoria->nombre?></option>
                                <?php endforeach;?>
                                </select>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="producto_compra">Precio de compra</label>
                                <input id="producto_compra" type="number" step="0.01" class="form-control" placeholder="Precio de compra"
                                 value="<?=$data["Producto"]->precio_compra?>" 
                                        maxlength="11" 
                                        pattern="[0-9]*" disabled >
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="producto_stock">Stock Minimo</label>
                                <input id="producto_stock" type="number" class="form-control" 
                                placeholder="Stock minimo"
                                        value="<?=$data["Producto"]->stock_minimo?>" 
                                        maxlength="11" 
                                        pattern="[0-9]*" disabled >
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <img id="imagen_preview" src="<?= !is_null($data["Producto"]->imagen) ? RUTA_URL."/".$data["Producto"]->imagen : "" ?>" class="app-image">
                            </div>
                        </div>
                        <button class="btn btn-danger" type="submit">Eliminar</button>
                        <button class="btn btn-primary" type="reset" onclick="document.location.href='<?= RUTA_URL ?>/Producto/vLista';">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $libs=['0'=>'Producto'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>