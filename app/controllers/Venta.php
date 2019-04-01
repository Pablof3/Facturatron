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
        
        $productos = [];
        if(!isset($_POST["Venta"]["VentaDetalle"]) or empty($_POST["Venta"]["VentaDetalle"])) {
            $resp['status']=false;
            $resp['validador']['status']=false;
            $resp['validador']['error']["Productos"][]="Lista de Productos de la Venta Vacia";
        }

        foreach($_POST["Venta"]["VentaDetalle"] as $key => $producto) {
            $venta_detalle=new Core\VentaDetalle;
            $venta_detalle->producto = $producto["producto"];
            $venta_detalle->cantidad = $producto["cantidad"];
            $venta_detalle->precio = $producto["precio"];
            $venta_detalle->subtotal = $producto["precio"] * $producto["cantidad"];
      
            $productos[]  = $venta_detalle;
        }

        //$validador->Trim($_POST['Venta']);

        $venta=new Core\Venta;
        
        $fecha_actual = new DateTime();
        $venta->fecha = $fecha_actual->format('Y-m-d');
        $venta->usuario=$_SESSION["usuario"]["id_usuario"];
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


    public function Prueba() {

        // $facturacion = new Facturacion();

        // echo $facturacion->calculaDigitoMod11("000012345678920190113163721239000021104000000040000", 1, 9, false);

        
        $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\"?>
        <facturaComputarizadaEstandar 
        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" 
        xsi:noNamespaceSchemaLocation=\"facturaComputarizadaEstandar.xsd\">
        </facturaComputarizadaEstandar>");

    
        $cabecera = $xml->addChild('cabecera');
        $cabecera->addChild('nitEmisor', 456489012);
        $cabecera->addChild('numeroFactura', 66);
        $cabecera->addChild('cuf', 'a812312f1223892b');
        $cabecera->addChild('cufd', 'dae91da3e083d42a3da456665b8cad2e');
        $cabecera->addChild('codigoSucursal', 2);
        $cabecera->addChild('direccion', 'Calle Juan Pablo II #54');
        $cabecera->addChild('codigoPuntoVenta')->addAttribute("xsi:nil", "true", "http://www.w3.org/2001/XMLSchema-instance");
        $cabecera->addChild('fechaEmision', '2019-02-13T08:32:12');
        $cabecera->addChild('nombreRazonSocial', 'Pablo Mamani');
        $cabecera->addChild('codigoTipoDocumentoIdentidad', 1);
        $cabecera->addChild('numeroDocumento',1548971);
        $cabecera->addChild('complemento')->addAttribute("xsi:nil", "true", "http://www.w3.org/2001/XMLSchema-instance");
        $cabecera->addChild('codigoCliente', 'PMamani');
        $cabecera->addChild('codigoMetodoPago',2);
        $cabecera->addChild('numeroTarjeta', 4651608789011556);
        $cabecera->addChild('montoTotal', 25);
        $cabecera->addChild('montoDescuento')->addAttribute("xsi:nil", "true", "http://www.w3.org/2001/XMLSchema-instance");
        $cabecera->addChild('codigoMoneda', 689);
        $cabecera->addChild('tipoCambio',1);
        $cabecera->addChild('montoTotalMoneda', 25);
        $cabecera->addChild('leyenda', 'Ley N° 453: Tienes derecho a recibir información sobre las características y contenidos de los servicios que utilices.');
        $cabecera->addChild('usuario', 'pperez');
        $cabecera->addChild('codigoDocumentoSector', 1);

        $detalle = $xml->addChild('detalle');
        $detalle->addChild('actividadEconomica', 103020);
        $detalle->addChild('codigoProductoSin', 21431);
        $detalle->addChild('codigoProducto', 'JN-131231');
        $detalle->addChild('descripcion', 'JUGO DE NARANJA EN VASO');
        $detalle->addChild('cantidad', 10);
        $detalle->addChild('unidadMedida', 'VASO');
        $detalle->addChild('precioUnitario', 2.5);
        $detalle->addChild('montoDescuento')->addAttribute("xsi:nil", "true", "http://www.w3.org/2001/XMLSchema-instance");
        $detalle->addChild('subTotal', 25);
        $detalle->addChild('numeroSerie')->addAttribute("xsi:nil", "true", "http://www.w3.org/2001/XMLSchema-instance");

        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $dom->save('xml/venta.xml');

        //echo hash_file("md5", "xml/venta.xml");

        $facturacion = new Facturacion;
        echo $facturacion->bcdechex("0000123456789201901131637212580000222040000005000002");
        //159ffe6fb1986a24bb32dbe5a2a34214b245a6a3  dado
        //159FFE6FB1986A24BB32DBE5A2A34214B245A6A3 Esperado
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

?>