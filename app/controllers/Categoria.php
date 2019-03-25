<?php
class Categoria extends Controller
{
    public function vRegistrar()
    {
        $this->vista('Categoria/vRegistrar');
    }

    public function Registrar() {
        $resp['status']=true;
        $validador = new Validador();
        $validador->Trim($_POST["Categoria"]);

        $categoria=new Core\Categoria;
        $categoria->nombre = $validador->Validar('nombre', ["required", "maxlength, 25"], $_POST["Categoria"]);
        $categoria->detalle = $validador->Validar('detalle', ["required", "maxlength, 25"], $_POST["Categoria"]);        

        $resp['validate']=$validador->error;
        $resp['status']=$resp['validate']['status'];        
        if ($validador->error['status']==true) {
            $mCategoria=new mCategoria;
            $mresp=$mCategoria->Insertar($categoria);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);                                        
    }
}

?>