<?php 
//Cargar Librerias
require_once 'config/configSystem.php';

//require_once 'lib/Database.php';
//require_once 'lib/Controller.php';
//require_once 'lib/Core.php';

//AUTOLOAD PHP
spl_autoload_register(function($nombreClase)
{
    //echo $nombreClase;
    require_once 'lib/' . $nombreClase . '.php';
});