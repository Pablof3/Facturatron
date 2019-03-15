<?php 
class Ejemplo extends Controller
{
    private $mEjemplo;
    public function __construct() {
        //Ejemplo Importar Modelo
        //$this->mEjemplo=$this->modelo('mEjemplo');
    }
    //Ejemplo de Metodo Controlador
    public function Index()
    {
        echo 'Index';
        $cliente=new Core\Cliente;
        $cliente->nombre='prueba';
        $cliente->apellidos='apelli';
        $cliente->id_cliente=1;
        $cliente->razon='pru';
        print_r($cliente);
    }

    public function Vista()
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