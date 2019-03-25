<?php
class Producto extends Controller 
{
    public function Registrar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Producto']);    

        $producto=new Core\Producto;
        $producto->id_producto=1;
        $producto->descripcion=$validador->Validar('descripcion',['required','minlength,0','maxlength,50'],$_POST['Producto']);
        $producto->precio_unitario=$validador->Validar('precio_unitario',['required','minlength,0','maxlenght,11'],$_POST['Producto']);
        $producto->medida=$validador->Validar('medida',['required','minlength,0','maxlenght,10'],$_POST['Producto']);
        $producto->categoria=$validador->Validar('categoria',['required'],$_POST['Producto']);
        $producto->imagen=$validador->Validar('imagen',['required'],$_POST['Producto']);
        $producto->stock_minimo=$validador->Validar('stock_minimo',['required','minlength,0','maxlenght,10'],$_POST['Producto']);
        $producto->precio_compra=$validador->Validar('precio_compra',['required','minlength,0','maxlenght,11'],$_POST['Producto']);

        $resp['validate']=$validador->error;
        $resp['status']=($resp['status']&&$resp['validate']['status']);
        if ($validador->error['status']==true) {
            $mProducto=new mProducto;
            $mresp=$mProducto->Insertar($producto);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }
    public function vRegistrar()
    {
        $this->vista('Producto/vRegistrar');
    }

    public function Actualizar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Producto']);

        $producto=new Core\Producto;
        $producto->id_producto=$validador->Validar('id_producto',['required','maxlength,11'],$_POST['Producto']);
        $producto->descripcion=$validador->Validar('descripcion',['required','minlength,0','maxlength,50'],$_POST['Producto']);
        $producto->precio_unitario=$validador->Validar('precio_unitario',['required','minlength,0','maxlenght,11'],$_POST['Producto']);
        $producto->medida=$validador->Validar('medida',['required','minlength,0','maxlenght,10'],$_POST['Producto']);
        $producto->categoria=$validador->Validar('categoria',['required'],$_POST['Producto']);
        $producto->imagen=$validador->Validar('imagen',['required'],$_POST['Producto']);
        $producto->stock_minimo=$validador->Validar('stock_minimo',['required','minlength,0','maxlenght,10'],$_POST['Producto']);
        $producto->precio_compra=$validador->Validar('precio_compra',['required','minlength,0','maxlenght,11'],$_POST['Producto']);

        $resp['validate']=$validador->error;
        $resp['status']=$resp['status']&&$resp['validate']['status'];
        if ($validador->error['status']==true) 
        {
            $mProducto=new mCliente;
            $mResp=$mProducto->Actualizar($producto);
            $resp['db']=Validador::ValidarDB($mResp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }
}



?>