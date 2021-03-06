<?php
class Cliente extends Controller 
{
    public function __construct() {
        $this->GuardSession();
    }

    public function Registrar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Cliente']);
        
        $cliente=new Core\Cliente;
        $cliente->nombre=$validador->Validar('nombre',['required','minlength,0','maxlength,25'],$_POST['Cliente']);
        $cliente->apellidos=$validador->Validar('apellidos',['required','minlength,0','maxlength,35'],$_POST['Cliente']);
        $cliente->razon=$validador->Validar('razon',['required','minlength,0','maxlenght,20'],$_POST['Cliente']);
        $cliente->nit=$validador->Validar('nit',['required','minlength,0','maxlenght,10'],$_POST['Cliente']);

        $resp['validate']=$validador->error;
        $resp['status']=($resp['status']&&$resp['validate']['status']);
        if ($validador->error['status']==true) {
            $mCliente=new mCliente;
            $mresp=$mCliente->Insertar($cliente);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }
    public function vRegistrar()
    {
        $this->vista('Cliente/vRegistrar');
    }
    public function vDetalle($id_cliente)
    {
        $mCliente=new mCliente;
        $cliente = $mCliente->GetCliente($id_cliente);
        $data=['Cliente'=>$cliente];
        $this->vista('Cliente/vDetalle', $data);
    }
    public function Actualizar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Cliente']);

        $cliente=new Core\Cliente;
        $cliente->id_cliente=$validador->Validar('id_cliente',['required','maxlength,11'],$_POST['Cliente']);
        $cliente->nombre=$validador->Validar('nombre',['required','maxlength,25'],$_POST['Cliente']);
        $cliente->apellidos=$validador->Validar('apellidos',['required','maxlength,35'],$_POST['Cliente']);
        $cliente->razon=$validador->Validar('razon',['required','maxlenght,20'],$_POST['Cliente']);
        $cliente->nit=$validador->Validar('nit',['maxlenght,10'],$_POST['Cliente']);

        $resp['validate']=$validador->error;
        $resp['status']=$resp['status']&&$resp['validate']['status'];
        if ($validador->error['status']==true) 
        {
            $mCliente=new mCliente;
            $mResp=$mCliente->Actualizar($cliente);
            $resp['db']=Validador::ValidarDB($mResp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }
    public function vActualizar($id_cliente)
    {
        $mCliente=new mCliente;
        $cliente=$mCliente->GetCliente($id_cliente);
        $data=['Cliente'=>$cliente];
        $this->vista('Cliente/vActualizar', $data);
    }
    public function Eliminar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Cliente']);

        $cliente=new Core\Cliente;
        $cliente->id_cliente=$validador->Validar('id_cliente',['required', 'maxlength,11'],$_POST['Cliente']);
        $resp['validate']=$validador->error;
        $resp['status']=$resp['status']&&$resp['validate']['status'];
        if ($validador->error['status']==true) {
            $mCliente=new mCliente;
            $mResp=$mCliente->Eliminar($cliente->id_cliente);
            $resp['db']=Validador::ValidarDB($mResp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }
    public function vEliminar($id_cliente)
    {
        $mCliente=new mCliente;
        $cliente = $mCliente->GetCliente($id_cliente);
        $data=['Cliente'=>$cliente];
        $this->vista('Cliente/vEliminar', $data);
    }

    public function vLista()
    {
        $this->vista('Cliente/vListar');
    }

    public function vTabla()
    {
        $mCliente=new mCliente;
        $pagActual=$_POST['Tabla']['pagActual']; 
        $limit=$_POST['Tabla']['limit'];
        $busqueda=$_POST['Tabla']['busqueda'];
        if (empty($busqueda)) 
        {
            $numReg=$mCliente->CountClientes();
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $clientes=$mCliente->GetList($offset, $limit);
            $data=['Clientes'=>$clientes,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual];
            $this->vista('Cliente/Component/Tabla', $data);
        }
        else
        {
            $numReg=$mCliente->CountClientesSearch($busqueda);
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $clientes=$mCliente->GetListSearch($offset,$limit,$busqueda);
            $data=['Clientes'=>$clientes,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual];
            $this->vista('Cliente/Component/Tabla', $data);
        }
    }


    public function GetRazonSocial() {
        $nit = $_GET["nit"];
        $resp['status'] = true;
        $mCliente = new mCliente;

        $resp['razonSocial'] = $mCliente->GetRazonSocial($nit);

        if($resp['razonSocial']) {
            $resp['status'] = true;
        } else {
            $resp['status']= false;
            $reso['razonSocial'] = "";
        }

        echo json_encode($resp); 
    }
}

?>