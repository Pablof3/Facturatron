<?php
class mCategoria
{
    private $db;
    public function __construct()
    {
       $this->db= new Database;
    }
    
    /**
     * Lista todos las categorias
     *
     * Devuelve una lista de registros de categoria de la base de datos
     *
     * @param Int $offset Inicio paginado
     * @param Int $limit Fin paginado
     * @return Array arreglo de objetos de tipo categoria
     **/
    
    public function Listar($offset, $limit)
    {
        $query = "SELECT * FROM Categoria
                  ORDER BY id_categoria DESC
                  LIMIT :offset, :limit";
        $this->db->prepare($query);
        $this->db->bindParam(":offset", $offset, PDO::PARAM_INT);
        $this->db->bindParam(":limit", $limit, PDO::PARAM_INT);
        
        return $this->db->getRegistros();
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
        $query = "SELECT * FROM Categoria
                  WHERE id_categoria = :id_categoria 
                  LIMIT 1";
        $this->db->prepare($query);
        $this->db->bindParam(':id_categoria', $id, PDO::PARAM_INT);
    
        return $this->db->getRegistro(); 
    }


    public function Insertar(Core\Categoria $categoria)
    {
        $resp;
        $query="INSERT INTO Categoria(nombre, detalle)
                VALUES(:nombre, :detalle)";
        $this->db->prepare($query);
        $this->db->bindParam(':nombre',$categoria->nombre);
        $this->db->bindParam(':detalle',$categoria->detalle);
        
        $resp['status'] = $this->db->execute();
        $resp['error'] = $this->db->error;

        return $resp;
    }

    public function Actualizar(Core\Categoria $categoria)
    {
        $resp;
        $query="UPDATE Categoria
                SET nombre= :nombre , detalle= :detalle
                WHERE id_categoria= :id_categoria";
        $this->db->prepare($query);
        $this->db->bindParam(':nombre',$categoria->nombre);
        $this->db->bindParam(':detalle',$categoria->detalle);
        $this->db->bindParam(':id_categoria', $categoria->id_categoria, PDO::PARAM_INT);
        
        $resp['status'] = $this->db->execute();
        $resp['error'] = $this->db->error;
        
        return $resp;
    }

    public function Eliminar($id)
    {
        $resp;
        $query="DELETE FROM Categoria
                WHERE id_categoria= :id_categoria";
        $this->db->prepare($query);
        $this->db->bindParam(':id_categoria',$id, PDO::PARAM_INT);
        
        $resp['status'] = $this->db->execute();
        $resp['error'] = $this->db->error;
        
        return $resp;
    }
}