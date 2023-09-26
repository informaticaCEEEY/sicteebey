<?php

function multidimensional_array_diff($a1, $a2) {
		
	$r = $a1;

	foreach($a2 as $aKey => $aValue){
			
		foreach($aValue as $sKey => $sValue){
		
			foreach($a1 as $fKey => $fValue){
						
				if($fValue == $sValue){
					$searched = true;
					unset($r[$fKey]);
				}
			}		
					
		}		
		
	}
	return $r;
}


?>