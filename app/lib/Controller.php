<?php
//Carga mode los y vistas
class Controller
{
    /**
     * Funcion Carga Modelo
     *
     * Instancia de Objeto de Modelo para Trabajar 
     * con la Base de Datos
     *
     * @param String $modelo nombre de Modelo
     * @return Object
     **/
    public function modelo($modelo)
    {
        require "../app/models/" . $modelo . ".php";
        //Instancia de modelo
        return new $modelo();
    }

      /**
       * Funcion Cargar la Vista
       *
       * Dada La ruta La funcion Carga la Vista Para mostrar cuando es Solicitada
       *
       * @param String $vista Ruta de la Vista en Views
       * @param Array $data Arreglo de Datos para la Vista
       **/
      public function vista($vista, $data=[])
      {
          //verificar si existe
          if (file_exists("../app/views/" . $vista . ".php")) 
          {
                require_once "../app/views/" . $vista . ".php" ;
          }
          else 
          {
              die("No existe la vista");
          }
      }
}

?>