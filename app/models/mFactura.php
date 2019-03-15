<?php
class mFactura
{
    private $db;
    public function __construct() 
    {
        $this->db=new Database;
    }

    public function Insertar($factura)
    {
        $query="INSERT INTO Factura(nit, razon, numero, autorizacion, fecha, monto, anulada, sucursal, modalidad, tipo_emision, 
                cod_fiscal, tipo_sector, cod_autoverificador)
                VALUES(:nit, :razon, :numero, :autorizacion, :fecha, :monto, :anulada, :sucursal, :modalidad, :tipo_emision, 
                :cod_fiscal, :tipo_sector, :cod_autoverificador)";
                
    }
}