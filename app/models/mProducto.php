<?php
class mProducto
{
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
        $db=new Database;
        $query = "SELECT * FROM Producto
                  ORDER BY id_producto DESC
                  LIMIT :offset, :limit";
        $db->prepare($query);
        $db->bindParam(":offset", $offset);
        $db->bindParam(":limit", $limit);
        
        return $db->getRegistros();
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
        $db=new Database;
        $query = "SELECT * FROM Producto 
                  WHERE id_producto = :id_producto 
                  LIMIT 1";
        $db->prepare($query);
        $db->bindParam(':id_producto', $id);
    
        return $db->getRegistro(); 
    }

    /**
     * Insertar un nuevo producto
     *
     * Insertar un nuevo registro producto de la base de datos
     *
     * @param Object $producto Objeto de tipo producto
     * @return Bool devuelve una confirmacion de Insercion o error
     **/
    public function Insertar(Core\Producto $producto)
    {
        $db=new Database;
        $resp;
        $query="INSERT INTO Producto(descripcion, precio_unitario, medida, categoria, imagen, stock_minimo, precio_compra)
                VALUES (:descripcion, :precio_unitario, :medida, :categoria, :imagen, :stock_minimo, :precio_compra)";
        $db->prepare($query);
        $db->bindParam(':descripcion', $producto->descripcion);
        $db->bindParam(':precio_unitario', $producto->precio_unitario);
        $db->bindParam(':medida', $producto->medida);
        $db->bindParam(':categoria', $producto->categoria);
        if(!is_null($producto->imagen)) {
            $db->bindParam(':imagen', $producto->imagen);
        } else {
            $db->bindParam(':imagen', $producto->imagen, PDO::PARAM_NULL);
        }
        $db->bindParam(':stock_minimo', $producto->stock_minimo);
        $db->bindParam(':precio_compra', $producto->precio_compra);
        $resp['status']= $db->execute();
        $resp['error']=$db->error;
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
        $db=new Database;
        $query="UPDATE Producto
				SET descripcion = :descripcion, precio_unitario = :precio_unitario, medida = :medida, 
				categoria = :categoria, imagen = :imagen, stock_minimo = :stock_minimo, precio_compra = :precio_compra
                WHERE id_producto = :id_producto";
		$db->prepare($query);
        $db->bindParam(':descripcion', $producto->descripcion);
        $db->bindParam(':precio_unitario', $producto->precio_unitario);
        $db->bindParam(':medida', $producto->medida);
        $db->bindParam(':categoria', $producto->categoria);
        if(!is_null($producto->imagen)) {
            $db->bindParam(':imagen', $producto->imagen);
        } else {
            $db->bindParam(':imagen', $producto->imagen, PDO::PARAM_NULL);
        }
        $db->bindParam(':stock_minimo', $producto->stock_minimo);
        $db->bindParam(':precio_compra', $producto->precio_compra);
        $db->bindParam(':id_producto', $producto->id_producto);		
        $resp['status']= $db->execute();
        $resp['error']=$db->error;
        return $resp;
    }


    public function ImagenPrevia($id) {
        $db = new Database;
        $query="SELECT imagen FROM Producto
                WHERE id_producto = :id_producto";
        $db->prepare($query);
        $db->bindParam(":id_producto", $id, PDO::PARAM_INT);

        return $db->fetchColumn();
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
        $db=new Database;
        $resp;
        $query="DELETE FROM Producto 
                WHERE id_producto = :id_producto";
        $db->prepare($query);
        $db->bindParam(':id_producto', $id);
        $resp['status']=$db->execute();
        $resp['error']=$db->error;
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
        $db=new Database;
        $query="SELECT * FROM Producto
                ORDER BY id_producto DESC
                LIMIT :offset, :limit";
        $db->prepare($query);
        $db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $db->getRegistros();
    }

    /**
     * Get List Productos
     *
     * Devuelve una lista de Productos con un offset y limit dado un criterio de busqueda
     *
     * @param Int $offset registro inicio
     * @param Int $limit numero de registros a partir de offset
     * @param String $busqueda  parametro de busqueda 
     * @return Array Arreglo de Productos coincidentes con busqueda
     **/
    public function GetListSearch($offset, $limit, $busqueda)
    {
        $db = new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT *
                FROM Producto
                WHERE descripcion LIKE :busqueda 
                ORDER BY id_producto DESC
                LIMIT :offset, :limit";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        $db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $db->getRegistros();
    }

    public function GetProducto($id)
    {
        $db=new Database;
        $query="SELECT * FROM Producto
                WHERE  id_producto=:id_producto";
        $db->prepare($query);
        $db->bindParam(':id_producto', $id);
        return $db->getRegistro();
    }

    /**
     * Numero de Registros de Clientes en Base de Datos
     *
     * @return type
     **/
    public function CountProductos()
    {
        $db=new Database;
        $sql="SELECT COUNT(*) FROM Producto";
        $db->prepare($sql);
        return $db->fetchColumn();
    }

    public function CountProductosSearch($busqueda)
    {
        $db=new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT COUNT(*)
                FROM Producto
                WHERE descripcion LIKE :busqueda";
                
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        return $db->fetchColumn();
    }
}
?>