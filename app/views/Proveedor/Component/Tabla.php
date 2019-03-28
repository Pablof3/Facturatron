<div class="col-12 list">
    <?php $indice=1;?>
    <?php if(isset($data["Proveedores"]) and count($data["Proveedores"]) > 0): ?>
	<?php foreach ($data["Proveedores"] as $proveedor): ?>
        <div class="card d-flex flex-row mb-3">
            <div class="d-flex flex-grow-1 min-width-zero">
                <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                    <span class="list-item-heading mb-1 truncate w-10 w-xs-100">
                        <?= $indice; ?>
                    </span>
                    <a class="list-item-heading mb-1 truncate w-40 w-xs-100">
						<?=$proveedor->nombre?>
                    </a>
                    <p class="mb-1 text-muted text-small w-15 w-xs-100"><?=$proveedor->telefono?></p>
                    <a class="btn btn-lg btn-info m-1" href="<?= RUTA_URL . "/Proveedor/Ver/" . $proveedor->id_proveedor ?>" >
                        <div class="glyph-icon fsize-15 simple-icon-eye"></div>
                    </a>
                    <a class="btn btn-lg btn-warning m-1" href="<?= RUTA_URL . "/Proveedor/vModificar/" . $proveedor->id_proveedor ?>">
                        <div class="glyph-icon fsize-15 simple-icon-note"></div>
                    </a>
                    <a class="btn btn-lg btn-danger m-1" href="<?= RUTA_URL . "/Proveedor/vEliminar/" . $proveedor->id_proveedor ?>">
                        <div class=" glyph-icon fsize-15 simple-icon-trash"></div>
                    </a>
                </div>
            </div>
        </div>
    <?php $indice+=1; ?>
    <?php endforeach; ?>

	<nav class="mt-4 mb-3">
		<span class="text-muted text-small"> <?= $data["cantRegistros"] ?></span>
        <ul class="pagination justify-content-center mb-0">
            <li class="page-item ">
                <a class="page-link first" onclick="getListaProveedor()">
                    <i class="simple-icon-control-start"></i>
                </a>
            </li>
            <li class="page-item ">
                <a class="page-link prev" onclick="getListaProveedor(<?= ($data['pagActual']!=1)?$data['pagActual']-1:$data['pagActual']; ?>)" >
                    <i class="simple-icon-arrow-left"></i>
                </a>
            </li>
            <?php
            $pagina=$data['pagActual'];
            $limPaginas=0;
            ?>
            <?php while ($pagina <= $data['numPaginas'] && $limPaginas<3): ?>
            <li class="page-item <?= ($pagina==$data['pagActual'])?'active':''; ?>">
                <a class="page-link" onclick="getListaProveedor(<?= $pagina; ?>)"><?= $pagina; ?></a>
            </li>
            <?php
            $pagina+=1;
            $limPaginas+=1;
            ?>
            <?php endwhile;?>

            <li class="page-item ">
                <a class="page-link next" aria-label="Next" onclick="getListaProveedor(<?=  ($data['pagActual']!=$data['numPaginas'])?$data['pagActual']+1:$data['pagActual']; ?>)">
                    <i class="simple-icon-arrow-right"></i>
                </a>
            </li>
            <li class="page-item ">
                <a class="page-link last" onclick="getListaProveedor(<?= $data['numPaginas']?>)">
                    <i class="simple-icon-control-end"></i>
                </a>
            </li>
        </ul>
    </nav>


	<?php else: ?>
		<div class="card d-flex flex-row mb-3">
            <div class="d-flex flex-grow-1 min-width-zero">
                <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                    <span class="list-item-heading mb-1">
                        No se encontraron resultados
                    </span>
                </div>
            </div>
        </div>
	<?php endif; ?>
    
</div>