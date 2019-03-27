<?php require RUTA_APP .'/views/inc/Header.php';?>
<?php
?>
<div class="row">
    <div class="col-12">
        <div class="mb-2">
            <h1>Lista Clientes</h1>
            <div class="float-sm-right text-zero">
                <a class="btn btn-primary btn-lg text-white" href="<?= RUTA_URL.'/Cliente/vRegistrar' ?>">Nuevo Cliente</a>
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Cliente</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Lista</li>
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
                    <span class="text-muted text-small">Displaying 1-10 of 210 items </span>
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
<div class="row" id="ClienteLista">
  
</div>
<?php $libs=['0'=>'Cliente'] ?>
<?php require RUTA_APP .'/views/inc/Footer.php';?>