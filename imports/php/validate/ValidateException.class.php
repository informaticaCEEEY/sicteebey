<?php
/**
 * Clase de Validaciones
 * @copyright UADY DGDA 2013
 * @name ValidateException.class.php
 */
class ValidateException extends Exception{
	
	public function __toString(){
		
		return $this -> message;
	}
}
?>