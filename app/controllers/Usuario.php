<?php
class Usuario extends Controller 
{
    
    public function Registrar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Usuario']);
        
       $usuario=new Core\Usuario;
       $usuario->id_usuario=1;
       $usuario->usuario=$validador->Validar('usuario',['required','maxlength,25'],$_POST['Usuario']);
       $usuario->password=$validador->Validar('password',['required','maxlength,50'],$_POST['Usuario']);
       $usuario->ci=$validador->Validar('ci',['required','maxlength,15'],$_POST['Usuario']);
       $usuario->nombre=$validador->Validar('nombre',['required','maxlength,35'],$_POST['Usuario']);
       $usuario->nombre=$validador->Validar('apellidos',['required','maxlength,45'],$_POST['Usuario']);
       $usuario->nombre=$validador->Validar('esAdmin',['required'],$_POST['Usuario']);

        $resp['validate']=$validador->error;
        $resp['status']=($resp['status']&&$resp['validate']['status']);
        if ($validador->error['status']==true) {
            $mUsuario=new mUsuario;
            $mresp=$mUsuario->Insertar($usuario);
            $resp['db']=Validador::ValidarDB($mresp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }
    public function vRegistrar()
    {
        $this->vista('Usuario/vRegistrar');
    }
    public function vDetalle($id_usuario)
    {
        $mUsuario=new mUsuario;
        $usuario=$mUsuario->GetUsuario($id_usuario);
        $data=['Usuario'=>$usuario];
        $this->vista('Usuario/vDetalle', $data);
    }
    public function Actualizar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Usuario']);

        $usuario=new Core\Usuario;
        $usuario->id_usuario=$validador->Validar('id_usuario',['required','maxlength,11'],$_POST['Usuario']);
        $usuario->usuario=$validador->Validar('usuario',['required','maxlength,25'],$_POST['Usuario']);
        $usuario->password=$validador->Validar('password',['required','maxlength,50'],$_POST['Usuario']);
        $usuario->ci=$validador->Validar('ci',['required','maxlength,15'],$_POST['Usuario']);
        $usuario->nombre=$validador->Validar('nombre',['required','maxlength,35'],$_POST['Usuario']);
        $usuario->nombre=$validador->Validar('apellidos',['required','maxlength,45'],$_POST['Usuario']);
        $usuario->nombre=$validador->Validar('esAdmin',['required'],$_POST['Usuario']);

        $resp['validate']=$validador->error;
        $resp['status']=$resp['status']&&$resp['validate']['status'];
        if ($validador->error['status']==true) 
        {
            $mUsuario=new mUsuario;
            $mResp=$mUsuario->Actualizar($usuario);
            $resp['db']=Validador::ValidarDB($mResp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }
    public function vActualizar($id_usuario)
    {
        $mUsuario=new mUsuario;
        $usuario=$mUsuario->getUsuario($id_usuario);
        $data=['Usuario'=>$usuario];
        $this->vista('Usuario/vActualizar', $data);
    }
    public function Eliminar()
    {
        $resp['status']=true;
        $validador=new Validador();
        $validador->Trim($_POST['Usuario']);

        $usuario=new Core\Usuario;
        $usuario->id_usuario=$validador->Validar('id_usaurio',['required', 'maxlength,11'],$_POST['Usuario']);

        $resp['validate']=$validador->error;
        $resp['status']=$resp['status']&&$resp['validate']['status'];
        if ($validador->error['status']==true) {
            $mUsuario=new mUsuario;
            $mResp=$mUsuario->Eliminar($usuario->id_usuario);
            $resp['db']=Validador::ValidarDB($mResp);
            $resp['status']=($resp['validate']['status'] && $resp['db']['status']);
        }
        echo json_encode($resp);
    }
    public function vEliminar($id_usuario)
    {
        $mUsuario=new mUsuario;
        $usuario = $mUsuario->GetUsuario($id_usuario);
        $data=['Usuario'=>$usuario];
        $this->vista('Usuario/vEliminar', $data);
    }

    public function vLista()
    {
        $this->vista('Usuario/vListar');
    }

    public function vTabla()
    {
        $mUsuario=new mUsuario;
        $pagActual=$_POST['Tabla']['pagActual']; 
        $limit=$_POST['Tabla']['limit'];
        $busqueda=$_POST['Tabla']['busqueda'];
        if (empty($busqueda)) 
        {
            $numReg=$mUsuario->CountUsuarios();
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $usuarios=$mUsuario->GetList($offset, $limit);
            $data=['Usuarios'=>$usuarios,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual];
            $this->vista('Usuario/Component/Tabla', $data);
        }
        else
        {
            $numReg=$mCliente->CountUsuariosSearch($busqueda);
            $numPag=ceil($numReg/$limit);
            $offset=($pagActual-1)*$limit;
            $usuarios=$mCliente->GetListSearch($offset,$limit,$busqueda);
            $data=['Usuarios'=>$usuarios,
                    'numPaginas'=>$numPag,
                    'pagActual'=>$pagActual];
            $this->vista('Usuario/Component/Tabla', $data);
        }
    }

}

?>