<?php
class Venta extends Controller 
{

    public function __construct() {
        $this->GuardSession();
	}

	public function vRegistrar() {

		$data = [];
		if(isset($_SESSION["Venta"])) {
			$data = ["Venta" => $_SESSION["Venta"]];
		}
		
		return $this->vista("Factura/vRegistrar", $data);
	}

}
?>