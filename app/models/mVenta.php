<?php
class mVenta 
{
    private $db;
    public function __construct() {
        $this->db=new Database;
    }

    //Insertar
    public function Insertar($venta)
    {
        $resp;
        $query="INSERT INTO Venta(nro, fecha, usuario, cliente, factura, total)
                VALUES (:nro, :fecha, :usuario, :cliente, :factura, :total)";
        $this->db->prepare($query);
        $this->db->bindParam(':nro',$venta->nro);
        $this->db->bindParam(':fecha',$venta->fecha);
        $this->db->bindParam(':usuario',$venta->esAdmin); //preguntar que chingados hace esto
        $this->db->bindParam(':cliente',$venta->cliente);
        $this->db->bindParam(':factura',$venta->factura);
        $this->db->bindParam(':total',$venta->total);
        
        $resp['status']=$this->db->execute();
        $resp['error']=$this->db->error;
        return $resp;
    }

    //Actualizar
    public function Actualizar($venta)
    {
        $resp;
        $query="UPDATE Venta
                SET nro=:nro, fecha=:fecha, usuario=:usuario, cliente=:cliente, factura=:factura, total=:total
                WHERE id_venta=:id_venta";
        $this->db->prepare($query);
        $this->db->bindParam(':nro',$venta->nro);
        $this->db->bindParam(':fecha',$venta->fecha);
        $this->db->bindParam(':usuario',$venta->usuario);
        $this->db->bindParam(':cliente',$venta->cliente);
        $this->db->bindParam(':factura',$venta->factura);
        $this->db->bindParam(':total',$venta->total);
        $this->db->bindParam(':id_venta',$venta->id_venta);
        $resp['status']= $this->db->execute();
        $resp['error']=$this->db->error;
        return $resp;
    }  
    
    //Eliminar
    public function Eliminar($id)
    {
        $resp;
        $query="DELETE FROM Venta 
                WHERE id_venta=:id_venta";
        $this->db->prepare($query);
        $this->db->bindParam(':id_venta', $id);
        $resp['status']=$this->db->execute();
        $resp['error']=$this->db->error;
        return $resp;
    }

    //Obtener arreglo de ventas
    public function GetList($offset, $limit)
    {
        $query="SELECT * FROM Venta
                ORDER BY id_venta DESC
                LIMIT :offset, :limit";
        $this->db->prepare($query);
        $this->db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $this->db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $this->db->getRegistros();
    }

    //Devuelve loista de clientes
    public function GetListSearch($offset, $limit, $busqueda)
    {
        $busqueda="%{$busqueda}%";
        $query="SELECT *
                FROM Venta
                WHERE nro LIKE :busqueda 
                OR usuario LIKE :busqueda 
                OR cliente LIKE :busqueda
                OR total LIKE :busqueda
                ORDER BY id_venta DESC
                LIMIT :offset, :limit";
        $this->db->prepare($query);
        $this->db->bindParam(':busqueda',$busqueda);
        $this->db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $this->db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $this->db->getRegistros();
        
    }

    //Obtener un cliente de la base de datos 
    public function GetVenta($id)
    {
        $query="SELECT * FROM Venta
                WHERE  id_venta=:id_venta";
        $this->db->prepare($query);
        $this->db->bindParam(':id_venta', $id);
        return $this->db->getRegistro();
    }

    //Numero de regidtros de clientes
    public function CountVentas()
    {
        $sql="SELECT COUNT(*) FROM Venta";
        $this->db->prepare($sql);
        return $this->db->fetchColumn();
    }

    //Numeros de registros que coinsiden con una busqueda
    public function CountVentasSearch($busqueda)
    {
        $busqueda="%{$busqueda}%";
        $query="SELECT COUNT(*)
                FROM Venta
                WHERE nro LIKE :busqueda 
                OR usuario LIKE :busqueda 
                OR cliente LIKE :busqueda
                OR total LIKE :busqueda";
        $this->db->prepare($query);
        $this->db->bindParam(':busqueda',$busqueda);
        return $this->db->fetchColumn();
    }
}

?>