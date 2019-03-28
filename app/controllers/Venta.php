<?php
class Venta extends Controller 
{

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

}