<?php
class mProveedor 
{
    /**
     * Lista todos los proveedores
     *
     * Devuelve una lista de registros de proveedor de la base de datos
     *
     * @param Int $offset Inicio paginado
     * @param Int $limit Fin paginado
     * @return Array arreglo de objetos de tipo proveedor
     **/
    public function GetList($offset=null, $limit=null)
    {
        $db=new Database;
        $query = "SELECT * FROM Proveedor
                  ORDER BY id_proveedor DESC";
        if (is_null($offset) || is_null($limit)) {
            $db->prepare($query);
        }
        else{
            $query.="LIMIT :offset, :limit";
            $db->prepare($query);
            $db->bindParam(":offset", $offset, PDO::PARAM_INT);
            $db->bindParam(":limit", $limit, PDO::PARAM_INT);
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
                FROM Proveedor
                WHERE nombre LIKE :busqueda
                OR telefono LIKE :busqueda
                ORDER BY id_proveedor DESC
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
    public function CountProveedores()
    {
        $db = new Database;
        $sql="SELECT COUNT(*) FROM Proveedor";
        $db->prepare($sql);
        return $db->fetchColumn();
    }
    /**
     * Numero de Registros Coincidentes con una Busqueda
     * @param String $busqueda Parametro de Busqueda
     * @return Int
     **/
    public function CountProveedoresSearch($busqueda)
    {
        $db = new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT COUNT(*)
                FROM Proveedor
                WHERE nombre LIKE :busqueda 
                OR telefono LIKE :busqueda";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        return $db->fetchColumn();
    }


    /**
     * Obtiene un proveedor
     *
     * Devuelve un registro de tipo proveedor
     *
     * @param Int $id identificador de proveedor
     * @return Object objeto de tipo proveedor
     **/
    public function Ver($id) 
    {
        $db = new Database;
        $query = "SELECT * FROM Proveedor
                  WHERE id_proveedor = :id_proveedor 
                  LIMIT 1";
        $db->prepare($query);
        $db->bindParam(':id_proveedor', $id, PDO::PARAM_INT);
    
        return $db->getRegistro(); 
    }


    public function Insertar(Core\Proveedor $proveedor)
    {
        $db = new Database;
        $resp;
        $query="INSERT INTO Proveedor(nombre, telefono, direccion)
                VALUES (:nombre, :telefono, :direccion)";
        $db->prepare($query);
        $db->bindParam(':nombre', $proveedor->nombre);
        $db->bindParam(':telefono', $proveedor->telefono);
        $db->bindParam(':direccion', $proveedor->direccion);
        
        $resp['status'] = $db->execute();
        $resp['error'] = $db->error;

        return $resp;
    }

    public function Actualizar(Core\Proveedor $proveedor)
    {
        $db = new Database;
        $resp;
        $query="UPDATE Proveedor 
                SET nombre=:nombre, telefono=:telefono, direccion=:direccion
                WHERE id_proveedor=:id_proveedor";
        $db->prepare($query);
        $db->bindParam(':nombre', $proveedor->nombre);
        $db->bindParam(':telefono', $proveedor->telefono);
        $db->bindParam(':direccion', $proveedor->direccion);
        $db->bindParam(':id_proveedor', $proveedor->id_proveedor, PDO::PARAM_INT);
        
        $resp['status'] = $db->execute();
        $resp['error'] = $db->error;
        
        return $resp;
    }

    public function Eliminar($id)
    {
        $db = new Database;
        $resp;
        $query="DELETE FROM Proveedor 
                WHERE id_proveedor=:id_proveedor";
        $db->prepare($query);
        $db->bindParam(':id_proveedor', $id, PDO::PARAM_INT);

        $resp['status'] = $db->execute();
        $resp['error'] = $db->error;

        return $resp;
    }
}

?>