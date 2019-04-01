<?php
class Facturacion {

	public function calculaDigitoMod11($cadena, $numDig, $limMult, $x10) {

		if (!$x10) $numDig = 1;

		for($n = 1; $n <= $numDig; $n++) {
			$soma = 0;
			$mult = 2;
			for($i = strlen($cadena) - 1; $i >= 0; $i--) {
				$substr = substr($cadena,$i, 1);
				$soma += ($mult * $substr);
				if(++$mult > $limMult) $mult = 2;
			}

			if ($x10) {
				$dig = (($soma * 10) % 11) % 10;
			} else {
				$dig = $soma % 11;
			}

			if ($x10) {
				$dig = (($soma * 10) % 11) % 10;
			} else {
				$dig = $soma % 11;
			}

			if ($dig == 10) {
				$cadena .= "1";
			}

			if ($dig == 11) {
				$cadena .= "0";
			}

			if ($dig < 10) {
				$cadena .= $dig;
			}     

		}

		return substr($cadena, strlen($cadena) - $numDig, strlen($cadena));
	}


	function bcdechex($dec) {
		$hex = '';
		do {    
			$last = bcmod($dec, 16);
			$hex = dechex($last).$hex;
			$dec = bcdiv(bcsub($dec, $last), 16);
		} while($dec>0);
		return $hex;
	}

}










?>