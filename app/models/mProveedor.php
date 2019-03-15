<?php
class mProveedor 
{
    private $db=new Database;
    public function __construct() {
        $this->db=new Database;
    }

    public function Insertar($proveedor)
    {
        $query="INSERT INTO Proveedor(nombre, telefono, direccion)
                VALUES (:nombre, :telefono, :direccion)";
        $this->db->prepare($query);
        $this->db->bindParam(':nombre', $proveedor->nombre);
        $this->db->bindParam(':telefono', $proveedor->telefono);
        $this->db->bindParam(':direccion', $proveedor->direccion);
        return $this->db->execute();
    }

    public function Actualizar($proveedor)
    {
        $query="UPDATE Proveedor 
                SET nombre=:nombre, telefono=:telefono, direccion=:direccion
                WHERE id_proveedor=:id_proveedor";
        $this->db->prepare($query);
        $this->db->bindParam(':nombre', $proveedor->nombre);
        $this->db->bindParam(':telefono', $proveedor->telefono);
        $this->db->bindParam(':direccion', $proveedor->direccion);
        $this->db->bindParam(':id_proveedor', $proveedor->id_proveedor);
        return $this->db->execute();
    }

    public function Eliminar($id)
    {
        $query="DELETE FROM Proveedor 
                WHERE id_proveedor=:id_proveedor";
        $this->db->prepare($query);
        $this->db->bindParam(':id_proveedor', $id);
        return $this->db->execute();
    }
}

?>