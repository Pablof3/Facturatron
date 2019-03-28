<?php require RUTA_APP .'/views/inc/Header.php';?>
<?php $categorias = $data; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Dashboard</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Producto</a>
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
                    <h6 class="mb-3">Registro Producto</h6>
                    <form class="needs-validation" id="form_ProductoRegistro" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="producto_descripcion">Descripcion</label>
                                <input id="producto_descripcion" type="text" class="form-control"
                                    name="Producto[descripcion]"
                                    placeholder="Descripcion"
                                    value="" maxlength="50" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="producto_precio">Precio Unitario</label>
                                <input id="producto_precio" type="number" step="0.01" class="form-control" name="Producto[precio_unitario]"
                                        placeholder="Precio unitario"
                                        value="" 
                                        maxlength="11" 
                                        pattern="[0-9]*" required >
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="producto_medida">Medida</label>
                                <select id="producto_medida" class="form-control"
                                        name="Producto[medida]" required>
                                    <option value="Unidad">Unidad</option>
                                    <option value="Peso">Peso</option>
                                    <option value="Longitud">Longitud</option>
                                    <option value="Kg">Kg</option>
                                    <option value="Litro">Litro</option>
                                    <option value="Mtrs">Mtrs</option>
                                    <option value="Gr">Gr</option>
                                    <option value="Vaso">Vaso</option>
                                    <option value="Plato">Plato</option>
                                    <option value="Cubierto">Cubierto</option>
                                </select>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="producto_categoria">Categoria</label>
                                <select id="producto_categoria" name="Producto[categoria]" 
                                        class="form-control" required>
                                <?php foreach($categorias as $categoria): ?>
                                    <option value="<?=$categoria->id_categoria?>"><?=$categoria->nombre?></option>
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
                                name="Producto[precio_compra]" value="" 
                                        maxlength="11" 
                                        pattern="[0-9]*" required >
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="producto_stock">Stock Minimo</label>
                                <input id="producto_stock" type="number" class="form-control" 
                                placeholder="Stock minimo"
                                name="Producto[stock_minimo]"
                                        value="" 
                                        maxlength="11" 
                                        pattern="[0-9]*" required >
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="producto_imagen">Imagen</label>
                                <input id="producto_imagen" class="form-control" accept="image/*" onchange="preview_image(event)" type="file" name="imagen">
                            </div>
                            <div class="col-md-4 mb-3">
                                <img id="imagen_preview" class="app-image">
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $libs=['0'=>'Producto'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>