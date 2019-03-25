<?php
class Validador
{
    public $error;
    public function __construct() {
        $this->error['status']=true;
    }
    /**
     * Limpia espacios Vacios
     *
     * Limpia Espacios Vacios adelante y atras
     * Argumento pasado por referencia
     *
     * @param Array $vars Arreglo de Valores a Limpiar
     **/
    public function Trim(& $vars)
    {
        foreach ($vars as  $key=>$value) {
            $vars[$key]=trim($value);   
        }
    }
    public function Validar($campo,$opciones=[],$var)
    {
        if (isset($var[$campo])) 
        {
            foreach ($opciones as $key => $opcion) {
                if($opcion==='required')
                {
                    if(empty($var[$campo]))
                    {
                        $this->error['status']=false;
                        $this->error['error'][$campo][]="{$campo} esta vacio";
                    }
                }
                if (strpos($opcion,'minlength')!==false) 
                {
                    if (!empty($var[$campo])) {
                        $parametro=explode(',',$opcion)[1];
                        $long=strlen($var[$campo]);
                        if($long<=0)
                        {
                            $this->error['status']=false;
                            $this->error['error'][$campo][]="{$campo} extension minima mayor a {$parametro}";
                        }
                    }
                }
                if(strpos($opcion,'maxlength')!==false)
                {
                    if (!empty($var[$campo])) {
                        $parametro=explode(',',$opcion)[1];
                        $long=strlen($var[$campo]);
                        if($long>$parametro)
                        {
                            $this->error['status']=false;
                            $this->error['error'][$campo][]="{$campo} extension maxima {$parametro}";
                        }
                    }
                }
            }
        }
        else
        {
            $this->error['status']=false;
            $this->error['error'][$campo][]="{$campo} no esta definido";
            $var[$campo]=null;
        }
        return $var[$campo];
    }

    public static function ValidarDB($errors)
    {
        $resp['status']=true;
        if ($errors['status']==false) {
            $resp['status']=false;
            foreach ($errors['error'] as $error) {
                $codError=$error->errorInfo[1];
                switch ($codError) {
                    case '1062':
                        $resp['error'][]='Registro Duplicado';
                    break;
                }
            }
        }
        return $resp;
    }
}

?>