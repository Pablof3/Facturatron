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
        
        $productos = [];
        if(!isset($_POST["Compra"]["CompraDetalle"]) or empty($_POST["Compra"]["CompraDetalle"])) {
            $resp['status']=false;
            $resp['validador']['status']=false;
            $resp['validador']['error']["Productos"][]="Lista de Productos de la Compra Vacia";
        }

        foreach($_POST["Compra"]["CompraDetalle"] as $key => $producto) {
            $compra_detalle=new Core\CompraDetalle;
            $compra_detalle->producto = $producto["producto"];
            $compra_detalle->cantidad = $producto["cantidad"];
            $compra_detalle->precio = $producto["precio"];
            $compra_detalle->subtotal = $producto["precio"] * $producto["cantidad"];
      
            $productos[]  = $compra_detalle;
        }

        $compra=new Core\Compra;
        $fecha_actual = new DateTime();
        $compra->fecha = $fecha_actual->format('Y-m-d');
        $compra->usuario=$_SESSION["usuario"]["id_usuario"];
        $compra->proveedor=$validador->Validar('proveedor',['required'],$_POST['Compra']);
        $compra->total=$validador->Validar('total',['required','minlength,0','maxlenght,11'],$_POST['Compra']);
        $compra->compra_detalles = $productos;

        $resp['validate']=$validador->error;
        $resp['status']=($resp['status']&&$resp['validate']['status']);
        if ($validador->error['status']==true) {
            $mCompra=new mCompra;
            $mresp=$mCompra->Insertar($compra);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }

    //Vista registrar
    public function vRegistrar()
    {
        $mProvedor=new mProveedor;
        $proveedores=$mProvedor->GetList();
        $data=['Proveedores'=>$proveedores];
        $this->vista('Compra/vRegistrar', $data);
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
            $numReg=$mCompra->CountCompras();
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $compras=$mCompra->GetList($offset, $limit);

            $fromPag = $offset + 1;
            $toPag = ($offset + $limit) < $numReg ? $offset + $limit : $numReg;
            $cantRegistros = "Mostrando del $fromPag al $toPag de $numReg";

            $data=['Compras'=>$compras,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual,
                    'cantRegistros'=>$cantRegistros];
            $this->vista('Compra/Component/Tabla', $data);
        }
        else
        {
            $numReg=$mCompra->CountComprasSearch($busqueda);
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $ventas=$mCompra->GetListSearch($offset,$limit,$busqueda);

            $fromPag = $offset + 1;
            $toPag = ($offset + $limit) < $numReg ? $offset + $limit : $numReg;
            $cantRegistros = "Mostrando del $fromPag al $toPag de $numReg";

            $data=['Compras'=>$compras,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual,
                    'cantRegistros'=>$cantRegistros];
            $this->vista('Compra/Component/Tabla', $data);
        }
    }

    //Vista detalle
    public function vDetalle($id_compra)
    {
        $mCompra=new mCompra;
        $mCompraDetalle=new mCompraDetalle;
        $compra = $mCompra->GetCompra($id_compra);

        $compra->compra_detalles = $mCompraDetalle->Listar($compra->id_compra);

        $data=['Compra'=>$compra];
        $this->vista('Compra/vDetalle', $data);
    }

    public function vDetalleRegistro()
    {
        $id=$_GET['id'];
        $mProducto=new mProducto;
        $productos=$mProducto->GetList();
        $data=['Productos'=>$productos,
                'id'=>$id];
        $this->vista('Compra/Component/DetalleRegistro',$data);
    }
    
}