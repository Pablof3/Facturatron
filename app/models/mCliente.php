<?php
class mCliente
{
    private  $db;
    public function __construct() {
        $this->db=new Database;
    }

    /**
     * Inserta un Cliente en la base de datos
     *
     * @param Object  $cliente Objeto tipo Cliente
     * @return Bool
     **/
    public function Insertar($cliente)
    {
        $resp;
        $query="INSERT INTO Cliente(razon, nombre, apellidos, nit) 
                VALUES(:razon, :nombre, :apellidos, :nit)";
        $this->db->prepare($query);
        $this->db->bindParam(':razon', $cliente->razon);
        $this->db->bindParam(':nombre', $cliente->nombre);
        $this->db->bindParam(':apellidos', $cliente->apellidos);
        $this->db->bindParam(':nit', $cliente->nit);

        $resp['status']=$this->db->execute();
        $resp['error']=$this->db->error;

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
        $resp;
        $query="UPDATE Cliente 
                SET razon=:razon, nombre=:nombre, apellidos=:apellidos, nit=:nit
                WHERE id_cliente=:id_cliente";
        $this->db->prepare($query);
        $this->db->bindParam(':razon', $cliente->razon);
        $this->db->bindParam(':nombre', $cliente->nombre);
        $this->db->bindParam(':apellidos', $cliente->apellidos);
        $this->db->bindParam(':nit', $cliente->nit);
        $this->db->bindParam(':id_cliente', $cliente->id_cliente);
        $resp['status']= $this->db->execute();
        $resp['error']=$this->db->error;
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
        $resp;
        $query="DELETE FROM Cliente 
                WHERE id_cliente=:id_cliente";
        $this->db->prepare($query);
        $this->db->bindParam(':id_cliente', $id);
        $resp['status']=$this->db->execute();
        $resp['error']=$this->db->error;
        return $resp;
    }

    /**
     * Obtiene un Arreglo de Clientes con Offset y Limit
     *
     * @param Int $offset Indice inicial
     * @param Int $limit Indice inicial
     * @return Array 
     **/
    public function GetList($offset, $limit)
    {
        $query="SELECT * FROM Cliente
                ORDER BY id_cliente DESC
                LIMIT :offset, :limit";
        $this->db->prepare($query);
        $this->db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $this->db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $this->db->getRegistros();
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
        $busqueda="%{$busqueda}%";
        $query="SELECT *
                FROM Cliente
                WHERE razon LIKE :busqueda 
                OR nombre LIKE :busqueda 
                OR apellidos LIKE :busqueda
                ORDER BY id_cliente DESC
                LIMIT :offset, :limit";
        $this->db->prepare($query);
        $this->db->bindParam(':busqueda',$busqueda);
        $this->db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $this->db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $this->db->getRegistros();
        
    }

    /**
     * Obtiene un cliente de la base de datos por id
     * @param Int $id Id de Cliente 
     * @return Core\Cliente
     **/
    public function GetCliente($id)
    {
        $query="SELECT * FROM Cliente
                WHERE  id_cliente=:id_cliente";
        $this->db->prepare($query);
        $this->db->bindParam(':id_cliente', $id);
        return $this->db->getRegistro();
    }

    /**
     * Numero de Registros de Clientes en Base de Datos
     *
     * @return Int
     **/
    public function CountClientes()
    {
        $sql="SELECT COUNT(*) FROM Cliente";
        $this->db->prepare($sql);
        return $this->db->fetchColumn();
    }

    /**
     * Numero de Registros Coincidentes con una Busqueda
     * @param String $busqueda Parametro de Busqueda
     * @return Int
     **/
    public function CountClientesSearch($busqueda)
    {
        $busqueda="%{$busqueda}%";
        $query="SELECT COUNT(*)
                FROM Cliente
                WHERE razon LIKE :busqueda 
                OR nombre LIKE :busqueda 
                OR apellidos LIKE :busqueda";
        $this->db->prepare($query);
        $this->db->bindParam(':busqueda',$busqueda);
        return $this->db->fetchColumn();
    }
}
?>