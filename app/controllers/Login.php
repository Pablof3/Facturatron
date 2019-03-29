<?php 
class Login extends Controller
{
    public function __construct() { 

    }
    //Ejemplo de Metodo Controlador
    public function Index()
    {
        $this->vista('Login/Index');
    }

	public function IniciarSesion() 
	{
		$resp['status']=true;
        $validador = new Validador();
        $validador->Trim($_POST["Usuario"]);

        $usuario=new Core\Usuario;
        $usuario->usuario = $validador->Validar('usuario', ["required"], $_POST["Usuario"]);
        $usuario->password = $validador->Validar('password', ["required"], $_POST["Usuario"]);        

        $resp['validate']=$validador->error;
        $resp['status']=$resp['validate']['status'];        
        if ($validador->error['status']==true) {
            $mUsuario=new mUsuario;
            $usuario=$mUsuario->VerificarUsuario($usuario);
			if($usuario == false) {
				$resp['status'] = false;
			} else {
                $sesion_usuario = new Core\Usuario;
                $sesion_usuario->id_usuario = $usuario->id_usuario;
                $sesion_usuario->usuario = $usuario->usuario;
                $sesion_usuario->nombre = $usuario->nombre;
                $sesion_usuario->apellidos = $usuario->apellidos;
                $sesion_usuario->esAdmin = $usuario->esAdmin;
                $_SESSION["usuario"] = $sesion_usuario;
            }
		}
        echo json_encode($resp);  
    }
    
    public function Logout() {
        if(isset($_SESSION["usuario"])) {
            unset($_SESSION["usuario"]);
        }

        header('Location: '.RUTA_URL.'/Login/Index');
    }
	
}

?>