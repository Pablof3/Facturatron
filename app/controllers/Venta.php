<?php
class Venta extends Controller 
{

    //Registrar
    public function Registrar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Venta']);
        
        $venta=new Core\Venta;
        $venta->nro=$validador->Validar('nro',['required','minlength,0','maxlength,11'],$_POST['Venta']);
        $venta->fecha=$validador->Validar('fecha',['required'],$_POST['Venta']);
        $venta->usuario=$validador->Validar('usuario',['required','minlength,0','maxlenght,11'],$_POST['Venta']);
        $venta->cliente=$validador->Validar('cliente',['required','minlength,0','maxlenght,11'],$_POST['Venta']);
        $venta->factura=$validador->Validar('factura',['required','minlength,0','maxlenght,11'],$_POST['Venta']);
        $venta->total=$validador->Validar('total',['required','minlength,0','maxlenght,11'],$_POST['Venta']);

        $resp['validate']=$validador->error;
        $resp['status']=($resp['status']&&$resp['validate']['status']);
        if ($validador->error['status']==true) {
            $mVenta=new mVenta;
            $mresp=$mVenta->Insertar($venta);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }

    //Vista registrar
    public function vRegistrar()
    {
        $this->vista('Venta/vRegistrar');
    }


    //Actualizar
    public function Actualizar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Venta']);

        $venta=new Core\Venta;
        $venta->id_venta=$validador->Validar('id_venta',['required','maxlength,11'],$_POST['Venta']);
        $venta->nro=$validador->Validar('nro',['required','maxlength,11'],$_POST['Venta']);
        $venta->fecha=$validador->Validar('fecha',['required'],$_POST['Venta']);
        $venta->usuario=$validador->Validar('usuario',['required','minlength,0','maxlenght,11'],$_POST['Venta']);
        $venta->cliente=$validador->Validar('cliente',['required','minlength,0','maxlenght,11'],$_POST['Venta']);
        $venta->factura=$validador->Validar('factura',['required','minlength,0','maxlenght,11'],$_POST['Venta']);
        $venta->total=$validador->Validar('total',['required','minlength,0','maxlenght,11'],$_POST['Venta']);

        $resp['validate']=$validador->error;
        $resp['status']=$resp['status']&&$resp['validate']['status'];
        if ($validador->error['status']==true) 
        {
            $mVenta=new mVenta;
            $mResp=$mVenta->Actualizar($venta);
            $resp['db']=Validador::ValidarDB($mResp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }

    //Vista Actualizar
    public function vActualizar($id_venta)
    {
        $mVenta=new mVenta;
        $venta=$mVenta->GetVenta($id_venta);
        $data=['Venta'=>$venta];
        $this->vista('Venta/vActualizar', $data);
    }

    //Eliminar
    public function Eliminar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Venta']);

        $venta=new Core\Venta;
        $venta->id_venta=$validador->Validar('id_venta',['required', 'maxlength,11'],$_POST['Venta']);
        $resp['validate']=$validador->error;
        $resp['status']=$resp['status']&&$resp['validate']['status'];
        if ($validador->error['status']==true) {
            $mVenta=new mCliente;
            $mResp=$mVenta->Eliminar($venta->id_venta);
            $resp['db']=Validador::ValidarDB($mResp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }

    //Vista ELiminar
    public function vEliminar($id_venta)
    {
        $mVenta=new mVenta;
        $venta = $mVenta->GetVenta($id_venta);
        $data=['Venta'=>$venta];
        $this->vista('Venta/vEliminar', $data);
    }

    public function vLista()
    {
        $this->vista('Venta/vListar');
    }

    public function vTabla()
    {
        $mVenta=new mVenta;
        $pagActual=$_POST['Tabla']['pagActual']; 
        $limit=$_POST['Tabla']['limit'];
        $busqueda=$_POST['Tabla']['busqueda'];
        if (empty($busqueda)) 
        {
            $numReg=$mVenta->CountVentas();
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $ventas=$mVenta->GetList($offset, $limit);
            $data=['Ventas'=>$ventas,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual];
            $this->vista('Venta/Component/Tabla', $data);
        }
        else
        {
            $numReg=$mVenta->CountVentasSearch($busqueda);
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $ventas=$mVenta->GetListSearch($offset,$limit,$busqueda);
            $data=['Venta'=>$ventas,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual];
            $this->vista('Venta/Component/Tabla', $data);
        }
    }

}