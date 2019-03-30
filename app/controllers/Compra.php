<?php
class Compra extends Controller 
{

    public function __construct() {
        $this->GuardSession();
    }

    //Registrar
    public function Registrar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Compra']);
        
        $productos = [];
        if(!isset($_SESSION["CompraDetalle"]) or empty($_SESSION["CompraDetalle"])) {
            $resp['status']=false;
            $resp['validador']['status']=false;
            $resp['validador']['error']["Productos"][]="Lista de Productos de la Compra Vacia";
        }

        foreach($_SESSION["CompraDetalle"] as $key => $producto) {
            $compra_detalle=new Core\CompraDetalle;
            $compra_detalle->producto = $producto["producto"];
            $compra_detalle->cantidad = $producto["cantidad"];
            $compra_detalle->precio = $producto["precio"];
            $compra_detalle->subtotal = $producto["precio"] * $producto["cantidad"];
      
            $productos[]  = $compra_detalle;
        }

        $compra=new Core\Compra;
        $compra->fecha=$validador->Validar('fecha',['required'],$_POST['Compra']);
        $compra->usuario=$_SESSION["usuario"]["id"];
        $compra->proveedor=$validador->Validar('proveedor',['required'],$_POST['Compra']);
        $compra->total=$validador->Validar('total',['required','minlength,0','maxlenght,11'],$_POST['Compra']);
        $compra->compra_detalles = $productos;

        $resp['validate']=$validador->error;
        $resp['status']=($resp['status']&&$resp['validate']['status']);
        if ($validador->error['status']==true) {
            $mCompra=new mVenta;
            $mresp=$mCompra->Insertar($compra);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }

    //Vista registrar
    public function vRegistrar()
    {
        $this->vista('Compra/vRegistrar');
    }

    public function vLista()
    {
        $this->vista('Compra/vListar');
    }

    public function vTabla()
    {
        $mCompra=new mCompra;
        $pagActual=$_POST['Tabla']['pagActual']; 
        $limit=$_POST['Tabla']['limit'];
        $busqueda=$_POST['Tabla']['busqueda'];
        if (empty($busqueda)) 
        {
            $numReg=$mVenta->CountVentas();
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $compras=$mVenta->GetList($offset, $limit);
            $data=['Compras'=>$compras,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual];
            $this->vista('Compra/Component/Tabla', $data);
        }
        else
        {
            $numReg=$mVenta->CountComprasSearch($busqueda);
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $ventas=$mVenta->GetListSearch($offset,$limit,$busqueda);
            $data=['Compra'=>$compras,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual];
            $this->vista('Compra/Component/Tabla', $data);
        }
    }

    //Vista detalle
    public function vDetalle($id_compra)
    {
        $mCompra=new mCompra;
        $cliente = $mCompra->GetCompra($id_compra);
        $data=['Compra'=>$proveedor];
        $this->vista('Compra/vDetalle', $data);
    }

}