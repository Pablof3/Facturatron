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
                $this->db->prepare($query);
                $this->db->bindParam(':nit',$factura->nit);
                $this->db->bindParam(':razon',$factura->razon);
                $this->db->bindParam(':numero',$factura->numero);
                $this->db->bindParam(':autorizacion',$factura->autorizacion);
                $this->db->bindParam(':fecha',$factura->fecha);
                $this->db->bindParam(':monto',$factura->monto);
                $this->db->bindParam(':anulada',$factura->anulada);
                $this->db->bindParam(':sucursal',$factura->sucursal);
                $this->db->bindParam(':modalidad',$factura->modalidad);
                $this->db->bindParam(':tipo:emision',$factura->tipo_emision);
                $this->db->bindParam(':cod_fiscal',$factura->cod_fiscal);
                $this->db->bindParam(':tipo_sector',$factura->tipo_sector);
                $this->db->bindParam(':cod_autoverificador',$factura->cod_autoverificador);
                return $this->db->execute();
    }
}