<?php
//Nombre Sitio
define('NOMBRE_SITIO', 'FACTURATRON');

//Configuracion Base de Datos
define('DB_HOST','localhost');  //base de datos
define('DB_PORT','3306');          //Puerto de conexion
define('DB_USER','root');       //usuario de base de datos
define('DB_PASSWORD','');       //contraseña de usuario de base de datos
define('DB_NAME_BD','facturatrondb');   //nombre de base de datos

//Configuracion CONTROLADOR y METODO [DEFAULT]
define('CONTROLLER','Login');   //Controller
define('METHOD','Index');           //Method

//Ruta App
define('RUTA_APP', dirname(dirname(__FILE__)));

//URL
define('RUTA_URL', 'http://'.$_SERVER['HTTP_HOST'].'/Facturatron'); //Cambiar a Nombre de Proyecto


?>