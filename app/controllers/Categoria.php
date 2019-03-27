<?php
class Categoria extends Controller
{

    public function vListar() 
    {
        $this->vista('Categoria/vListar');
    }

    public function vTabla()
    {
        $mCategoria=new mCategoria;
        $pagActual=$_POST['Tabla']['pagActual']; 
        $limit=$_POST['Tabla']['limit'];
        $busqueda=$_POST['Tabla']['busqueda'];
        if (empty($busqueda)) 
        {
            $numReg=$mCategoria->CountCategorias();
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $categorias=$mCategoria->GetList($offset, $limit);

            $fromPag = $offset + 1;
            $toPag = ($offset + $limit) < $numReg ? $offset + $limit : $numReg;
            $cantRegistros = "Mostrando del $fromPag al $toPag de $numReg";

            $data=['Categorias'=>$categorias,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual,
                    'cantRegistros' => $cantRegistros];
            $this->vista('Categoria/Component/Tabla', $data);
        }
        else
        {
            $numReg=$mCategoria->CountCategoriasSearch($busqueda);
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $categorias=$mCategoria->GetListSearch($offset,$limit,$busqueda);
            
            $fromPag = $offset + 1;
            $toPag = ($offset + $limit) < $numReg ? $offset + $limit : $numReg;
            $cantRegistros = "Mostrando del $fromPag al $toPag de $numReg";

            $data=['Categorias'=>$categorias,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual,
                    'cantRegistros' => $cantRegistros];
            $this->vista('Categoria/Component/Tabla', $data);
        }
    }

    public function vRegistrar()
    {
        $this->vista('Categoria/vRegistrar');
    }

    public function Ver($id) 
    {
        $mCategoria = new mCategoria;
        $data = $mCategoria->Ver($id);
        
        $this->vista('Categoria/Ver', $data);
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