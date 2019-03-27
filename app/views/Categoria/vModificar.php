<?php require RUTA_APP .'/views/inc/Header.php';?>
<?php $categoria = $data; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Modificar Categoria</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Categoria</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modificar</li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="mb-3">Modificar</h6>
                    <form id="categoria_modificar" class="needs-validation" novalidate>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="nombre_categoria">Nombre</label>
                                <input type="text" class="form-control" id="nombre_categoria" name="Categoria[nombre]" value="<?= $categoria->nombre ?>" maxlength="25" placeholder="Nombre Categoria"
                                    value="" required>
                                <div class="valid-feedback">
                                    Campo correcto!
                                </div>
                                <div class="invalid-feedback">
                                    El nombre de la categoria es requerido.
                                </div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label for="detalle_categoria">Detalle Categoria</label>
                                <input type="text" class="form-control" id="detalle_categoria" name="Categoria[detalle]" value="<?= $categoria->detalle ?>" placeholder="Detalle Categoria"
                                    value="" required>
                                <div class="valid-feedback">
                                    Campo correcto!
                                </div>
                                <div class="invalid-feedback">
                                    La descripcion de la categoria es requerido.
                                </div>
                            </div>
						</div>
						<input type="hidden" id="id_categoria" name="Categoria[id_categoria]" value="<?= $categoria->id_categoria ?>">
                        <button class="btn btn-warning" type="submit">Modificar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $libs = ['0' => "Categoria"] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>