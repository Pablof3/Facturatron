<?php
class Proveedor extends Controller
{
    public function __construct() {
        $this->GuardSession();
    }

    public function vListar() 
    {
        $this->vista('Proveedor/vListar');
    }

    public function vTabla()
    {
        $mProveedor=new mProveedor;
        $pagActual=$_POST['Tabla']['pagActual']; 
        $limit=$_POST['Tabla']['limit'];
        $busqueda=$_POST['Tabla']['busqueda'];
        if (empty($busqueda)) 
        {
            $numReg=$mProveedor->CountProveedores();
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $proveedores=$mProveedor->GetList($offset, $limit);

            $fromPag = $offset + 1;
            $toPag = ($offset + $limit) < $numReg ? $offset + $limit : $numReg;
            $cantRegistros = "Mostrando del $fromPag al $toPag de $numReg";

            $data=['Proveedores'=>$proveedores,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual,
                    'cantRegistros' => $cantRegistros];
            $this->vista('Proveedor/Component/Tabla', $data);
        }
        else
        {
            $numReg=$mProveedor->CountProveedoresSearch($busqueda);
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $proveedores=$mProveedor->GetListSearch($offset,$limit,$busqueda);
            
            $fromPag = $offset + 1;
            $toPag = ($offset + $limit) < $numReg ? $offset + $limit : $numReg;
            $cantRegistros = "Mostrando del $fromPag al $toPag de $numReg";

            $data=['Proveedores'=>$proveedores,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual,
                    'cantRegistros' => $cantRegistros];
            $this->vista('Proveedor/Component/Tabla', $data);
        }
    }

    public function Ver($id) 
    {
        $mProveedor = new mProveedor;
        $data = $mProveedor->Ver($id);
        
        $this->vista('Proveedor/Ver', $data);
    }

    public function vRegistrar()
    {
        $this->vista('Proveedor/vRegistrar');
    }

    public function Registrar() {
        $resp['status']=true;
        $validador = new Validador();
        $validador->Trim($_POST["Proveedor"]);

        $proveedor=new Core\Proveedor;
        $proveedor->nombre = $validador->Validar('nombre', ["required", "maxlength, 40"], $_POST["Proveedor"]);
        $proveedor->telefono = $validador->Validar('telefono', ["required", "maxlength, 10"], $_POST["Proveedor"]);        
        $proveedor->direccion = $validador->Validar('direccion', ["required", "maxlength, 55"], $_POST["Proveedor"]);        

        $resp['validate']=$validador->error;
        $resp['status']=$resp['validate']['status'];        
        if ($validador->error['status']==true) {
            $mProveedor=new mProveedor;
            $mresp=$mProveedor->Insertar($proveedor);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);                                        
    }

    public function vModificar($id) 
    {
        $mProveedor = new mProveedor;
        $data = $mProveedor->Ver($id);
        
        $this->vista('Proveedor/vModificar', $data);
    }

    public function Modificar() {
        $resp['status']=true;
        $validador = new Validador();
        $validador->Trim($_POST["Proveedor"]);
        $proveedor=new Core\Proveedor;
        $proveedor->id_proveedor = $validador->Validar('id_proveedor', ["required"], $_POST["Proveedor"]);
        $proveedor->nombre = $validador->Validar('nombre', ["required", "maxlength, 40"], $_POST["Proveedor"]);
        $proveedor->telefono = $validador->Validar('telefono', ["required", "maxlength, 10"], $_POST["Proveedor"]);        
        $proveedor->direccion = $validador->Validar('direccion', ["required", "maxlength, 55"], $_POST["Proveedor"]);        

        $resp['validate']=$validador->error;
        $resp['status']=$resp['validate']['status'];        
        if ($validador->error['status']==true) {
            $mProveedor=new mProveedor;
            $mresp=$mProveedor->Actualizar($proveedor);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);                                        
    }

    public function vEliminar($id)
    {
        $mProveedor = new mProveedor;
        $data = $mProveedor->Ver($id);

        $this->vista('Proveedor/vEliminar', $data);
    }

    public function Eliminar() {
        $resp['status']=true;
        $validador = new Validador();
        $validador->Trim($_POST["Proveedor"]);
        $proveedor=new Core\Proveedor;
        $proveedor->id_proveedor = $validador->Validar('id_proveedor', ["required"], $_POST["Proveedor"]);

        $resp['validate']=$validador->error;
        $resp['status']=$resp['validate']['status'];        
        if ($validador->error['status']==true) {
            $mProveedor=new mProveedor;
            $mresp=$mProveedor->Eliminar($proveedor->id_proveedor);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);   
    }
}

?>