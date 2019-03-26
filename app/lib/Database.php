<?php
class Database
{
    private $host = DB_HOST;
    private $port=DB_PORT;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $name_db = DB_NAME_BD;

    private $dbh;
    private $stmt;
    public $error;

    public function __construct() 
    {
        //configurar conexion
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name_db.';port='.$this->port;

        $options = array(
            PDO::ATTR_PERSISTENT => true ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
         );
    
         //instancia pdo
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
            $this->dbh->exec('set names utf8');
        }
        catch (\Throwable $e) {
            $this->error[]=$e;
        }
        catch(Exception $e)
        {
            $this->error[]=$e;
        }
        catch(PDOException $e)
        {
            $this->error[]=$e;
        }
    }
    /**
     * Prepara consulta para ser ejecutada posteriormente
     */
    public function prepare($sql)
    {
        try {
            $this->stmt =$this->dbh->prepare($sql);
            
        } catch (\Throwable $e) {
            $this->error[]=$e;
        }
        catch(Exception $e)
        {
            $this->error[]=$e;
        }
        catch(PDOException $e)
        {
            $this->error[]=$e;
        }

    }

    /**
    * Enlaza consulta preparada con variable(bind Param)
    * 
    * @param string $campo nombre de columna bd
    * @param string $param valor a asignar
    */
    public function bindParam($campo, $param)
    {
        try {
            $this->stmt->bindParam($campo, $param);
            
        } catch (\Throwable $e) {
            $this->error[]=$e;
        }
        catch(Exception $e)
        {
            $this->error[]=$e;
        }
        catch(PDOException $e)
        {
            $this->error[]=$e;
        }
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
        $resp=false;
        try {
            $resp=$this->stmt->execute();
        } catch (\Throwable $e) {
            $this->error[]=$e;

        }
        catch(Exception $e)
        {
            $this->error[]=$e;

        }
        catch(PDOException $e)
        {
            $this->error[]=$e;

        }
        return $resp;
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
     * Devuelve el primer resultado de una consulta, escalar
     *
     * Devuelve la primera columna de la primera fila del resultado
     *
     * @param Int $column numero de columna elegida, init en 0
     * @return String resultado de columna
     **/
    public function fetchColumn($column = 0)
    {
        $this->execute();
        return $this->stmt->fetchColumn($column);
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
