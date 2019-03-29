<?php
namespace Core
{
    class Compra  
    {
        public $id_compra;
        public $nro;
        public $fecha;
        public $usuario;
        public $proveedor;
        public $total;

        /** @compra_detalles ArrayCompraDetalle $compra_detalles Arreglo de Objetos detalle de compra */
        public $compra_detalles;
    }
    
}
?>