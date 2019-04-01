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

}
?>