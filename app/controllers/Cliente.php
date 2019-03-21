<?php
class Cliente extends Controller 
{
    public function Registrar()
    {
        
        $clienteP=['id_cliente'=>1, 'nombre'=>'PedroPedroPedroPedroPedroPedro', 'razon'=>' ', 'nit'=>'987652315'];
        var_dump($clienteP);

        $validador=new Validador();
        $validador->Trim($clienteP);
        $cliente=new Core\Cliente;
        $cliente->id_cliente=1;
        $cliente->nombre=$validador->Validar('nombre',['required','minlength,0','maxlength,25'],$clienteP);
        $cliente->apellidos=$validador->Validar('apellidos',['required','minlength,0','maxlength,35'],$clienteP);
        $cliente->razon=$validador->Validar('razon',['required','minlength,0','maxlenght,20'],$clienteP);
        $cliente->nit=$validador->Validar('nit',['required','minlength,0','maxlenght,10'],$clienteP);

        var_dump($cliente);
        var_dump($validador->error);
    }
    public function vRegistrar()
    {
        $this->vista('Cliente/vRegistrar');
    }
}

?>