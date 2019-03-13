<?php 
class mEjemplo
{
    private $db;

    public function __construct() 
    {
        $this->db = new Database();
    }

    public function ObtenerArticulos()
    {
        $this->db->query("SELECT * FROM Articulo");
        return $this->db->getRegistros();
    }
}

?>