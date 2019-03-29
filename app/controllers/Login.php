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
                $_SESSION["usuario"] = array(
                    "id_usuario" => $usuario->id_usuario,
                    "usuario" => $usuario->usuario,
                    "nombre" => $usuario->nombre,
                    "apellidos" => $usuario->apellidos,
                    "esAdmin" => $usuario->esAdmin
                );
            }
		}
        echo json_encode($resp);  
    }
    
    public function Logout() {
        if(isset($_SESSION["usuario"])) {
            unset($_SESSION["usuario"]);
        }
        session_destroy();

        header('Location: '.RUTA_URL.'/Login/Index');
    }
	
}

?>