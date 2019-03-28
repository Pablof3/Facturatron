<?php require RUTA_APP .'/views/inc/Header.php';?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Dashboard</h1>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Usuario</a>
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
                    <h6 class="mb-3">Detalle Usuario</h6>
                    <form class="needs-validation" id="form_UsuarioEliminar" novalidate>
                        <input type="hidden" name="Usuario[id_usuario]" value="<?= $data['Usuario']->id_usuario ?>">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="">Usuario</label>
                                <input type="text" class="form-control"
                                    name="Usuario[usuario]"
                                    placeholder="Usuario"
                                    value="<?= $data['Usuario']->usuario ?>" maxlength="25" disabled required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Contraseña</label>
                                <input type="text" class="form-control" name="Usuario[password]"
                                        placeholder="Contraseña"
                                        value="<?= $data['Usuario']->password ?>" 
                                        maxlength="50" 
                                        disabled
                                        required >
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="custom-control custom-checkbox mt-4">
                                    <input type="checkbox" class="custom-control-input" 
                                            id="checkAdmin" 
                                            name="Usuario[esAdmin]"
                                            disabled
                                            <?= ($data['Usuario']->esAdmin==1)?'checked':'' ?>>
                                    <label class="custom-control-label" for="checkAdmin">Permisos Administrador</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Nombre</label>
                                <input type="text" class="form-control"
                                        name="Usuario[nombre]"
                                        placeholder="Nombre"
                                        value="<?= $data['Usuario']->nombre ?>" maxlength="35"
                                        disabled
                                        required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Apellidos</label>
                                <input type="text" class="form-control" 
                                        name="Usuario[apellidos]" 
                                        placeholder="Apellidos"
                                        value="<?= $data['Usuario']->apellidos ?>"
                                        disabled
                                        maxlength="45" required>
                                <div class="invalid-feedback">
                                    Campo Requerido
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom02">Ci</label>
                                <input type="text" class="form-control" 
                                        name="Usuario[ci]" 
                                        placeholder="Ci"
                                        value="<?= $data['Usuario']->ci ?>" maxlength="15"
                                        pattern="[0-9]*"
                                        disabled
                                        required>
                                <div class="invalid-feedback">
                                    Campo Requerido<br>
                                    Solo Numeros
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="reset" onclick="document.location.href='<?= RUTA_URL ?>/Usuario/vLista';" >Atras</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $libs=['0'=>'Usuario'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>