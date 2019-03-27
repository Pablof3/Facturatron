<?php
class mProveedor 
{
    private $db;
    public function __construct() {
        $this->db=new Database;
    }

    /**
     * Lista todos los proveedores
     *
     * Devuelve una lista de registros de proveedor de la base de datos
     *
     * @param Int $offset Inicio paginado
     * @param Int $limit Fin paginado
     * @return Array arreglo de objetos de tipo proveedor
     **/
    
    public function Listar($offset, $limit)
    {
        $query = "SELECT * FROM Proveedor
                  ORDER BY id_proveedor DESC
                  LIMIT :offset, :limit";
        $this->db->prepare($query);
        $this->db->bindParam(":offset", $offset, PDO::PARAM_INT);
        $this->db->bindParam(":limit", $limit, PDO::PARAM_INT);
        
        return $this->db->getRegistros();
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
        $query = "SELECT * FROM Proveedor
                  WHERE id_proveedor = :id_proveedor 
                  LIMIT 1";
        $this->db->prepare($query);
        $this->db->bindParam(':id_proveedor', $id, PDO::PARAM_INT);
    
        return $this->db->getRegistro(); 
    }


    public function Insertar(Core\Proveedor $proveedor)
    {
        $resp;
        $query="INSERT INTO Proveedor(nombre, telefono, direccion)
                VALUES (:nombre, :telefono, :direccion)";
        $this->db->prepare($query);
        $this->db->bindParam(':nombre', $proveedor->nombre);
        $this->db->bindParam(':telefono', $proveedor->telefono);
        $this->db->bindParam(':direccion', $proveedor->direccion);
        
        $resp['status'] = $this->db->execute();
        $resp['error'] = $this->db->error;

        return $resp;
    }

    public function Actualizar(Core\Proveedor $proveedor)
    {
        $resp;
        $query="UPDATE Proveedor 
                SET nombre=:nombre, telefono=:telefono, direccion=:direccion
                WHERE id_proveedor=:id_proveedor";
        $this->db->prepare($query);
        $this->db->bindParam(':nombre', $proveedor->nombre);
        $this->db->bindParam(':telefono', $proveedor->telefono);
        $this->db->bindParam(':direccion', $proveedor->direccion);
        $this->db->bindParam(':id_proveedor', $proveedor->id_proveedor, PDO::PARAM_INT);
        
        $resp['status'] = $this->db->execute();
        $resp['error'] = $this->db->error;
        
        return $resp;
    }

    public function Eliminar($id)
    {
        $resp;
        $query="DELETE FROM Proveedor 
                WHERE id_proveedor=:id_proveedor";
        $this->db->prepare($query);
        $this->db->bindParam(':id_proveedor', $id, PDO::PARAM_INT);

        $resp['status'] = $this->db->execute();
        $resp['error'] = $this->db->error;

        return $resp;
    }
}

?>