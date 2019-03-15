<?php
class mProducto
{
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function Insertar($producto)
    {
        $query="INSERT INTO Producto(descripcion, precio_unitario, medida, categoria, imagen, stock_minimo, precio_compra)
                VALUES (:descripcion, :precio_unitario, :medida, :categoria, :imagen, :stock_minimo, :precio_compra)";
        $this->db->prepare($query);
        $this->db->bindParam(':descripcion', $producto->descripcion);
        $this->db->bindParam(':precio_unitario', $producto->precio_unitario);
        $this->db->bindParam(':medida', $producto->medida);
        $this->db->bindParam(':categoria', $producto->categoria);
        $this->db->bindParam(':imagen', $producto->imagen);
        $this->db->bindParam(':stock_minimo', $producto->stock_minimo);
        $this->db->bindParam(':precio_compra', $producto->precio_compra);
        return $this->db->execute();
    }

    public function Actualizar($producto)
    {
        $query="UPDATE Producto
				SET descripcion = :descripcion, precio_unitario = :precio_unitario, medida = :medida, 
				categoria = :categoria, imagen = :imagen, stock_minimo = :stock_minimo, precio_compra = :precio_compra
                WHERE id_producto = :id_producto";
		$this->db->prepare($query);
        $this->db->bindParam(':descripcion', $producto->descripcion);
        $this->db->bindParam(':precio_unitario', $producto->precio_unitario);
        $this->db->bindParam(':medida', $producto->medida);
        $this->db->bindParam(':categoria', $producto->categoria);
        $this->db->bindParam(':imagen', $producto->imagen);
        $this->db->bindParam(':stock_minimo', $producto->stock_minimo);
        $this->db->bindParam(':precio_compra', $producto->precio_compra);
        $this->db->bindParam(':id_producto', $producto->id_producto);		
        return $this->db->execute();
    }

    public function Eliminar($id)
    {
        $query="DELETE FROM Producto 
                WHERE id_producto = :id_producto";
        $this->db->prepare($query);
        $this->db->bindParam(':id_producto', $id);
        return $this->db->execute();
    }
}

?>