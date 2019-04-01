<?php
$productos=$data['Productos'];
$id=$data['id'];
?>
<div class="card d-flex flex-row mb-3">
    <div class="d-flex flex-grow-1 min-width-zero">
        <div
            class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
            <div class="w-30">
                <label>Producto</label>
                <select name="Compra[CompraDetalle][<?=$id?>][producto]" 
                        class="form-control select2-single" 
                        onchange="selectProducto_onchange(this)" 
                        data-id="<?= $id ?>" >
                    <option value="" label="&nbsp;">&nbsp;</option>
                    <?php foreach ($productos as $producto):?>
                        <option value="<?= $producto->id_producto ?>"><?= $producto->descripcion ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="w-20">
                <label for="">Precio</label>
                <input id="<?= 'inp'.$id ?>" 
                        type="number" step="0.01" 
                        class="form-control" 
                        name="Compra[CompraDetalle][<?=$id?>][precio]" 
                        placeholder="Precio" value=""
                        maxlength="11" required>
                <div class="invalid-feedback">
                    Campo Requerido
                </div>
            </div>
            <div class="w-20">
                <label for="">Cantidad</label>
                <input type="number" 
                        step="0.01" 
                        class="form-control" 
                        name="Compra[CompraDetalle][<?=$id?>][cantidad]" 
                        placeholder="Cantidad" 
                        value=""
                        maxlength="11" data-id="<?=$id?>" 
                        onkeyup="CalcularSubtotal(this)" required>
                <div class="invalid-feedback">
                    Campo Requerido
                </div>
            </div>
            <div class="w-20">
                <label for="validationCustom02">Subtotal</label>
                <input id="<?= 'inSub'.$id ?>" 
                        type="number" step="0.01" 
                        class="form-control" 
                        placeholder="Subtotal"
                        name="Compra[CompraDetalle][<?=$id?>][subtotal]"
                        value="" maxlength="11" required>
                <div class="invalid-feedback">
                    Campo Requerido
                </div>
            </div>
        </div>
    </div>
</div>