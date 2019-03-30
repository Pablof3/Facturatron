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
                    <h6 class="mb-3">Detalle Compra</h6>
                    <form class="needs-validation" id="form_CompraEliminar" novalidate>
                    <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="compra_descripcion">Numero</label>
                                <input id="compra_descripcion" type="text" class="form-control"
                                    placeholder="Numero"
                                    value="<?=$data["Compra"]->numero?>" maxlength="11" disabled>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="compra_fecha">Fecha</label>
                                <input id="compra_fecha" type="text" class="form-control"
                                        placeholder="Fecha"
                                        value="<?=$data["Compra"]->fecha?>" 
                                         disabled>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="compra_usuario">Usuario</label>
                                <select id="compra_usuario" class="form-control"
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
                        <a class="btn btn-primary" href="<?= RUTA_URL;?>\Producto\vLista" >Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $libs=['0'=>'Producto'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>