<?php 
class Ejemplo extends Controller
{
    private $mEjemplo;
    public function __construct() {
        //Ejemplo Importar Modelo
        $this->mEjemplo=$this->modelo('mEjemplo');
    }
    //Ejemplo de Metodo Controlador
    public function Index()
    {
        echo 'Index';
    }

    public function Vista()
    {
        // Ejemplo mostrar vista
        $this->Vista('vEjemplo');
    }
    public function VistaDatos()
    {
        // Ejemplo mostrar vista
        $data=['saludo'=>'Hola Mundo'];
        $this->vista('vEjemplo', $data);
    }
}

?>