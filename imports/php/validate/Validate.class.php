<?php
/**
 * Clase de Validaciones
 * @copyright UADY DGDA 2013
 * @name Validate.class.php
 */
class Validate{
	
	/**
	 * Función que valida si un valor dado es un entero
	 * @param MultiType::Object $data La información a ser evaluada
	 */
	public static function validateInteger($data){
		
		if(is_numeric($data)){
			
			return intval($data);
		}else{
			throw new ValidateException("La informaci&oacute;n proporcionada no es un valor entero valido");
		}
	}
	
	public static function validateTime($data) {

		if (strtotime($data)) {
			return $data;
		} else {
			throw new ValidateException("La informaci&oacute;n prorporcionada no es una hora valida");
		}
	}
	
	public static function validateReal($data){
		
		if(is_real($data)){
			
			return $data;
		}else{
			throw new ValidateException("La informaci&oacute;n proporcionada no es un valor entero valido");
		}
	}
	
	public static function validateEmail($data){
		
		if(!filter_var($data, FILTER_VALIDATE_EMAIL) === false){
			
			return $data;
		}else{
			throw new ValidateException("El correo electr&oacute;nico " . $data . " no es v&aacute;lido");
		}
	}
    
    public static function validateURL($data){
        
        if(filter_var($data, FILTER_VALIDATE_URL)){
            
            return $data;
        }else{
            throw new ValidateException("El enlace no es " . $data . " no es v&aacute;lida");
        }
    }
	
	/**
	 * Función que valida si un es una fecha en formato valido
	 * @param MultiType::Object $data La información a ser evaluada
	 */
	public static function validateDate($data){
			
		$mdata=$data;
		$mdata=str_replace("/", "-", $mdata);
		if(count(explode('-', $mdata))!=3){
			
			throw new ValidateException("La informaci&oacute;n prorporcionada no es una fecha valida");
		}
		$t = strtotime($mdata);
		if($t===false){
			
			throw new ValidateException("La informaci&oacute;n prorporcionada no es una fecha valida");
		}
		$m = date('m', $t);
		$d = date('d', $t);
		$y = date('Y', $t);
		if(checkdate ($m, $d, $y)){
			
			return date("Y-m-d", strtotime($mdata));
		}else{
			throw new ValidateException("La informaci&oacute;n prorporcionada no es una fecha valida");
		}
	}
	
	/**
	 * Función que valida si un valor dado es vacio
	 * @param MultiType::Object $data La información a ser evaluada
	 */
	public static function validateEmpty($data){
		
		if(!is_null($data) && $data!=''){
			
			return $data;
		}else{
			throw new ValidateException("La informaci&oacute;n proporcionada no puede ser vacia");
		}
	}
}
?>