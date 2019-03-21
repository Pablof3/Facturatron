<?php
class Categoria extends Controller
{
    public function vRegistrar()
    {
        // $categoria=new Core\Categoria;
        // $categoria->id_categoria=1;
        // $categoria->nombre='Tintas';
        // $categoria->detalle='Tintas de Impresora Epson, Canon Blanco y Negro';
        // $mCategoria=new mCategoria;
        // $data=['prueba'=>$mCategoria->Insertar($categoria)];
        $this->vista('Categoria/vRegistrar');
    }

    public function Registrar() {
        $validador = new Validador();
        $validador->Trim($_POST["Categoria"]);
        $categoria=new Core\Categoria;
        $categoria->nombre = $validador->Validar('nombre', ["required", "maxlength, 25"],$_POST["Categoria"]);
        $categoria->detalle = $validador->Validar('detalle', ["required"], $_POST["Categoria"]);        

        $mCategoria=new mCategoria;
        $mCategoria->validador = $validador;

        echo $mCategoria->Insertar($categoria);
    }
}

?>