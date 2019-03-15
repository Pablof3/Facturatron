<?php
class mUsuario 
{
    private $db=new Database;
    public function __construct() {
        $this->db=new Database; 
    }

    public function Insertar($usuario)
    {
        $query="INSERT INTO Usuario(usuario, password, esAdmin, ci, nombre, apellido)
                VALUES (:usuario, :password, :esAdmin, :ci, :nombre, :apellido)";
        $this->db->prepare($query);
        $this->db->bindParam(':usuario',$usuario->usuario);
        $this->db->bindParam(':password',$usuario->password);
        $this->db->bindParam(':esAdmin',$usuario->esAdmin);
        $this->db->bindParam(':ci',$usuario->ci);
        $this->db->bindParam(':nombre',$usuario->nombre);
        $this->db->bindParam(':nombre',$usuario->apellido);
        return $this->db->execute();
        
    }

    public function Actualizar($usuario)
    {
        $query="UPDATE Usuario 
                SET usuario=:usuario, password=:password, esAdmin=:esAdmin, ci=:ci, nombre=:nombre, apellidos=:apellidos
                WHERE id_usuario=:id_usuario";
        $this->db->prepare($query);
        $this->db->bindParam(':usuario',$usuario->usuario);
        $this->db->bindParam(':password',$usuario->password);
        $this->db->bindParam(':esAdmin',$usuario->esAdmin);
        $this->db->bindParam(':ci',$usuario->ci);
        $this->db->bindParam(':nombre',$usuario->nombre);
        $this->db->bindParam(':nombre',$usuario->apellido);
        $this->db->bindParam(':id_usuario',$usuario->id_usuario);
        return $this->db->execute();
    }

    public function Eliminar($id)
    {
        $query="DELETE FROM Usuario WHERE id_usuario=:id_usuario";
        $this->db->prepare($query);
        $this->db->bindParam(':id_usuario', $id);
        return $this->db->execute();
    }
}

?>