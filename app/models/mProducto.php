<?php
class mProducto
{
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    /**
     * Lista todos los productos
     *
     * Devuelve una lista de registros de producto de la base de datos
     *
     * @param Int $offset Inicio paginado
     * @param Int $limit Fin paginado
     * @return Array arreglo de objetos de tipo producto
     **/
    
    public function Listar($offset, $limit)
    {
        $query = "SELECT * FROM Producto
                  ORDER BY id_producto DESC
                  LIMIT :offset, :limit";
        $this->db->prepare($query);
        $this->db->bindParam(":offset", $offset);
        $this->db->bindParam(":limit", $limit);
        
        return $this->db->getRegistros();
    }

    /**
     * Obtiene un producto
     *
     * Devuelve un registro de tipo producto
     *
     * @param Int $id identificador del producto
     * @return Object objeto de tipo producto
     **/
    public function Ver($id) 
    {
        $query = "SELECT * FROM Producto 
                  WHERE id_producto = :id_producto 
                  LIMIT 1";
        $this->db->prepare($query);
        $this->db->bindParam(':id_producto', $id);
    
        return $this->db->getRegistro(); 
    }

    /**
     * Insertar un nuevo producto
     *
     * Insertar un nuevo registro producto de la base de datos
     *
     * @param Object $producto Objeto de tipo producto
     * @return Bool devuelve una confirmacion de Insercion o error
     **/
    public function Insertar($producto)
    {
        $resp;
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
        $resp['status']= $this->db->execute();
        $resp['error']=$this->db->error;
        return $resp;
    }

    /**
     * Actualiza un producto
     *
     * Funcion que actualiza un registro de producto
     *
     * @param Object $producto Objeto de producto
     * @return Bool Devuelve una confirmacion de actualizacion o error
     **/
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
        $resp['status']= $this->db->execute();
        $resp['error']=$this->db->error;
        return $resp;
    }

    /**
     * Elimina el producto 
     *
     * Elimina un registro de producto de la base de datos
     *
     * @param Int $id identificador del producto
     * @return Bool Devuelve confirmacion de Eliminacion de producto o error
     **/
    public function Eliminar($id)
    {
        $resp;
        $query="DELETE FROM Producto 
                WHERE id_producto = :id_producto";
        $this->db->prepare($query);
        $this->db->bindParam(':id_producto', $id);
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
        $query="SELECT * FROM Producto
                LIMIT :offset, :limit";
        $this->db->prepare($query);
        $this->db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $this->db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $this->db->getRegistros();
    }

    public function GetProducto($id)
    {
        $query="SELECT * FROM Producto
                WHERE  id_producto=:id_producto";
        $this->db->prepare($query);
        $this->db->bindParam(':id_producto', $id);
        return $this->db->getRegistro();
    }

    /**
     * Numero de Registros de Clientes en Base de Datos
     *
     * @return type
     **/
    public function CountProductos()
    {
        $sql="SELECT COUNT(*) FROM Producto";
        $this->db->prepare($sql);
        return $this->db->fetchColumn();
    }

    public function CountProductosSearch($busqueda)
    {
        $busqueda="%{$busqueda}%";
        $query="SELECT COUNT(*)
                FROM Producto
                WHERE descripcion LIKE :busqueda";
                
        $this->db->prepare($query);
        $this->db->bindParam(':busqueda',$busqueda);
        return $this->db->fetchColumn();
    }
}
?>