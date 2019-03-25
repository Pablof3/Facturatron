<?php
class mCategoria
{
    private $db;
    private $response;

    public function __construct()
    {
       $this->db= new Database;
       $this->response=["status" => "ok", "errores" => ""];
    }
    
    public function Insertar(Core\Categoria $categoria)
    {
        try {
            $query="INSERT INTO Categoria(nombre, detalle)
            VALUES(:nombre, :detalle)";
            $this->db->prepare($query);
            $this->db->bindParam(':nombre',$categoria->nombre);
            $this->db->bindParam(':detalle',$categoria->detalle);
            if(!$this->db->execute()) {
                $this->db->error;
            }
        } catch (Exception $ex) {
            $this->response["status"] = "error";
            $this->response["msgerror"] = $ex->getMessage();
        }
        finally {
            return json_encode($this->response);
        }
    }

    public function Actualizar(Core\Categoria $categoria)
    {
        $query="UPDATE Categoria
                SET nombre= :nombre , detalle= :detalle
                WHERE id_categoria= :id_categoria";
        $this->db->prepare($query);
        $this->db->bindParam(':nombre',$categoria->nombre);
        $this->db->bindParam(':detalle',$categoria->detalle);
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