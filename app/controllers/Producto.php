<?php
class Producto extends Controller 
{
    public function Registrar()
    {
        
        $productoP=['id_producto'=>1, 'descripcion'=>'Tinta negra epson 3xss', 'precio_unitario'=>'99.6', 'medida'=>'1L', 'categoria'=>'Chapi', 
                    'imagen'=>'', 'stock_minimo'=>'10', 'precio_compra'=>'50'];
        var_dump($ProductoP);

        $validador=new Validador();
        $validador->Trim($productoP);
        $producto=new Core\Producto;
        $producto->id_producto=1;
        $producto->descripcion=$validador->Validar('descripcion',['required','minlength,0','maxlength,50'],$productoP);
        $producto->precio_unitario=$validador->Validar('precio_unitario',['required'],$productoP);
        $producto->medida=$validador->Validar('medida',['required','minlength,0','maxlenght,10'],$productoP);
        $producto->categoria=$validador->Validar('categoria',['required'],$productoP);
        $producto->imagen=$validador->Validar('imagen',['required'],$productoP);
        $producto->stock_minimo=$validador->Validar('stock_minimo',['required','minlength,0','maxlenght,10'],$productoP);
        $producto->precio_compra=$validador->Validar('precio_compra',['required'],$productoP);


        var_dump($producto);
        var_dump($validador->error);
    }
    public function vRegistrar()
    {
        $this->vista('Producto/vRegistrar');
    }
}

?>