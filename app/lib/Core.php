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
    
    public function __construct()
    {
        
        if(!isset($_SESSION["usuario"])) {
            $this->controladorActual = "Login";
            $this->metodoActual = "Index";
        }
         
        // print_r($this-> getUrl());
        $url= $this->getUrl();
        //buscar controllador  Existe?
        if (file_exists('../app/controllers/'. ucwords($url[0]) .'.php'))
        {
            $this->controladorActual = ucwords($url[0]);
            unset($url[0]);
        }

        //instancia de controllador
        require_once '../app/controllers/'. $this->controladorActual . '.php';
        $this->controladorActual= new $this->controladorActual;

        //Metodo
        if (isset($url[1]))
        {
            if (method_exists($this->controladorActual, $url[1]))
            {
                $this->metodoActual=$url[1];
                unset($url[1]);
            }
        }
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

        //echo $this->metodoActual;
        //Parametros
        $this->parametros = $url ? array_values($url) : [];
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
