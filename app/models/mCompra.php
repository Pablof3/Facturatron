<?php
class mCompra 
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


    /**
     * Insertar una nueva compra
     *
     * Insertar una nueva registro compra de la base de datos
     *
     * @param Object $compra Objeto de tipo compra
     * @return Bool devuelve una confirmacion de Insercion o error
     **/
    public function Insertar($compra)
    {
        try
        {
            $this->db->beginTransaction();
            $nro_max = ObtenerNroMax();        
         
            $query="INSERT INTO Compra(nro, fecha, usuario, proveedor, total)
                    VALUES (:nro, :fecha, :usuario, :proveedor, :total)";
            $this->db->prepare($query);
            $this->db->bindParam(':nro', $nro_max);
            $this->db->bindParam(':fecha', $producto->fecha);
            $this->db->bindParam(':usuario', $producto->usuario);
            $this->db->bindParam(':proveedor', $producto->proveedor);
            $this->db->bindParam(':total', $producto->total);
            $this->db->execute();

            $id_compra = $this->db->lastInsertId();
            
            $query = "INSERT INTO CompraDetalle(compra, producto, cantidad, subtotal) 
                      VALUES(:compra, :producto, :cantidad, :subtotal)";
            $this->db->prepare($query);
            foreach ($compra->compra_detalles as $key => $compra_detalle) {
                $this->db->bindParam(":compra");
                $this->db->execute();
            }   

        }
        catch(Exception $ex)
        {
            $this->db->rollback();
        }
    }

    public function ObtenerNroMax() 
    {
        $query = "SELECT MAX(nro) FROM Compra";
        $this->db->prepare($query);
        return $this->db->fetchColumn();
    }

}
?>