<?php 
class AppError extends Controller
{   
	public function __construct() {
		$this->GuardSession();
	}

	public function notFound() {
		$this->vista("404");
	}
}

?>