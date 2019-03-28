<?php require RUTA_APP .'/views/inc/Header.php';?>
		<div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>Proveedor</h1>
                        <div class="float-sm-right text-zero">
                            <a href="<?= RUTA_URL . "/Proveedor/vRegistrar"?>" class="btn btn-primary btn-lg text-white">Nuevo Proveedor</a>
                        </div>
                        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                            <ol class="breadcrumb pt-0">
                                <li class="breadcrumb-item">
                                    <a href="#">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Proveedor</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Listar</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="mb-2">
                        <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                            role="button" aria-expanded="true" aria-controls="displayOptions">
                            Display Options
                            <i class="simple-icon-arrow-down align-middle"></i>
                        </a>
                        <div class="collapse d-md-block" id="displayOptions">
                            <div class="d-block d-md-inline-block">
                                <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                    <input placeholder="Search..." onkeyup="SetBusqueda(this)" >
                                </div>
                            </div>
                            <div class="float-md-right">
                                <span class="text-muted text-small">Cantidad de Registros: </span>
                                <button class="btn btn-outline-dark btn-xs dropdown-toggle" 
                                    type="button" data-toggle="dropdown"
                                    aria-haspopup="true" 
                                    aria-expanded="false"
                                    id="dropdownNumRegistros">
                                    5
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" onclick="SetNumRegistros(5)">5</a>
                                    <a class="dropdown-item" onclick="SetNumRegistros(10)">10</a>
                                    <a class="dropdown-item" onclick="SetNumRegistros(20)">20</a>
                                    <a class="dropdown-item" onclick="SetNumRegistros(30)">30</a>
                                    <a class="dropdown-item" onclick="SetNumRegistros(50)">50</a>
                                    <a class="dropdown-item" onclick="SetNumRegistros(100)">100</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator mb-5"></div>
                </div>
            </div>

            <div class="row" id="ProveedorLista">
                
            </div>
		</div>
<?php $libs = ['0' => "Proveedor"] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>