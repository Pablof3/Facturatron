<?php
namespace Core
{
    class Venta
    {
        public $id_venta;
        public $nro;
        public $fecha;
        public $usuario;
        public $factura;
        public $cliente;
        public $total;

        /** @venta_detalles ArrayCompraDetalle $venta_detalles Arreglo de Objetos detalle de compra */
        public $venta_detalles;
    }
}
