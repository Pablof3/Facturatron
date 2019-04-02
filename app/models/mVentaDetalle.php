<?php
class mVentaDetalle
{

    public function Listar($id)
    {
        $db = new Database;

        $query = "SELECT VentaDetalle.*, Producto.descripcion AS nombre_producto 
                  FROM VentaDetalle 
                  INNER JOIN Producto ON Producto.id_producto = VentaDetalle.producto 
                  WHERE VentaDetalle.venta = :id";
        $db->prepare($query);
        $db->bindParam(":id", $id);
        
        return $db->getRegistros();
    }
}