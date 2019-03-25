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
        $this->db->bindParam(':apellido', $cliente->apellido);
        $this->db->bindParam(':nit', $cliente->nit);
        $this->db->bindParam(':nit', $cliente->id_cliente);
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
                LIMIT :offset, :limit";
        $this->db->prepare($query);
        $this->db->bindParam(':offset', $offset);
        $this->db->bindParam(':limit', $limit);
        return $this->db->getRegistros();
    }
}
?>