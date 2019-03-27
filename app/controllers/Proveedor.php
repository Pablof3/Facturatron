<?php
class Proveedor extends Controller
{

    public function vListar($offset = 0, $limit = 10) 
    {
        $mProveedor = new mProveedor;
        $data = $mProveedor->Listar($offset, $limit);

        $this->vista('Proveedor/vListar', $data);
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