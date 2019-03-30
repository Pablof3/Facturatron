<?php
class mVenta 
{
    //Insertar
    public function Insertar(Core\Venta $venta)
    {
        try
        {
            $this->db->beginTransaction();
            $nro_max = ObtenerNroMax(); 

        $query="INSERT INTO Venta(nro, fecha, usuario, cliente, factura, total)
                VALUES (:nro, :fecha, :usuario, :cliente, :factura, :total)";
        $db->prepare($query);

        $db->bindParam(':nro',$venta->nro);
        $db->bindParam(':fecha',$venta->fecha);
        $db->bindParam(':usuario',$venta->usuario); 
        $db->bindParam(':cliente',$venta->cliente);
        $db->bindParam(':factura',$venta->factura);
        $db->bindParam(':total',$venta->total);
        $this->db->execute();

        $id_compra = $this->db->lastInsertId();
            
            $query = "INSERT INTO VentaDetalle(venta, producto, precio, cantidad, subtotal) 
                      VALUES(:venta, :producto, :precio, :cantidad, :subtotal)";
            $this->db->prepare($query);
            foreach ($venta->venta_detalles as $key => $venta_detalle) {
				$this->db->bindParam(":venta", $id_venta);
                $this->db->bindParam(":producto", $venta_detalle->producto);
                $this->db->bindParam(":producto", $venta_detalle->precio);
				$this->db->bindParam(":cantidad", $venta_detalle->cantidad);
				$this->db->bindParam(":subtotal", $venta_detalle->subtotal);				
                $this->db->execute();
            }  
            $this->db->commit(); 

        }
        catch(Exception $ex)
        {
            $this->db->rollback();
        }
        
    }

    public function ObtenerNroMax() 
    {
        $query = "SELECT MAX(nro) FROM Venta";
        $this->db->prepare($query);
        return $this->db->fetchColumn();
    }

    //Actualizar
    public function Actualizar($venta)
    {
        $db=new Database;
        $resp;
        $query="UPDATE Venta
                SET nro=:nro, fecha=:fecha, usuario=:usuario, cliente=:cliente, factura=:factura, total=:total
                WHERE id_venta=:id_venta";
        $db->prepare($query);
        $db->bindParam(':nro',$venta->nro);
        $db->bindParam(':fecha',$venta->fecha);
        $db->bindParam(':usuario',$venta->usuario);
        $db->bindParam(':cliente',$venta->cliente);
        $db->bindParam(':factura',$venta->factura);
        $db->bindParam(':total',$venta->total);
        $db->bindParam(':id_venta',$venta->id_venta);
        $resp['status']= $db->execute();
        $resp['error']=$db->error;
        return $resp;
    }  
    
    //Eliminar
    public function Eliminar($id)
    {
        $db=new Database;
        $resp;
        $query="DELETE FROM Venta 
                WHERE id_venta=:id_venta";
        $db->prepare($query);
        $db->bindParam(':id_venta', $id);
        $resp['status']=$db->execute();
        $resp['error']=$db->error;
        return $resp;
    }

    //Obtener arreglo de ventas
    public function GetList($offset, $limit)
    {
        $db=new Database;
        $query="SELECT * FROM Venta
                ORDER BY id_venta DESC
                LIMIT :offset, :limit";
        $db->prepare($query);
        $db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $db->getRegistros();
    }

    //Devuelve loista de clientes
    public function GetListSearch($offset, $limit, $busqueda)
    {
        $db=new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT *
                FROM Venta
                WHERE nro LIKE :busqueda 
                OR usuario LIKE :busqueda 
                OR cliente LIKE :busqueda
                OR total LIKE :busqueda
                ORDER BY id_venta DESC
                LIMIT :offset, :limit";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        $db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $db->getRegistros();
        
    }

    //Obtener un cliente de la base de datos 
    public function GetVenta($id)
    {
        $db=new Database;
        $query="SELECT * FROM Venta
                WHERE  id_venta=:id_venta";
        $db->prepare($query);
        $db->bindParam(':id_venta', $id);
        return $db->getRegistro();
    }

    //Numero de regidtros de clientes
    public function CountVentas()
    {
        $db=new Database;
        $sql="SELECT COUNT(*) FROM Venta";
        $db->prepare($sql);
        return $db->fetchColumn();
    }

    //Numeros de registros que coinsiden con una busqueda
    public function CountVentasSearch($busqueda)
    {
        $db=new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT COUNT(*)
                FROM Venta
                WHERE nro LIKE :busqueda 
                OR usuario LIKE :busqueda 
                OR cliente LIKE :busqueda
                OR total LIKE :busqueda";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        return $db->fetchColumn();
    }
}

?>