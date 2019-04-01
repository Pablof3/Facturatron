<?php
class Venta extends Controller 
{

    public function __construct() {
        $this->GuardSession();
    }
    // public function Registrar()
    // {
    //     $venta=new Core\Venta;
    //     $venta->id_venta=1;
    //     $venta->nro=1;
    //     $venta->fecha=date_create();
    //     $venta->usuario=$_SESSION["usuario"]["id_usuario"];
    //     $venta->cliente=$_POST['Venta']['cliente'];
    //     $venta->factura='';
    //     $venta->total=$_POST['Venta']['total'];
    //     foreach ($_POST['Venta']['VentaDetalle'] as $key => $ventaDetalle) {
    //         $VeDe=new Core\VentaDetalle;
    //         $VeDe->id_ventadetalle=1;
    //         $VeDe->venta=1;
    //         $VeDe->producto=$ventaDetalle['producto'];
    //         $VeDe->precio=$ventaDetalle['precio'];
    //         $VeDe->cantidad=$ventaDetalle['cantidad'];
    //         $VeDe->subtotal=$ventaDetalle['subtotal'];
    //         $venta->venta_detalles[]=$VeDe;
    //     }
    //     var_dump($venta);
    // }
    //Registrar
    public function Registrar()
    {
        
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Venta']);
        
        $productos = [];
        if(!isset($_SESSION["VentaDetalle"]) or empty($_SESSION["VentaDetalle"])) {
            $resp['status']=false;
            $resp['validador']['status']=false;
            $resp['validador']['error']["Productos"][]="Lista de Productos de la Venta Vacia";
        }

        foreach($_SESSION["VentaDetalle"] as $key => $producto) {
            $venta_detalle=new Core\VentaDetalle;
            $venta_detalle->producto = $producto["producto"];
            $venta_detalle->cantidad = $producto["cantidad"];
            $venta_detalle->precio = $producto["precio"];
            $venta_detalle->subtotal = $producto["precio"] * $producto["cantidad"];
      
            $productos[]  = $venta_detalle;
        }

        $venta=new Core\Venta;
        $venta->fecha=$validador->Validar('fecha',['required'],$_POST['Venta']);
        $venta->usuario=$_SESSION["usuario"]["id"];
        $venta->cliente=$validador->Validar('cliente',['required'],$_POST['Venta']);
        // $venta->factura= Respuesta de la Factura Generada;
        $venta->total=$validador->Validar('total',['required','minlength,0','maxlenght,11'],$_POST['Venta']);
        $venta->venta_detalles = $productos;

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
        $mCliente=new mCliente;
        $clientes=$mCliente->GetList();
        $data=['Clientes'=>$clientes];

        $this->vista('Venta/vRegistrar',$data);
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
            $mVenta=new mVenta;
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

    //Vista detalle
    public function vDetalle($id_venta)
    {
        $mVenta=new mVenta;
        $cliente = $mVenta->GetVenta($id_venta);
        $data=['Venta'=>$cliente];
        $this->vista('Venta/vDetalle', $data);
    }

    public function vDetalleRegistro()
    {
        $id=$_GET['id'];
        $mProducto=new mProducto;
        $productos=$mProducto->GetList();
        $data=['Productos'=>$productos,
                'id'=>$id];
        $this->vista('Venta/Component/DetalleRegistro',$data);
    }
}