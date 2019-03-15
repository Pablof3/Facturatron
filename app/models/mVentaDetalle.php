<?php
class mVentaDetalle
{
    private $db;

    public function __construct() 
    {
        $this->db = new db;
    }

    public function Insertar($VentaDetalle)
    {
        $query="INSERT INTO VentaDetalle(venta, producto, cantidad, subtotal)
                VALUES(:venta, :producto, :cantidad, :subtotal)";
                $this->db->prepare($query);
                $this->db->bindParam(':venta', $VentaDetalle->venta);
                $this->db->bindParam(':producto', $VentaDetalle->producto);
                $this->db->bindParam(':cantidad', $VentaDetalle->cantidad);
                $this->db->bindParam(':subtotal', $VentaDetalle->subtotal);
                return $this->db->execute();
    }

    public function Actualizar($VentaDetalle)
    {
        $query="UPDATE VentaDetalle
                SET venta= :venta, producto= :producto, cantidad= :cantidad, subtotal= :subtotal
                WHERE id_ventadetalle= :id_ventadetalle";
                $this->db->prepare($query);
                $this->db->bindParam(':venta', $VentaDetalle->venta);
                $this->db->bindParam(':producto', $VentaDetalle->producto);
                $this->db->bindParam(':cantidad', $VentaDetalle->cantidad);
                $this->db->bindParam(':subtotal', $VentaDetalle->subtotal);
                $this->db->bindParam(':id_ventadetalle', $VentaDetalle->id_ventadetalle);
                return $this->db->execute();
    }

    public function Eliminar($id)
    {
        $query="DELETE FROM VentaDetalle
                WHERE id_ventadetalle= :id_ventadetalle";
                $this->db->prepare($query);
                $this->db->bindParam(':id_ventadetalle', $id);
                return $this->db->execute();
    }
}