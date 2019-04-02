<?php
class Factura extends Controller 
{

    public function __construct() {
        $this->GuardSession();
	}

	public function vRegistrar() {
		$data = [];
		if(isset($_SESSION["Venta"])) {
			$data = ["Venta" => unserialize($_SESSION["Venta"])];
		}

		return $this->vista("Factura/vRegistrar", $data);
	}

	public function NombreProducto($id) {
		$producto = new mProducto();
		return $producto->ObtenerNombre($id);
	}

	public function Registrar() {
		$resp['status']=true;
        $validador=new Validador();
        
        $productos = [];
        if(!isset($_SESSION["Venta"]->venta_detalles) or empty($_SESSION["Venta"]->venta_detalles)) {
            $resp['status']=false;
            $resp['validador']['status']=false;
            $resp['validador']['error']["Productos"][]="Lista de Productos de la Venta Vacia";
        }

        foreach(unserialize($_SESSION["Venta"]->venta_detalles) as $key => $producto) {
            $factura_detalle=new Core\FacturaDetalle;
			$factura_detalle->codigoProducto = "JN-131231";
			$factura_detalle->codigoProductoSin = 21431;
			$factura_detalle->actividadEconomica = 103020;
			$factura_detalle->descripcion = $this->NombreProducto($producto["producto"]);
            $factura_detalle->cantidad = $producto["cantidad"];
			$factura_detalle->precioUnitario = $producto["precio"];
			$factura_detalle->unidadMedida = "Unidad";
            $factura_detalle->subTotal = $producto["precio"] * $producto["cantidad"];
			
            $productos[]  = $factura_detalle;
        }

        //$validador->Trim($_POST['Venta']);

        $factura=new Core\Factura;
        
        $fecha_actual = new DateTime();
        $factura->fechaEmision = $fecha_actual->format('Y-m-d');
        $factura->usuario=$_SESSION["usuario"]["id_usuario"];
        // $factura->factura= Respuesta de la Factura Generada;
        $factura->montoTotal=$_POST["Factura[montoTotal]"];
        $factura->factura_detalles = $productos;

        $resp['validate']=$validador->error;
        $resp['status']=($resp['status']&&$resp['validate']['status']);
        if ($validador->error['status']==true) {
            $mFactura=new mFactura;
            $mresp=$mFactura->Insertar($factura);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }

        if($resp["status"]) {
            unset($_SESSION["Venta"]);
        }

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
        $cabecera->addChild('nombreRazonSocial', $_POST["nombreRazonSocial"]);
        $cabecera->addChild('codigoTipoDocumentoIdentidad', 1);
        $cabecera->addChild('numeroDocumento',$_POST["numeroDocumento"]);
        $cabecera->addChild('complemento')->addAttribute("xsi:nil", "true", "http://www.w3.org/2001/XMLSchema-instance");
        $cabecera->addChild('codigoCliente', $_POST["codigoCliente"]);
        $cabecera->addChild('codigoMetodoPago',1);
        $cabecera->addChild('numeroTarjeta')->addAttribute("xsi:nil", "true", "http://www.w3.org/2001/XMLSchema-instance");
        $cabecera->addChild('montoTotal', 25);
        $cabecera->addChild('montoDescuento')->addAttribute("xsi:nil", "true", "http://www.w3.org/2001/XMLSchema-instance");
        $cabecera->addChild('codigoMoneda', 689);
        $cabecera->addChild('tipoCambio',1);
        $cabecera->addChild('montoTotalMoneda', 25);
        $cabecera->addChild('leyenda', 'Ley N° 453: Tienes derecho a recibir información sobre las características y contenidos de los servicios que utilices.');
        $cabecera->addChild('usuario', 'pperez');
        $cabecera->addChild('codigoDocumentoSector', 1);

        foreach ($productos as $key => $producto) {
            $detalle = $xml->addChild('detalle');
            $detalle->addChild('actividadEconomica', $producto->actividadEconomica);
            $detalle->addChild('codigoProductoSin', $producto->codigoProductoSin);
            $detalle->addChild('codigoProducto', $producto->codigoProducto);
            $detalle->addChild('descripcion', $producto->descripcion);
            $detalle->addChild('cantidad', $producto->cantidad);
            $detalle->addChild('unidadMedida', $producto->unidadMedida);
            $detalle->addChild('precioUnitario', $producto->precioUnitario);
            $detalle->addChild('montoDescuento')->addAttribute("xsi:nil", "true", "http://www.w3.org/2001/XMLSchema-instance");
            $detalle->addChild('subTotal', $producto->subTotal);
            $detalle->addChild('numeroSerie')->addAttribute("xsi:nil", "true", "http://www.w3.org/2001/XMLSchema-instance");
        }

        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $dom->save('xml/venta'.$factura->fechaEmision.'.xml');

        echo json_encode($resp);
        
        //echo hash_file("md5", "xml/venta.xml");

        // $facturacion = new Facturacion;
        // echo $facturacion->bcdechex("0000123456789201901131637212580000222040000005000002");
        //159ffe6fb1986a24bb32dbe5a2a34214b245a6a3  dado
        //159FFE6FB1986A24BB32DBE5A2A34214B245A6A3 Esperado
	}

}
?>