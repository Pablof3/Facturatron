<?php
namespace Core
{
    class Factura  
    {
        public $id_factura;
        public $nitEmisor;
        public $numeroFactura;
        public $cuf;
        public $cufd;
        public $codigoSucursal;
        public $direccion;
        public $codigoPuntoVenta;
        public $fechaEmision;
        public $nombreRazonSocial;
        public $codigoTipoDocumentoIdentidad;
        public $numeroDocumento;
        public $complemento;
        public $codigoCliente;
        public $codigoMetodoPago;
        public $numeroTarjeta;
        public $montoTotal;
        public $codigoMoneda;
        public $tipoCambio;
        public $montoTotalMoneda;
        public $leyenda;
        public $usuario;
        public $codigoDocumentoSector;
        public $anulada;
        
        public $factura_detalles;
    }
    
}
?>