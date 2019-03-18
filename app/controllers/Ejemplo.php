<?php 
class Ejemplo extends Controller
{
    public function __construct() { 

    }
    //Ejemplo de Metodo Controlador
    public function Index()
    {
        $categoria=new Core\Categoria;
        $categoria->detalle='prueba';
        $categoria->id_categoria=1;
        $categoria->nombre='mi Categoria';

        $mCategoria=new mCategoria;
        $mCategoria->Insertar($categoria);
        echo 'Index';
    }

    public function VerVista()
    {
        // Ejemplo mostrar vista
        //$this->Vista('vEjemplo');
    }
    public function VistaDatos()
    {
        // Ejemplo mostrar vista
        //$data=['saludo'=>'Hola Mundo'];
        //$this->vista('vEjemplo', $data);
    }
}

?>