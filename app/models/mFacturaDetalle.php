<?php 
class mFacturaDetalle
{
    private $db;
    public function __construct() {
        $this->db=new Database;
    }

    /**
     * Inserta FacturaDetalle en Factura
     *
     * @param Object $facturaDetalle Detalle de Producto
     * @return Bool
     **/
    public function Insertar($facturaDetalle)
    {
        $query="INSERT INTO FacturaDetalle(factura, concepto, cantidad, precio_unitario)
                VALUES (:factura, :concepto, :cantidad, :precio_unitario)";
        $this->db->prepare($query);
        $this->db->bindParam(':factura', $facturaDetalle->factura);
        $this->db->bindParam(':concepto', $facturaDetalle->concepto);
        $this->db->bindParam(':cantidad', $facturaDetalle->cantidad);
        $this->db->bindParam(':precio_unitario', $facturaDetalle->cateprecio_unitariogoria);
        return $this->db->execute();
    }

    /**
     * Actuliza una facturaDetalle  de una Vactura
     *
     * @param Object $facturaDetalle Actualiza una factura detelle de factura
     * @return Bool
     **/
    public function Actualizar($facturaDetalle)
    {

    }
}

?>