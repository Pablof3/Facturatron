<?php
class mCompraDetalle
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Lista todas los productos de una compra
     *
     * Devuelve una lista de registros de los productos de compra de la base de datos
     *
     * @param Int $id identificador de la compra
     * @return Array arreglo de objetos de tipo compra detalle
     **/
    
    public function Listar($id)
    {
        $query = "SELECT *.CompraDetalle, Producto.nombre AS nombre_producto
                  FROM CompraDetalle 
                  INNER JOIN Producto ON Producto.id_producto = CompraDetalle.producto
                  WHERE CompraDetalle.compra = :id";
        $this->db->prepare($query);
        $this->db->bindParam(":id", $id);
        
        return $this->db->getRegistros();
    }
}
?>