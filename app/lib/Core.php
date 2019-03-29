<?php
/*  Mapeo de Url d Navegador
    1.- Controlador
    2.- Metodo
    3.- parametro*/

class Core
{
    protected $controladorActual = CONTROLLER;
    protected $metodoActual = METHOD;
    protected $parametros=[];
    protected $errorUrl=false;
    
    public function __construct()
    {
        // print_r($this-> getUrl());
        $url= $this->getUrl();
        //buscar controllador  Existe?
        if (file_exists('../app/controllers/'. ucwords($url[0]) .'.php'))
        {
            $this->controladorActual = ucwords($url[0]);
            unset($url[0]);
        } else {
            $this->errorUrl=true;
            unset($url[0]);
        }       

        //Metodo
        if (isset($url[1]))
        {
            if (method_exists($this->controladorActual, $url[1]))
            {
                $this->metodoActual=$url[1];
                unset($url[1]);
            } else {
                $this->errorUrl=true;
                unset($url[1]);
            }
        } else {
            $this->errorUrl=true;
        }

        //Parametros
        $this->parametros = $url ? array_values($url) : [];

        if($this->errorUrl) {
            $this->controladorActual = "AppError";
            $this->metodoActual = "notFound";
            $this->parametros = "";
        }

        //instancia de controllador
        require_once '../app/controllers/'. $this->controladorActual . '.php';
        $this->controladorActual= new $this->controladorActual;

        //Include Core
        $files=glob('../app/core/*.php');
        foreach ($files as $file) {
            require_once($file);
        }
        //Include Models
        $files=glob('../app/models/*.php');
        foreach ($files as $file) {
            require_once($file);
        }
        
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }

    public function getUrl()
    {
        if (isset($_GET['url']))
        {
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
