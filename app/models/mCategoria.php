<?php
class mCategoria
{
    private $db;
    public function __construct()
    {
       // $this->db= new Database;
    }
    public function Insertar($categoria)
    {
        $query="INSERT INTO Categoria(nombre, detalle)
        VALUES(:nombre, :detalle)";
        $this->db->prepare($query);
        $this->db->bindParam(':nombre',$categoria->nombre);
        $this->db->bindParam(':fecha',$categoria->Categoria);
        return $this->db->execute();
    }

    public function Actualizar($categoria)
    {
        $query="UPDATE Categoria
                SET nombre= :nombre , detalle= :detalle
                WHERE id_categoria= :id_categoria";
        $this->db->prepare($query);
        $this->db->bindParam(':nombre',$categoria->nombre);
        $this->db->bindParam(':fecha',$categoria->Categoria);
        $this->db->bindParam(':id_categoria', $categoria->id_categoria);
        return $this->db->execute();
    }

    public function Eliminar($id)
    {
        $query="DELETE FROM Categoria
                WHERE id_categoria= :id_categoria";
        $this->db->prepare($query);
        $this->db->bindParam(':id_categoria',$id);
        return $this->db->execute();
    }
}