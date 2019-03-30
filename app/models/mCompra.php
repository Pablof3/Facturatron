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
                  ORDER BY Compra.nro DESC
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
                  WHERE Compra.id_compra = :id_compra 
                  LIMIT 1";
        $this->db->prepare($query);
        $this->db->bindParam(':id_compra', $id);
    
        $compra = $this->db->getRegistro();
        
        $modeloCompraDetalle = new mCompraDetalle();
        $compra->compra_detalles = $modeloCompraDetalle->Listar($compra->id_compra);

        return $compra; 
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
        $db=new Database;
        $resp;

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
				$this->db->bindParam(":compra", $id_compra);
				$this->db->bindParam(":producto", $compra_detalle->producto);
				$this->db->bindParam(":cantidad", $compra_detalle->cantidad);
				$this->db->bindParam(":subtotal", $compra_detalle->subtotal);				
                $this->db->execute();
            }
            $resp['status']= $db->commit();
        }
        catch(Exception $ex)
        {
            $this->db->rollback();
            $resp['error']=$db->error;
        }
        finally
        {
            return $resp;
        }
    }

    public function ObtenerNroMax() 
    {
        $db=new Database;
        $query = "SELECT MAX(nro) FROM Compra";
        $this->db->prepare($query);
        return $this->db->fetchColumn();
    }

    //Eliminar
    public function Eliminar($id)
    {
        $db=new Database;
        $resp;
        $query="DELETE FROM Compra 
                WHERE id_compra=:id_compra";
        $db->prepare($query);
        $db->bindParam(':id_compra', $id);
        $resp['status']=$db->execute();
        $resp['error']=$db->error;
        return $resp;
    }

    public function GetList($offset, $limit)
    {
        $db=new Database;
        $query="SELECT * FROM Compra
                ORDER BY id_compra DESC
                LIMIT :offset, :limit";
        $db->prepare($query);
        $db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $db->getRegistros();
    }

    //Devuelve loista de compras
    public function GetListSearch($offset, $limit, $busqueda)
    {
        $db=new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT *
                FROM Compra
                WHERE nro LIKE :busqueda
                OR fecha LIKE :busqueda  
                OR usuario LIKE :busqueda 
                OR proveedor LIKE :busqueda
                OR total LIKE :busqueda
                ORDER BY id_compra DESC
                LIMIT :offset, :limit";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        $db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $db->getRegistros();
        
    }

    //Obtener una compra de la base de datos 
    public function GetConpra($id)
    {
        $db=new Database;
        $query="SELECT * FROM Compra
                WHERE  id_compra=:id_compra";
        $db->prepare($query);
        $db->bindParam(':id_compra', $id);
        return $db->getRegistro();
    }
     //Numero de regidtros de compras
     public function CountCompras()
     {
         $db=new Database;
         $sql="SELECT COUNT(*) FROM Compra";
         $db->prepare($sql);
         return $db->fetchColumn();
     }

     //Numeros de registros que coinsiden con una busqueda
    public function CountComprasSearch($busqueda)
    {
        $db=new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT COUNT(*)
                FROM Compra
                WHERE nro LIKE :busqueda 
                OR fecha LIKE :busqueda
                OR usuario LIKE :busqueda 
                OR proveedor LIKE :busqueda
                OR total LIKE :busqueda";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        return $db->fetchColumn();
    }
 
}
?>