<?php
class mCategoria
{
    /**
     * Obtiene un Arreglo de Clientes con Offset y Limit
     *
     * @param Int $offset Indice inicial
     * @param Int $limit Indice inicial
     * @return Array 
     **/
    public function GetList($offset=null, $limit=null)
    {
        $db=new Database;
        
        $query = "SELECT * FROM Categoria
                  ORDER BY id_categoria DESC";
        if(!is_null($offset) and !is_null($limit)) {
            $query .= " LIMIT :offset, :limit";
            $db->prepare($query);
            $db->bindParam(":offset", $offset, PDO::PARAM_INT);
            $db->bindParam(":limit", $limit, PDO::PARAM_INT);
        } else {
            $db->prepare($query);
        }        
        return $db->getRegistros();
    }

    /**
     * Get List Clientes
     *
     * Devuelve una lista de clientes con un offset y limit dado un criterio de busqueda
     *
     * @param Int $offset registro inicio
     * @param Int $limit numero de registros a partir de offset
     * @param String $busqueda  parametro de busqueda 
     * @return Array Arreglo de Clientes coincidentes con busqueda
     **/
    public function GetListSearch($offset, $limit, $busqueda)
    {
        $db = new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT *
                FROM Categoria
                WHERE nombre LIKE :busqueda 
                ORDER BY id_categoria DESC
                LIMIT :offset, :limit";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        $db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $db->getRegistros();
    }

    /**
     * Numero de Registros de Clientes en Base de Datos
     *
     * @return type
     **/
    public function CountCategorias()
    {
        $db = new Database;
        $sql="SELECT COUNT(*) FROM Categoria";
        $db->prepare($sql);
        return $db->fetchColumn();
    }
    /**
     * Numero de Registros Coincidentes con una Busqueda
     * @param String $busqueda Parametro de Busqueda
     * @return Int
     **/
    public function CountCategoriasSearch($busqueda)
    {
        $db = new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT COUNT(*)
                FROM Categoria
                WHERE nombre LIKE :busqueda";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        return $db->fetchColumn();
    }


    /**
     * Obtiene una categoria
     *
     * Devuelve un registro de tipo categoria
     *
     * @param Int $id identificador de categoria
     * @return Object objeto de tipo categoria
     **/
    public function Ver($id) 
    {
        $db = new Database;
        $query = "SELECT * FROM Categoria
                  WHERE id_categoria = :id_categoria 
                  LIMIT 1";
        $db->prepare($query);
        $db->bindParam(':id_categoria', $id, PDO::PARAM_INT);
    
        return $db->getRegistro(); 
    }


    public function Insertar(Core\Categoria $categoria)
    {
        $db = new Database;
        $resp;
        $query="INSERT INTO Categoria(nombre, detalle)
                VALUES(:nombre, :detalle)";
        $db->prepare($query);
        $db->bindParam(':nombre',$categoria->nombre);
        $db->bindParam(':detalle',$categoria->detalle);
        
        $resp['status'] = $db->execute();
        $resp['error'] = $db->error;

        return $resp;
    }

    public function Actualizar(Core\Categoria $categoria)
    {
        $db = new Database;
        $resp;
        $query="UPDATE Categoria
                SET nombre= :nombre , detalle= :detalle
                WHERE id_categoria= :id_categoria";
        $db->prepare($query);
        $db->bindParam(':nombre',$categoria->nombre);
        $db->bindParam(':detalle',$categoria->detalle);
        $db->bindParam(':id_categoria', $categoria->id_categoria, PDO::PARAM_INT);
        
        $resp['status'] = $db->execute();
        $resp['error'] = $db->error;
        
        return $resp;
    }

    public function Eliminar($id)
    {
        $db = new Database;
        $resp;
        $query="DELETE FROM Categoria
                WHERE id_categoria= :id_categoria";
        $db->prepare($query);
        $db->bindParam(':id_categoria',$id, PDO::PARAM_INT);
        
        $resp['status'] = $db->execute();
        $resp['error'] = $db->error;
        
        return $resp;
    }
}