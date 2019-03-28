<?php
class mUsuario 
{
    public function Insertar($usuario)
    {
        $db=new Database;
        $query="INSERT INTO Usuario(usuario, password, esAdmin, ci, nombre, apellidos)
                VALUES (:usuario, :password, :esAdmin, :ci, :nombre, :apellidos)";
        $db->prepare($query);
        $db->bindParam(':usuario',$usuario->usuario);
        $db->bindParam(':password',$usuario->password);
        $db->bindParam(':esAdmin',$usuario->esAdmin,PDO::PARAM_BOOL);
        $db->bindParam(':ci',$usuario->ci);
        $db->bindParam(':nombre',$usuario->nombre);
        $db->bindParam(':apellidos',$usuario->apellidos);

        $resp['status']=$db->execute();
        $resp['error']=$db->error;
        return $resp;
        
    }

    public function Actualizar($usuario)
    {
        $db=new Database;
        $query="UPDATE Usuario 
                SET usuario=:usuario, password=:password, esAdmin=:esAdmin, ci=:ci, nombre=:nombre, apellidos=:apellidos
                WHERE id_usuario=:id_usuario";
        $db->prepare($query);
        $db->bindParam(':usuario',$usuario->usuario);
        $db->bindParam(':password',$usuario->password);
        $db->bindParam(':esAdmin',$usuario->esAdmin);
        $db->bindParam(':ci',$usuario->ci);
        $db->bindParam(':nombre',$usuario->nombre);
        $db->bindParam(':apellidos',$usuario->apellidos);
        $db->bindParam(':id_usuario',$usuario->id_usuario);

        $resp['status']=$db->execute();
        $resp['error']=$db->error;
        return $resp;
    }

    public function Eliminar($id)
    {
        $db=new Database;
        $query="DELETE FROM Usuario 
                WHERE id_usuario=:id_usuario";
        $db->prepare($query);
        $db->bindParam(':id_usuario', $id);
        
        $resp['status']=$db->execute();
        $resp['error']=$db->error;
        return $resp;
    }

    /**
     * Arreglo de Usuarios de Base de datos
     *Retorna un Arreglo de base de datos dado un offset y un limit
     *
     * @param Int $offset indice inicial
     * @param Int $limit indice final
     * @return Array Arreglo de Objetos de Base de Datos
     **/
    public function GetList($offset, $limit)
    {
        $db=new Database;
        $query="SELECT * FROM Usuario
                ORDER BY id_usuario DESC
                LIMIT :offset, :limit";
        $db->prepare($query);
        $db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $db->getRegistros();
    }


    /**
     * Get List Usuarios
     *
     * Devuelve una lista de Usuarios con un offset y limit dado un criterio de busqueda
     *
     * @param Int $offset registro inicio
     * @param Int $limit numero de registros a partir de offset
     * @param String $busqueda  parametro de busqueda 
     * @return Array Arreglo de Usuarios coincidentes con busqueda
     **/
    public function GetListSearch($offset, $limit, $busqueda)
    {
        $db=new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT *
                FROM Usuario
                WHERE usuario LIKE :busqueda 
                OR nombre LIKE :busqueda 
                OR apellidos LIKE :busqueda
                ORDER BY id_usuario DESC
                LIMIT :offset, :limit";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        $db->bindParam(':offset', $offset, PDO::PARAM_INT);
        $db->bindParam(':limit', $limit, PDO::PARAM_INT);
        return $db->getRegistros();
        
    }


    /**
     * Obtiene un Usuario de la base de datos por id
     * @param Int $id Id de Usuario 
     * @return Core\Usuario
     **/
    public function GetUsuario($id)
    {
        $db=new Database;
        $query="SELECT * FROM Usuario
                WHERE  id_usuario=:id_usuario";
        $db->prepare($query);
        $db->bindParam(':id_usuario', $id);
        return $db->getRegistro();
    }

     /**
     * Numero de Registros de Usuarios en Base de Datos
     *
     * @return Int
     **/
    public function CountUsuarios()
    {
        $db=new Database;
        $sql="SELECT COUNT(*) FROM Usuario";
        $db->prepare($sql);
        return $db->fetchColumn();
    }
    
    /**
     * Numero de Registros Coincidentes con una Busqueda
     * @param String $busqueda Parametro de Busqueda
     * @return Int
     **/
    public function CountUsuariosSearch($busqueda)
    {
        $db=new Database;
        $busqueda="%{$busqueda}%";
        $query="SELECT COUNT(*)
                FROM Usuario
                WHERE usuario LIKE :busqueda 
                OR nombre LIKE :busqueda 
                OR apellidos LIKE :busqueda";
        $db->prepare($query);
        $db->bindParam(':busqueda',$busqueda);
        return $db->fetchColumn();
    }

    public function VerificarUsuario(Core\Usuario $usuario) 
    {
        $db=new Database;
        $query = "SELECT * FROM Usuario
                  WHERE usuario = :usuario AND password = :password";

        $db->prepare($query);
        $db->bindParam("usuario", $usuario->usuario);
        $db->bindParam("password", $usuario->password);
    
        return $db->getRegistro();
    }

}

?>