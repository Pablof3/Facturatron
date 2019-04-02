<div class="col-12 list">
    <?php $indice=1;?>
    <?php foreach ($data['Ventas'] as $venta): ?>
        <div class="card d-flex flex-row mb-3">
            <div class="d-flex flex-grow-1 min-width-zero">
                <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                    <span class="list-item-heading mb-1 truncate w-10 w-xs-100">
                        <?= $indice; ?>
                    </span>
                    <a class="list-item-heading mb-1 truncate w-40 w-xs-100">
                        Nro: #<?= $venta->nro; ?>
                    </a>
                    <p class="mb-1 text-muted text-small w-15 w-xs-100">Cliente: <?= $venta->cliente; ?></p>
                    <p class="mb-1 text-muted text-small w-15 w-xs-100">Usuario: <?= $venta->usuario; ?></p>
                    <p class="mb-1 text-muted text-small w-15 w-xs-100">Fecha: <?= $venta->fecha; ?></p>
                    <a class="btn btn-primary m-1" href="<?= RUTA_URL?>/Venta/vDetalle/<?= $venta->id_venta ?>" >
                        <div class="glyph-icon simple-icon-eyeglass"></div>
                    </a>
                </div>
            </div>
        </div>
    <?php $indice+=1; ?>
    <?php endforeach; ?>

    <nav class="mt-4 mb-3">
        <ul class="pagination justify-content-center mb-0">
            <li class="page-item ">
                <a class="page-link first" onclick="getListaVenta()">
                    <i class="simple-icon-control-start"></i>
                </a>
            </li>
            <li class="page-item ">
                <a class="page-link prev" onclick="getListaVenta(<?= ($data['pagActual']!=1)?$data['pagActual']-1:$data['pagActual']; ?>)" >
                    <i class="simple-icon-arrow-left"></i>
                </a>
            </li>
            <?php
            $pagina=$data['pagActual'];
            $limPaginas=0;
            ?>
            <?php while ($pagina <= $data['numPaginas'] && $limPaginas<3): ?>
            <li class="page-item <?= ($pagina==$data['pagActual'])?'active':''; ?>">
                <a class="page-link" onclick="getListaVenta(<?= $pagina; ?>)"><?= $pagina; ?></a>
            </li>
            <?php
            $pagina+=1;
            $limPaginas+=1;
            ?>
            <?php endwhile;?>

            <li class="page-item ">
                <a class="page-link next" aria-label="Next" onclick="getListaVenta(<?=  ($data['pagActual']!=$data['numPaginas'])?$data['pagActual']+1:$data['pagActual']; ?>)">
                    <i class="simple-icon-arrow-right"></i>
                </a>
            </li>
            <li class="page-item ">
                <a class="page-link last" onclick="getListaVenta(<?= $data['numPaginas']?>)">
                    <i class="simple-icon-control-end"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>