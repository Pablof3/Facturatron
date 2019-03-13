<?php
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $name_db = DB_NAME_BD;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct() 
    {
        //configurar conexion
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name_db;

        $options = array(
            PDO::ATTR_PERSISTENT => true ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
         );
    
         //instancia pdo
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
            $this->dbh->exec('set names utf8');
        }
        catch(PDOException $e){
            $this->error= $e->getMessage();
            echo $this->error;
        }
    }
    /**
     * Prepara consulta para ser ejecutada posteriormente
     */
    public function prepare($sql)
    {
        $this->stmt =$this->dbh->prepare($sql) ;
    }

    /**
    * Enlaza consulta preparada con variable(bind Param)
    * 
    * @param string $campo nombre de columna bd
    * @param string $param valor a asignar
    */
    public function bindParam($campo, $param)
    {
        $this->stmt->bindParam($campo, $param);
    }
//parametrisa consulta
    public function bind($param, $val, $type = null)
    {
        if (is_null($type)) 
        {
            switch (true) {
                case is_int($val):
                    $type=PDO::PARAM_INT;
                break;
                case is_bool($val):
                    $type=PDO::PARAM_BOOL;
                break;
                case is_null($val):
                    $type=PDO::PARAM_NULL;
                break;
                
                default:
                    $type = PDO::PARAM_STR;
                break;
            }
        }
        $this->stmt->bindValue($param, $val, $type);
    }
//ejecuta consulta
    public function execute()
    {
        return $this->stmt->execute();
    }
//Obtener registros
    public function getRegistros()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
//Obtener Registro
    public function getRegistro()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    //cantidad de filas
    public function rowCount()
    {
        return $this->stmt->rowCount();

    }
    /**
     * Retorna ultimo id Autogenerado de la ultima consulta
     * @return Id
     **/
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
    /**
    * Inicia Transaccion
    **/
    public function beginTransaction()
    {
        $this->dbh->beginTransaction();
    }
    
    public function commit()
    {
        $this->dbh->commit();
    }
    
    /**
    * Restablece la Transaccion
    */
    public function rollback()
    {
        $this->dbh->rollback();
    }
}

?>
