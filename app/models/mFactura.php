<?php
class mFactura
{
    private $db;
    public function __construct() 
    {
        $this->db=new Database;
    }

    public function Insertar($factura)
    {
        $query="INSERT INTO Factura(nit, )";
    }
}