<?php
class Categoria extends Controller
{
    public function Registrar()
    {
        // $categoria=new Core\Categoria;
        // $categoria->id_categoria=1;
        // $categoria->nombre='Tintas';
        // $categoria->detalle='Tintas de Impresora Epson, Canon Blanco y Negro';
        // $mCategoria=new mCategoria;
        // $data=['prueba'=>$mCategoria->Insertar($categoria)];
        $this->vista('Categoria/vRegistrar');
    }
}

?>