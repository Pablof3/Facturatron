<?php
class mCliente
{

    public function GetRazonSocial($nit) {
        $db=new Database;

        $query="SELECT razon 
                FROM Cliente 
                WHERE Cliente.nit = :nit";
        $db->prepare($query);
        $db->bindParam(":nit", $nit);
        
        return $db->fetchColumn();
    }

    /**
     * Inserta un Cliente en la base de datos
     *
     * @param Object  $cliente Objeto tipo Cliente
     * @return Bool
     **/
    public function Insertar($cliente)
    {
        $db=new Database;
        $resp;
        $query="INSERT INTO Cliente(razon, nombre, apellidos, nit) 
                VALUES(:razon, :nombre, :apellidos, :nit)";
        $db->prepare($query);
        $db->bindParam(':razon', $cliente->razon);
        $db->bindParam(':nombre', $cliente->nombre);
        $db->bindParam(':apellidos', $cliente->apellidos);
        $db->bindParam(':nit', $cliente->nit);

        $resp['status']=$db->execute();
        $resp['error']=$db->error;

        return $resp;
    }

    /**
     * Actualizar un Cliente
     *
     * @param Object $cliente Objeto tipo Cliente
     * @return Bool
     **/
    public function Actualizar($cliente)
    {
        $db=new Database;
        $resp;
        $query="UPDATE Cliente 
                SET razon=:razon, nombre=:nombre, apellidos=:apellidos, nit=:nit
                WHERE id_cliente=:id_cliente";
        $db->prepare($query);
        $db->bindParam(':razon', $cliente->razon);
        $db->bindParam(':nombre', $cliente->nombre);
        $db->bindParam(':apellidos', $cliente->apellidos);
        $db->bindParam(':nit', $cliente->nit);
        $db->bindParam(':id_cliente', $cliente->id_cliente);
        $resp['status']= $db->execute();
        $resp['error']=$db->error;
        return $resp;
    }

    /**
     * Eliminar un Cliente de la Base de Datos
     *
     *
     * @param Int $id Id de Cliente a Eliminar
     * @return Bool
     **/
    public function Eliminar($id)
    {
        $db=new Database;
        $resp;
        $query="DELETE FROM Cliente 
                WHERE id_cliente=:id_cliente";
        $db->prepare($query);
        $db->bindParam(':id_cliente', $id);
        $resp['status']=$db->execute();
        $resp['error']=$db->error;
        return $resp;
    }

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
        $query="SELECT * FROM Cliente
                ORDER BY id_cliente DESC ";
        if (!is_null($offset) and !is_null($limit)) {
            $query.="LIMIT :offset, :limit";
            $db->prepare($query);
            $db->bindParam(':offset', $offset, PDO::PARAM_INT);
            $db->bindParam(':limit', $limit, PDO::PARAM_INT);
        }
        else{
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
        $db=new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT *
                FROM Cliente
                WHERE razon LIKE :busqueda 
                OR nombre LIKE :busqueda 
                OR apellidos LIKE :busqueda
                ORDER BY id_cliente DESC
                LIMIT :offset, :limit";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        $db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $db->getRegistros();
        
    }

    /**
     * Obtiene un cliente de la base de datos por id
     * @param Int $id Id de Cliente 
     * @return Core\Cliente
     **/
    public function GetCliente($id)
    {
        $db=new Database;
        $query="SELECT * FROM Cliente
                WHERE  id_cliente=:id_cliente";
        $db->prepare($query);
        $db->bindParam(':id_cliente', $id);
        return $db->getRegistro();
    }

    /**
     * Numero de Registros de Clientes en Base de Datos
     *
     * @return Int
     **/
    public function CountClientes()
    {
        $db=new Database;
        $sql="SELECT COUNT(*) FROM Cliente";
        $db->prepare($sql);
        return $db->fetchColumn();
    }

    /**
     * Numero de Registros Coincidentes con una Busqueda
     * @param String $busqueda Parametro de Busqueda
     * @return Int
     **/
    public function CountClientesSearch($busqueda)
    {
        $db=new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT COUNT(*)
                FROM Cliente
                WHERE razon LIKE :busqueda 
                OR nombre LIKE :busqueda 
                OR apellidos LIKE :busqueda";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        return $db->fetchColumn();
    }
}
?>