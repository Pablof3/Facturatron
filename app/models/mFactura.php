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
        try{
            $this->db->beginTransaction();
            $nro_max = ObtenerNroMax();

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
                $this->db->bindParam(':tipo_emision',$factura->tipo_emision);
                $this->db->bindParam(':cod_fiscal',$factura->cod_fiscal);
                $this->db->bindParam(':tipo_sector',$factura->tipo_sector);
                $this->db->bindParam(':cod_autoverificador',$factura->cod_autoverificador);
                return $this->db->execute();
                $id_factura = $this->db->lastInsertId();

                $query = "INSERT INTO FacturaDetalle(factura, concepto, cantidad, precio_unitario) 
                  VALUES(:factura, :concepto, :cantidad, :precio_unitario)";
        $this->db->prepare($query);
        foreach ($factura->factura_detalles as $key => $factura_detalle) {
            $this->db->bindParam(":factura", $id_factura);
            $this->db->bindParam(":concepto", $factura_detalle->concepto);
            $this->db->bindParam(":cantidad", $factura_detalle->cantidad);
            $this->db->bindParam(":precio_unitario", $factura_detalle->precio_unitario);				
            $this->db->execute();
            }

            $this->db->commit();
        }
        catch(Exception $ex)
        {
            $this->db->rollback();
        }
    }


    public function Actualizar($factura)
    {
        $query="UPDATE Factura
                SET nit= :nit, razon= :razon, numero= :numero, autorizacion= :autorizacion, fecha= :fecha, monto= :monto, anulada= :anulada,
                sucursal= :sucursal, modalidad= :modalidad, tipo_emision= :tipo_emision, cod_fiscal= :cod_fiscal, tipo_sector= :tipo_sector,
                cod_autoverificador= :cod_autoverificador
                WHERE id_factura= :id_factura";
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
                $this->db->bindParam(':tipo_emision',$factura->tipo_emision);
                $this->db->bindParam(':cod_fiscal',$factura->cod_fiscal);
                $this->db->bindParam(':tipo_sector',$factura->tipo_sector);
                $this->db->bindParam(':cod_autoverificador',$factura->cod_autoverificador);
                $this->db->bindParam(':id_factura',$factura->id_factura);
                return $this->db->execute();
    }
    public function Eliminar($id)
    {
        $query="DELETE FROM Factura
                WHERE id_factura= :id_factura";
                $this->db->prepare($query);
                $this->db->bindParam(':id_factura',$id);
                $this->db->execute();
    }
}