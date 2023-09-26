<?php
require ('../checkSession.php');

if (isset($_GET['term'])){
	
	$return_arr = array();
	
	try {
		
        $showFields = "DISTINCT(idaepy.cct)";
		$searchFields = array(0 => 'idaepy.cct');
		$where = '(idaepy.type = 2 AND idaepy.year = 2016)';
		$whereFields = '';
		$join = 'INNER JOIN idaepy ON e.cct = idaepy.cct';
		$order = 'idaepy.cct';
		$model = new SchoolModel();
		$result = $model -> listAll2('', '', $_GET['term'], $searchFields, $order, $where, $whereFields, $join, $showFields);
		foreach($result as $entry){
			$return_arr[] = $entry['cct'];
		}
	
	}catch(Exception $e){
        echo 'ERROR: ' . $e->getMessage();
    }
	
	echo json_encode($return_arr);
}

?>
