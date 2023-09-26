<?php
require ('../checkSession.php');

if (isset($_GET['term'])){
	
	$return_arr = array();
	
	try {
		
		$fields = array(0 => 'e.cct');
		$where = '(e.level = 2)';
		$whereFields = '';
		$join = '';
		$order = 'e.cct';
		$model = new SchoolModel();
		$result = $model -> listAll('', '', $_GET['term'], $fields, $order, $where, $whereFields, $join);
		foreach($result as $entry){
			$return_arr[] = $entry->getCct();
		}
	
	}catch(Exception $e){
        echo 'ERROR: ' . $e->getMessage();
    }
	
	echo json_encode($return_arr);
}

?>
