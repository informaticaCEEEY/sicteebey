<?php

function cohorte($cohorte){
	
	switch ($cohorte) {
		case "2005-2006":
			$table = "aprov05_06";
			break;
		case "2006-2007":
			$table = "aprov06_07";
			break;
		case "2007-2008":
			$table = "aprov07_08";
			break;
		case "2008-2009":
			$table = "aprov08_09";
			break;
		case "2009-2010":
			$table = "aprov09_10";
			break;
		case "2010-2011":
			$table = "aprov10_11";
			break;
		case "2011-2012":
			$table = "aprov11_12";
			break;
		case "2012-2013":
			$table = "aprov12_13";
			break;
		case "2013-2014":
			$table = "aprov13_14";
			break;
		case "2014-2015":
			$table = "aprov14_15";
			break;
		case "2015-2016":
			$table = "aprov15_16";
			break;	
		default:
			$table = 'null';
		
	}
	
	return $table;
	
}



?>