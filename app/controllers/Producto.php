<?php
class Producto extends Controller 
{
    public function Registrar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Producto']);    

        $producto=new Core\Producto;
        $producto->descripcion=$validador->Validar('descripcion',['required','minlength,0','maxlength,50'],$_POST['Producto']);
        $producto->precio_unitario=$validador->Validar('precio_unitario',['required','minlength,0','maxlenght,11'],$_POST['Producto']);
        $producto->medida=$validador->Validar('medida',['required','minlength,0','maxlenght,10'],$_POST['Producto']);
        $producto->categoria=$validador->Validar('categoria',['required'],$_POST['Producto']);
        $producto->stock_minimo=$validador->Validar('stock_minimo',['required'],$_POST['Producto']);
        $producto->precio_compra=$validador->Validar('precio_compra',['required','minlength,0','maxlenght,11'],$_POST['Producto']);
        
        $resp['validate']=$validador->error;
        $resp['status']=($resp['status']&&$resp['validate']['status']);
        
        if ($validador->error['status']==true) {

            //Subida de Imagenes
            if($_FILES["imagen"]["error"] == 0) {
                $fecha_actual = new DateTime();
				$origenImg = $_FILES["imagen"]["tmp_name"];
				$extImg = explode(".", $_FILES["imagen"]["name"]);
				$destinoImg = "img/productos/".rand(1,999).$fecha_actual->getTimestamp().rand(1,999).".".$extImg[1];
				if(move_uploaded_file($origenImg, $destinoImg)) {
					$producto->imagen = $destinoImg;
				} else {
					$producto->imagen = NULL;
				}
            }

            $mProducto=new mProducto;
            $mresp=$mProducto->Insertar($producto);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }
    public function vRegistrar()
    {
        $mCategoria = new mCategoria;
        $data = $mCategoria->GetList();

        $this->vista('Producto/vRegistrar', $data);
    }

    public function Actualizar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Producto']);

        $producto=new Core\Producto;
        $producto->id_producto=$validador->Validar('id_producto',['required'],$_POST['Producto']);
        $producto->descripcion=$validador->Validar('descripcion',['required','minlength,0','maxlength,50'],$_POST['Producto']);
        $producto->precio_unitario=$validador->Validar('precio_unitario',['required','minlength,0','maxlenght,11'],$_POST['Producto']);
        $producto->medida=$validador->Validar('medida',['required','minlength,0','maxlenght,10'],$_POST['Producto']);
        $producto->categoria=$validador->Validar('categoria',['required'],$_POST['Producto']);
        $producto->stock_minimo=$validador->Validar('stock_minimo',['required'],$_POST['Producto']);
        $producto->precio_compra=$validador->Validar('precio_compra',['required','minlength,0','maxlenght,11'],$_POST['Producto']);

        $resp['validate']=$validador->error;
        $resp['status']=$resp['status']&&$resp['validate']['status'];
        if ($validador->error['status']==true) 
        {
            $mProducto=new mProducto;

            $imagen_anterior = $mProducto->ImagenPrevia($producto->id_producto);
            //Subida de Imagenes
            if($_FILES["imagen"]["error"] == 0) {
                if($imagen_anterior != NULL) {
                    unlink($imagen_anterior);
                }
                
                $fecha_actual = new DateTime();
				$origenImg = $_FILES["imagen"]["tmp_name"];
				$extImg = explode(".", $_FILES["imagen"]["name"]);
				$destinoImg = "img/productos/".rand(1,999).$fecha_actual->getTimestamp().rand(1,999).".".$extImg[1];
				if(move_uploaded_file($origenImg, $destinoImg)) {
                    $producto->imagen = $destinoImg;
				} else {
                    $producto->imagen = NULL;
				}
            } else {
                $producto->imagen = $imagen_anterior;
            }

            $mResp=$mProducto->Actualizar($producto);
            $resp['db']=Validador::ValidarDB($mResp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }

    
    public function vActualizar($id_producto)
    {
        $mCategoria = new mCategoria;
        $categorias = $mCategoria->GetList();
        $mProducto=new mProducto;
        $producto=$mProducto->GetProducto($id_producto);
        $data =['Producto'=>$producto, 
                'Categorias'=>$categorias];
        $this->vista('Producto/vActualizar', $data);
    }
    public function Eliminar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Producto']);

        $producto=new Core\Producto;
        $producto->id_producto=$validador->Validar('id_producto',['required'],$_POST['Producto']);
        $resp['validate']=$validador->error;
        $resp['status']=$resp['status']&&$resp['validate']['status'];
        if ($validador->error['status']==true) {
            $mProducto=new mProducto;
            $mResp=$mProducto->Eliminar($producto->id_producto);           
            $resp['db']=Validador::ValidarDB($mResp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }

    public function vEliminar($id_producto)
    {
        $mCategoria = new mCategoria;
        $categorias = $mCategoria->GetList();
        $mProducto=new mProducto;
        $producto=$mProducto->GetProducto($id_producto);
        $data =['Producto'=>$producto, 
                'Categorias'=>$categorias];
        $this->vista('Producto/vEliminar', $data);
    }

    public function vLista()
    {
        $this->vista('Producto/vListar');
    }

    public function vTabla()
    {
        $mProducto=new mProducto;
        $pagActual=$_POST['Tabla']['pagActual']; 
        $limit=$_POST['Tabla']['limit'];
        $busqueda=$_POST['Tabla']['busqueda'];
        if (empty($busqueda)) 
        {
            $numReg=$mProducto->CountProductos();
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $productos=$mProducto->GetList($offset, $limit);

            $fromPag = $offset + 1;
            $toPag = ($offset + $limit) < $numReg ? $offset + $limit : $numReg;
            $cantRegistros = "Mostrando del $fromPag al $toPag de $numReg";

            $data=['Productos'=>$productos,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual,
                    'cantRegistros' => $cantRegistros];
            $this->vista('Producto/Component/Tabla', $data);
        }
        else
        {
            $numReg=$mProducto->CountProductosSearch($busqueda);
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $productos=$mProducto->GetListSearch($offset,$limit,$busqueda);

            $fromPag = $offset + 1;
            $toPag = ($offset + $limit) < $numReg ? $offset + $limit : $numReg;
            $cantRegistros = "Mostrando del $fromPag al $toPag de $numReg";

            $data=['Productos'=>$productos,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual,
                    'cantRegistros' => $cantRegistros];
            $this->vista('Producto/Component/Tabla', $data);
        }
    }

    public function vDetalle($id_producto)
    {
        $mCategoria = new mCategoria;
        $categorias = $mCategoria->GetList();
        $mProducto=new mProducto;
        $producto=$mProducto->GetProducto($id_producto);
        $data =['Producto'=>$producto, 
                'Categorias'=>$categorias];
        $this->vista('Producto/vDetalle', $data);
    }

}


?>