<?php
class mVenta 
{
    private $db;
    public function __construct() {
        $this->db=new Database;
    }

    public function Insertar($venta)
    {
        $query="INSERT INTO Venta(nro, fecha, usuario, cliente, factura, total)
                VALUES (:nro, :fecha, :usuario, :cliente, :factura, :total)";
        $this->db->prepare($query);
        $this->db->bindParam(':nro',$venta->nro);
        $this->db->bindParam(':fecha',$venta->fecha);
        $this->db->bindParam(':usuario',$venta->esAdmin);
        $this->db->bindParam(':cliente',$venta->cliente);
        $this->db->bindParam(':factura',$venta->factura);
        $this->db->bindParam(':total',$venta->total);
        return $this->db->execute();
        
    }
    public function Actualizar($venta)
    {
        $query="UPDATE Venta
                SET nro=:nro, fecha=:fecha, usuario=:usuario, cliente=:cliente, factura=:factura, total=:total
                WHERE id_venta=:id_venta";
        $this->db->prepare($query);
        $this->db->bindParam(':nro',$venta->nro);
        $this->db->bindParam(':fecha',$venta->fecha);
        $this->db->bindParam(':usuario',$venta->usuario);
        $this->db->bindParam(':cliente',$venta->cliente);
        $this->db->bindParam(':factura',$venta->factura);
        $this->db->bindParam(':total',$venta->total);
        $this->db->bindParam(':id_venta',$venta->id_venta);
        return $this->db->execute();
    }   
    public function Eliminar($id)
    {
        $query="DELETE FROM Venta 
                WHERE id_venta=:id_venta";
        $this->db->prepare($query);
        $this->db->bindParam(':id_venta', $id);
        return $this->db->execute();
    }
}

?>