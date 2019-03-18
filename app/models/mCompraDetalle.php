<?php
class mCompraDetalle
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Lista todas las compras
     *
     * Devuelve una lista de registros de compra de la base de datos
     *
     * @param Int $offset Inicio paginado
     * @param Int $limit Fin paginado
     * @return Array arreglo de objetos de tipo compra
     **/
    
    public function Listar($offset, $limit)
    {
        $query = "SELECT *.Compra, Proveedor.nombre AS nombre_proveedor, CONCAT(Usuario.nombre, ' ',Usuario.apellidos) AS nombre_usuario 
                  FROM Compra 
                  INNER JOIN Proveedor ON Proveedor.id_proveedor = Compra.proveedor
                  INNER JOIN Usuario ON Usuario.id_usuario = Compra.usuario
                  ORDER BY nro DESC
                  LIMIT :offset, :limit";
        $this->db->prepare($query);
        $this->db->bindParam(":offset", $offset);
        $this->db->bindParam(":limit", $limit);
        
        return $this->db->getRegistros();
    }

    /**
     * Obtiene una compra
     *
     * Devuelve un registro de tipo compra
     *
     * @param Int $id identificador del compra
     * @return Object objeto de tipo compra
     **/
    public function Ver($id)
    {
        $query = "SELECT *.Compra, Proveedor.nombre AS nombre_proveedor, CONCAT(Usuario.nombre, ' ',Usuario.apellidos) AS nombre_usuario 
                  FROM Compra 
                  INNER JOIN Proveedor ON Proveedor.id_proveedor = Compra.proveedor
                  INNER JOIN Usuario ON Usuario.id_usuario = Compra.usuario
                  WHERE id_producto = :id_producto 
                  LIMIT 1";
        $this->db->prepare($query);
        $this->db->bindParam(':id_producto', $id);
    
        return $this->db->getRegistro(); 
    }
}
?>