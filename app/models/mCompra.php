<?php
class mCompra 
{
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
        $db = new Database;
        $query = "SELECT *.Compra, Proveedor.nombre AS nombre_proveedor, CONCAT(Usuario.nombre, ' ',Usuario.apellidos) AS nombre_usuario 
                  FROM Compra 
                  INNER JOIN Proveedor ON Proveedor.id_proveedor = Compra.proveedor
                  INNER JOIN Usuario ON Usuario.id_usuario = Compra.usuario
                  WHERE Compra.id_compra = :id_compra 
                  LIMIT 1";
        $db->prepare($query);
        $db->bindParam(':id_compra', $id);
    
        $compra = $db->getRegistro();
        
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
            $db->beginTransaction();
            $nro_max = ObtenerNroMax();        
         
            $query="INSERT INTO Compra(nro, fecha, usuario, proveedor, total)
                    VALUES (:nro, :fecha, :usuario, :proveedor, :total)";
            $db->prepare($query);
            $db->bindParam(':nro', $nro_max);
            $db->bindParam(':fecha', $producto->fecha);
            $db->bindParam(':usuario', $producto->usuario);
            $db->bindParam(':proveedor', $producto->proveedor);
            $db->bindParam(':total', $producto->total);
            $db->execute();

            $id_compra = $db->lastInsertId();
            
            $query = "INSERT INTO CompraDetalle(compra, producto, cantidad, subtotal) 
                      VALUES(:compra, :producto, :cantidad, :subtotal)";
            $db->prepare($query);
            foreach ($compra->compra_detalles as $key => $compra_detalle) {
				$db->bindParam(":compra", $id_compra);
				$db->bindParam(":producto", $compra_detalle->producto);
				$db->bindParam(":cantidad", $compra_detalle->cantidad);
				$db->bindParam(":subtotal", $compra_detalle->subtotal);				
                $db->execute();
            }
            $resp['status']= $db->commit();
        }
        catch(Exception $ex)
        {
            $db->rollback();
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
        $db->prepare($query);
        return $db->fetchColumn();
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
        $query="SELECT Compra.id_compra, Compra.nro, Compra.fecha, Compra.total, 
                Proveedor.nombre AS proveedor, CONCAT(Usuario.nombre, ' ', Usuario.apellidos) AS usuario
                FROM Compra
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
        $query="SELECT Compra.id_compra, Compra.nro, Compra.fecha, Compra.total, 
                Proveedor.nombre AS proveedor, CONCAT(Usuario.nombre, ' ', Usuario.apellidos) AS usuario
                FROM Compra
                WHERE nro LIKE :busqueda
                OR usuario LIKE :busqueda 
                OR proveedor LIKE :busqueda
                ORDER BY id_compra DESC
                LIMIT :offset, :limit";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        $db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $db->getRegistros();
        
    }

    //Obtener una compra de la base de datos 
    public function GetCompra($id)
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