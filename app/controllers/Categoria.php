<?php
class Categoria extends Controller
{

    public function vListar($offset = 0, $limit = 10) 
    {
        $mCategoria = new mCategoria;
        $data = $mCategoria->Listar($offset, $limit);

        $this->vista('Categoria/vListar', $data);
    }

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
        $categoria->detalle = $validador->Validar('detalle', ["required"], $_POST["Categoria"]);        

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

    public function vModificar($id) 
    {
        $mCategoria = new mCategoria;
        $data = $mCategoria->Ver($id);
        
        $this->vista('Categoria/vModificar', $data);
    }

    public function Modificar() {
        $resp['status']=true;
        $validador = new Validador();
        $validador->Trim($_POST["Categoria"]);
        $categoria=new Core\Categoria;
        $categoria->id_categoria = $validador->Validar('id_categoria', ["required"], $_POST["Categoria"]);
        $categoria->nombre = $validador->Validar('nombre', ["required", "maxlength, 25"], $_POST["Categoria"]);
        $categoria->detalle = $validador->Validar('detalle', ["required"], $_POST["Categoria"]);        

        $resp['validate']=$validador->error;
        $resp['status']=$resp['validate']['status'];        
        if ($validador->error['status']==true) {
            $mCategoria=new mCategoria;
            $mresp=$mCategoria->Actualizar($categoria);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);                                        
    }

    public function vEliminar($id)
    {
        $mCategoria = new mCategoria;
        $data = $mCategoria->Ver($id);

        $this->vista('Categoria/vEliminar', $data);
    }

    public function Eliminar() {
        $resp['status']=true;
        $validador = new Validador();
        $validador->Trim($_POST["Categoria"]);
        $categoria=new Core\Categoria;
        $categoria->id_categoria = $validador->Validar('id_categoria', ["required"], $_POST["Categoria"]);

        $resp['validate']=$validador->error;
        $resp['status']=$resp['validate']['status'];        
        if ($validador->error['status']==true) {
            $mCategoria=new mCategoria;
            $mresp=$mCategoria->Eliminar($categoria->id_categoria);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);   
    }
}

?>